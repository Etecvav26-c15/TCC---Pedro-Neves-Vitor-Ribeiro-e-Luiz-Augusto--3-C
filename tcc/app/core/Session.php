<?php

//inclui as constantes de configuração se ainda não estiverem definidas 
if (!defined('SESSION_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}
class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', 0);  // 1 em produção com HTTPS
            ini_set('session.cookie_samesite', 'Lax');
            session_name(SESSION_NAME);
            session_start();
            if (!isset($_SESSION['initiated'])) {
                session_regenerate_id(true);
                $_SESSION['initiated'] = true;
            }
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy() {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]);
        }
        session_destroy();
    }
}