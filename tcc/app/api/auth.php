<?php
/**
 * Endpoint de autenticação da API
 * Método: POST
 * Parâmetros (JSON): email, senha
 * Retorno: token JWT-like e dados do usuário
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido. Use POST.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || empty($input['email']) || empty($input['senha'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Email e senha são obrigatórios.']);
    exit;
}

try {
    $controller = new AuthController();
    $result = $controller->login($input['email'], $input['senha']);
    if ($result['success']) {
        $token = bin2hex(random_bytes(32));
        $db = Database::getInstance();
        $userId = $_SESSION['user_id'] ?? null;
        $db->query("INSERT INTO sessions (user_id, token, expires) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 30 DAY))",
            [$userId, $token]);
        echo json_encode(['success' => true, 'token' => $token, 'redirect' => $result['redirect']]);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => $result['message']]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro interno: ' . $e->getMessage()]);
}