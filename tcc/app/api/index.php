<?php
// app/api/index.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Ajustar em produção
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') exit;

require_once __DIR__.'/../../app/config/database.php';
require_once __DIR__.'/../../app/core/Auth.php';
require_once __DIR__.'/../../app/core/Security.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/school-system/app/api/', '', $uri);
$parts = explode('/', trim($uri, '/'));

$method = $_SERVER['REQUEST_METHOD'];

// Autenticação via token (simplificado para a API)
function authenticate() {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? '';
    if (empty($token) || !preg_match('/^Bearer\s+(.+)$/', $token, $m)) {
        http_response_code(401);
        echo json_encode(['error' => 'Não autorizado']);
        exit;
    }
    // Verificar token (pode ser JWT ou token armazenado na sessão)
    // Aqui simplificamos verificando se o token corresponde a uma sessão ativa
    // Implemente conforme necessidade
    $db = Database::getInstance();
    $sess = $db->fetch("SELECT user_id FROM sessions WHERE token = ? AND expires > NOW()", [$m[1]]);
    if (!$sess) {
        http_response_code(401);
        echo json_encode(['error' => 'Token inválido']);
        exit;
    }
    return $sess['user_id'];
}

$endpoint = $parts[0] ?? '';

switch ($endpoint) {
    case 'login':
        if ($method !== 'POST') http_response_code(405);
        else {
            $input = json_decode(file_get_contents('php://input'), true);
            try {
                $result = Auth::login($input['email'], $input['password']);
                // Gera token para API
                $token = bin2hex(random_bytes(32));
                $db = Database::getInstance();
                $db->query("INSERT INTO sessions (user_id, token, expires) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 30 DAY))",
                    [Session::get('user_id'), $token]);
                echo json_encode(['success' => true, 'token' => $token, 'redirect' => $result['redirect']]);
            } catch (Exception $e) {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        break;

    case 'horarios':
        if ($method !== 'GET') http_response_code(405);
        else {
            $userId = authenticate();
            // Lógica para retornar horários conforme tipo de usuário
            // (similar à web)
            echo json_encode(['success' => true, 'data' => []]);
        }
        break;

    // Outros endpoints: boletim, faltas, chamada...
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint não encontrado']);
}