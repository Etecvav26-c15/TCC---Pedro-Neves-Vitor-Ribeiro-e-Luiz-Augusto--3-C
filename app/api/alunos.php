<?php
/**
 * Endpoint para dados de alunos (API)
 * Método: GET
 * Autenticação via header Authorization: Bearer <token>
 * Parâmetros opcionais: ?action=horarios|boletim|faltas|mensagens
 */
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido. Use GET.']);
    exit;
}

require_once __DIR__.'/../core/Auth.php';
$userId = Auth::getUserIdFromToken(); // implemente a validação do token

$action = $_GET['action'] ?? 'dashboard';
$controller = new AlunoController($userId);

switch ($action) {
    case 'horarios':
        $data = $controller->getHorarios();
        break;
    case 'boletim':
        $data = $controller->getBoletim();
        break;
    case 'faltas':
        $data = $controller->getFaltas();
        break;
    case 'mensagens':
        $data = $controller->getMensagens();
        break;
    default:
        $data = $controller->getDashboardData();
}
echo json_encode(['success' => true, 'data' => $data]);