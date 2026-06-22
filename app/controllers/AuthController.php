<?php
/**
 * Controller responsável pela autenticação (login, logout, recuperação de senha)
 */
class AuthController {
    /**
     * Processa o login via formulário
     */
    public function login($email, $senha) {
        try {
            RateLimiter::check($email);
            $result = Auth::login($email, $senha);
            return ['success' => true, 'redirect' => $result['redirect']];
        } catch (Exception $e) {
            Security::log(null, 'login_controller_error', $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Processa solicitação de recuperação de senha
     */
    public function recuperarSenha($email) {
        $email = Validator::email($email);
        if (!$email) return ['success' => false, 'message' => 'Email inválido.'];
        $user = (new User())->findByEmail($email);
        if (!$user) return ['success' => false, 'message' => 'Email não encontrado.'];
        $token = bin2hex(random_bytes(32));
        $db = Database::getInstance();
        $db->insert("INSERT INTO tokens_recuperacao (usuario_id, token, expira_em) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))",
            [$user['id'], $token]);
        // Em produção: enviar email com link
        $link = BASE_URL . "recuperar-senha.php?token=" . urlencode($token);
        return ['success' => true, 'message' => 'Um link foi enviado para seu email.', 'debug_link' => $link];
    }

    /**
     * Altera a senha usando token
     */
    public function resetarSenha($token, $novaSenha) {
        if (!Validator::passwordStrength($novaSenha)) {
            return ['success' => false, 'message' => 'Senha fraca. Use ao menos 8 caracteres, maiúsculas, números e símbolos.'];
        }
        $db = Database::getInstance();
        $registro = $db->fetch("SELECT usuario_id FROM tokens_recuperacao WHERE token = ? AND usado = 0 AND expira_em > NOW()", [$token]);
        if (!$registro) return ['success' => false, 'message' => 'Token inválido ou expirado.'];
        $hash = password_hash($novaSenha, PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]);
        $encryptedHash = Encryption::encrypt($hash);
        $db->query("UPDATE usuarios SET encrypted_password = ? WHERE id = ?", [$encryptedHash, $registro['usuario_id']]);
        $db->query("UPDATE tokens_recuperacao SET usado = 1 WHERE token = ?", [$token]);
        return ['success' => true, 'message' => 'Senha alterada com sucesso.'];
    }
}