<?php

//inclui as constantes de configuração se ainda não estiverem definidas 
if (!defined('SESSION_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

class RateLimiter {
    private static $attempts = [];
    private static $maxAttempts = MAX_LOGIN_ATTEMPTS;
    private static $timeout = LOGIN_TIMEOUT_MINUTES * 60;

    public static function check($identifier) {
        $now = time();
        if (!isset(self::$attempts[$identifier])) {
            self::$attempts[$identifier] = ['count' => 0, 'first_attempt' => $now];
        }
        $entry = &self::$attempts[$identifier];
        if ($now - $entry['first_attempt'] > self::$timeout) {
            $entry = ['count' => 0, 'first_attempt' => $now];
        }
        $entry['count']++;
        if ($entry['count'] > self::$maxAttempts) {
            throw new Exception('Muitas tentativas. Tente novamente em ' . self::$timeout/60 . ' minutos.');
        }
        return true;
    }

    public static function reset($identifier) {
        unset(self::$attempts[$identifier]);
    }
}