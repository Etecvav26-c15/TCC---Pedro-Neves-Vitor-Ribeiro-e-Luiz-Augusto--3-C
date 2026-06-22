<?php

//inclui as constantes de configuração se ainda não estiverem definidas 
if (!defined('SESSION_NAME')) {
    require_once __DIR__ . '/../config/config.php';
}

class Encryption {
    private static $cipher = 'aes-256-cbc';

    /**
     * Criptografa uma string.
     */
    public static function encrypt($plaintext) {
        $key = ENCRYPTION_KEY;
        $ivlen = openssl_cipher_iv_length(self::$cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($plaintext, self::$cipher, $key, OPENSSL_RAW_DATA, $iv);
        // Armazena IV + ciphertext em base64
        return base64_encode($iv . $ciphertext);
    }

    /**
     * Descriptografa uma string.
     */
    public static function decrypt($ciphertext_base64) {
        $key = ENCRYPTION_KEY;
        $data = base64_decode($ciphertext_base64);
        $ivlen = openssl_cipher_iv_length(self::$cipher);
        $iv = substr($data, 0, $ivlen);
        $ciphertext = substr($data, $ivlen);
        return openssl_decrypt($ciphertext, self::$cipher, $key, OPENSSL_RAW_DATA, $iv);
    }
}