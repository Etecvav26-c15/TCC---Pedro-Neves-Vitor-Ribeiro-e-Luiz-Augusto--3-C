<?php
/**
 * Endpoint para professores (API)
 * Método: GET (para consultas) e POST (para chamadas e notas)
 */
if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido.']);
    exit;
}

require_once __DIR__.'/../core/Auth.php';
$userId = Auth::getUserIdFromToken();
$controller = new ProfessorController($userId);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? 'turmas';
    switch ($action) {
        case 'turmas':
            $data = $controller->getTurmas();
            break;
        case 'alunos':
            $turmaId = $_GET['turma_id'] ?? 0;
            $data = $controller->getAlunosDaTurma($turmaId);
            break;
        default:
            $data = [];
    }
    echo json_encode(['success' => true, 'data' => $data]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $input['action'] ?? '';
    try {
        switch ($action) {
            case 'chamada':
                $chamadaId = $controller->registrarChamada($input['turma_id'], $input['materia_id'], $input['data_aula'], $input['presencas']);
                echo json_encode(['success' => true, 'chamada_id' => $chamadaId]);
                break;
            case 'notas':
                $controller->lancarNotas($input['turma_id'], $input['materia_id'], $input['bimestre'], $input['ano_letivo'], $input['notas']);
                echo json_encode(['success' => true]);
                break;
            case 'plano':
                $planoId = $controller->salvarPlanoAula($input['materia_id'], $input['titulo'], $input['conteudo'], $input['data_plano']);
                echo json_encode(['success' => true, 'plano_id' => $planoId]);
                break;
            default:
                http_response_code(400);
                echo json_encode(['error' => 'Ação desconhecida.']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}