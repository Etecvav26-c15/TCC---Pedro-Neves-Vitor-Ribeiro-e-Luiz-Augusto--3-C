<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('professor');
$ctrl = new ProfessorController(Session::get('user_id'));
$db = Database::getInstance();
$materias = $db->fetchAll(
    "SELECT DISTINCT m.id, m.nome FROM materias m
     JOIN professor_turma_materia ptm ON m.id = ptm.materia_id
     WHERE ptm.professor_id = ? AND ptm.ano_letivo = YEAR(CURDATE())",
    [Session::get('user_id')]
);
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $ctrl->salvarPlanoAula($_POST['materia_id'], $_POST['titulo'], $_POST['conteudo'], $_POST['data_plano']);
    $msg = 'Plano de aula salvo!';
}
$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head><title>Plano de Aula</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_professor.php'; ?>
        <main class="main-content">
            <h1>📖 Plano de Aula</h1>
            <?php if ($msg): ?><div class="alert success"><?= $msg ?></div><?php endif; ?>
            <form method="POST" class="form-card">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <div class="form-group">
                    <select name="materia_id" class="form-input" required>
                        <option value="">Selecione a matéria</option>
                        <?php foreach ($materias as $m): ?><option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><input class="form-input" name="titulo" placeholder="Título do plano" required></div>
                <div class="form-group"><textarea class="form-input" name="conteudo" rows="8" placeholder="Conteúdo do plano..." required></textarea></div>
                <div class="form-group"><input class="form-input" type="date" name="data_plano" value="<?= date('Y-m-d') ?>" required></div>
                <button class="btn btn-primary" type="submit">Salvar Plano</button>
            </form>
        </main>
    </div>
</body>
</html>