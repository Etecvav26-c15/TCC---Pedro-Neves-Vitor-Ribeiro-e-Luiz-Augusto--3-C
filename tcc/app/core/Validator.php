<?php
/**
 * Classe de validação de dados
 * Fornece métodos estáticos para validar campos comuns
 */
class Validator {
    /**
     * Valida endereço de email
     * @param string $email
     * @return string|false Email limpo ou false se inválido
     */
    public static function email($email) {
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
    }

    /**
     * Valida força da senha (mín. 8 caracteres, 1 maiúscula, 1 número, 1 especial)
     * @param string $password
     * @return bool
     */
    public static function passwordStrength($password) {
        $length = strlen($password) >= 8;
        $upper = preg_match('/[A-Z]/', $password);
        $number = preg_match('/[0-9]/', $password);
        $special = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
        return $length && $upper && $number && $special;
    }

    /**
     * Sanitiza string contra XSS
     * @param string $input
     * @return string
     */
    public static function sanitize($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Verifica se um valor está vazio
     * @param mixed $value
     * @return bool
     */
    public static function required($value) {
        if (is_array($value)) return !empty($value);
        return trim($value) !== '';
    }

    /**
     * Valida CPF (formato e dígitos verificadores)
     * @param string $cpf
     * @return bool
     */
    public static function cpf($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) return false;
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) $d += $cpf[$c] * (($t + 1) - $c);
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) return false;
        }
        return true;
    }
}