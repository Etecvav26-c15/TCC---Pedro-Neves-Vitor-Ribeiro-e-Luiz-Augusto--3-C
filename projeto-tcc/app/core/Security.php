<?php

//inclui as constantes de configuração se ainda não estiverem definidas 
if (!defined('SESSION_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

class Security {
    public static function generateCSRFToken() {
        $token = bin2hex(random_bytes(32));
        $_SESSION[CSRF_TOKEN_NAME] = $token;
        return $token;
    }

    public static function validateCSRF($token) {
        if (!isset($_SESSION[CSRF_TOKEN_NAME]) || !hash_equals($_SESSION[CSRF_TOKEN_NAME], $token)) {
            return false;
        }
        unset($_SESSION[CSRF_TOKEN_NAME]); // one-time use
        return true;
    }

    public static function sanitize($input) {
        if (is_array($input)) return array_map([self::class, 'sanitize'], $input);
        return htmlspecialchars(trim($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function escapeHTML($str) {
        return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function log($usuarioId, $acao, $descricao = '') {
        $db = Database::getInstance();
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $db->query("INSERT INTO logs_sistema (usuario_id, acao, descricao, ip, user_agent) VALUES (?,?,?,?,?)",
            [$usuarioId, $acao, $descricao, $ip, $ua]);
    }
}