<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('professor');
$ctrl = new ProfessorController(Session::get('user_id'));
$turmas = $ctrl->getTurmas();
$turmaId = $_GET['turma_id'] ?? ($turmas[0]['id'] ?? 0);
$alunos = $ctrl->getAlunosDaTurma($turmaId);
?>
<!DOCTYPE html>
<html>
<head><title>Lista de Alunos</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_professor.php'; ?>
        <main class="main-content">
            <h1>👥 Lista de Alunos</h1>
            <form method="GET" style="margin-bottom:20px;">
                <select name="turma_id" onchange="this.form.submit()" class="form-input">
                    <?php foreach ($turmas as $t): ?><option value="<?= $t['id'] ?>" <?= $turmaId==$t['id']?'selected':'' ?>><?= $t['nome'] ?></option><?php endforeach; ?>
                </select>
            </form>
            <table class="data-table">
                <thead><tr><th>Nome</th><th>Matrícula</th></tr></thead>
                <tbody>
                    <?php foreach ($alunos as $a): ?>
                    <tr><td><?= Security::escapeHTML($a['nome']) ?></td><td><?= Security::escapeHTML($a['matricula']) ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>