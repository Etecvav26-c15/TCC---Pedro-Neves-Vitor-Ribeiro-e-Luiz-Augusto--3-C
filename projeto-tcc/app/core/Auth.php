<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../config/database.php';
//inclui as constantes de configuração se ainda não estiverem definidas 
if (!defined('SESSION_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

// app/core/Auth.php
class Auth {

    public static function login($email, $password) {
        $db = Database::getInstance();
        $email = strtolower(trim($email));
        $user = $db->fetch("SELECT id, encrypted_password, tipo, nome, ativo FROM usuarios WHERE email = ?", [$email]);

        if (!$user || !$user['ativo']) {
            Security::log(null, 'login_fail', "Email não encontrado/inativo: $email");
            throw new Exception('Credenciais inválidas.');
        }

        // --- CAMADA INTERMEDIÁRIA: descriptografia em memória ---
        $encryptedHash = $user['encrypted_password'];
        $decryptedHash = null;
        try {
            $decryptedHash = Encryption::decrypt($encryptedHash);
            if (!password_verify($password, $decryptedHash)) {
                Security::log($user['id'], 'login_fail', 'Senha incorreta');
                throw new Exception('Credenciais inválidas.');
            }
        } finally {
            // Destruir imediatamente o hash descriptografado
            if ($decryptedHash !== null) {
                $decryptedHash = str_repeat(' ', 128);
                unset($decryptedHash);
            }
        }
        // ---------------------------------------------------------

        // Login bem-sucedido
        Session::start();
        Session::set('user_id', $user['id']);
        Session::set('user_tipo', $user['tipo']);
        Session::set('user_nome', $user['nome']);
        Session::set('logged_in', true);
        Session::set('login_time', time());
        session_regenerate_id(true);

        $db->query("UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?", [$user['id']]);
        Security::log($user['id'], 'login_success');

        RateLimiter::reset($email);
        return ['redirect' => self::dashboardUrl($user['tipo'])];
    }

    public static function dashboardUrl($tipo) {
        $map = [
            'aluno'       => '../public/aluno/dashboard.php',
            'professor'   => '../public/professor/dashboard.php',
            'coordenador' => '../public/coordenador/dashboard.php',
        ];
        return $map[$tipo] ?? '../login.php';
    }

    public static function check() {
        Session::start();
        if (!Session::get('logged_in') || (time() - Session::get('login_time') > SESSION_LIFETIME)) {
            self::logout();
            header('Location: ../login.php');
            exit;
        }
        Session::set('login_time', time());
    }

    public static function requireLevel($tipo) {
        self::check();
        if (Session::get('user_tipo') !== $tipo) {
            $redirect = self::dashboardUrl(Session::get('user_tipo'));
            header("Location: $redirect");
            exit;
        }
    }

    public static function logout() {
        Session::start();
        Security::log(Session::get('user_id'), 'logout');
        Session::destroy();
    }
}