<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('professor');
$ctrl = new ProfessorController(Session::get('user_id'));
$turmas = $ctrl->getTurmas();
$turmaId = $_GET['turma_id'] ?? ($turmas[0]['id'] ?? 0);
$alunos = $ctrl->getAlunosDaTurma($turmaId);
$materias = $ctrl->getMateriasPorTurma($turmaId);
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $presencas = $_POST['presenca'] ?? [];
    $ctrl->registrarChamada($_POST['turma_id'], $_POST['materia_id'], $_POST['data_aula'], $presencas);
    $msg = 'Chamada registrada!';
}
$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head><title>Chamada</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_professor.php'; ?>
        <main class="main-content">
            <h1>✅ Registrar Chamada</h1>
            <?php if ($msg): ?><div class="alert success"><?= $msg ?></div><?php endif; ?>
            <form method="GET" style="margin-bottom:20px;">
                <select name="turma_id" onchange="this.form.submit()" class="form-input">
                    <?php foreach ($turmas as $t): ?><option value="<?= $t['id'] ?>" <?= $turmaId==$t['id']?'selected':'' ?>><?= $t['nome'] ?></option><?php endforeach; ?>
                </select>
            </form>
            <?php if ($alunos): ?>
            <form method="POST" class="form-card">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <input type="hidden" name="turma_id" value="<?= $turmaId ?>">
                <div class="form-group">
                    <select name="materia_id" class="form-input" required>
                        <option value="">Matéria</option>
                        <?php foreach ($materias as $m): ?><option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><input class="form-input" type="date" name="data_aula" value="<?= date('Y-m-d') ?>" required></div>
                <table class="data-table">
                    <thead><tr><th>Aluno</th><th>Presença</th></tr></thead>
                    <tbody>
                        <?php foreach ($alunos as $a): ?>
                        <tr>
                            <td><?= Security::escapeHTML($a['nome']) ?></td>
                            <td>
                                <select name="presenca[<?= $a['id'] ?>]" class="form-input">
                                    <option value="presente">Presente</option>
                                    <option value="ausente">Ausente</option>
                                    <option value="justificado">Justificado</option>
                                </select>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="btn btn-success" type="submit">Salvar Chamada</button>
            </form>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>