<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('professor');
$ctrl = new ProfessorController(Session::get('user_id'));
$turmas = $ctrl->getTurmas();
$turmaId = $_GET['turma_id'] ?? ($turmas[0]['id'] ?? 0);
$materiaId = $_GET['materia_id'] ?? 0;
$bimestre = $_GET['bimestre'] ?? '1';
$alunos = $ctrl->getAlunosDaTurma($turmaId);
$materias = $ctrl->getMateriasPorTurma($turmaId);
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $notas = $_POST['nota'] ?? [];
    $ctrl->lancarNotas($turmaId, $_POST['materia_id'], $_POST['bimestre'], date('Y'), $notas);
    $msg = 'Notas lançadas!';
}
$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head><title>Lançar Notas</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_professor.php'; ?>
        <main class="main-content">
            <h1>📝 Lançar Notas</h1>
            <?php if ($msg): ?><div class="alert success"><?= $msg ?></div><?php endif; ?>
            <form method="GET" style="margin-bottom:20px;">
                <select name="turma_id" onchange="this.form.submit()" class="form-input">
                    <?php foreach ($turmas as $t): ?><option value="<?= $t['id'] ?>" <?= $turmaId==$t['id']?'selected':'' ?>><?= $t['nome'] ?></option><?php endforeach; ?>
                </select>
            </form>
            <?php if ($alunos): ?>
            <form method="POST" class="form-card">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <input type="hidden" name="materia_id" value="<?= $materiaId ?: $materias[0]['id'] ?? '' ?>">
                <div class="form-group">
                    <select name="materia_id" class="form-input">
                        <?php foreach ($materias as $m): ?><option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="bimestre" class="form-input">
                        <?php for($b=1;$b<=4;$b++): ?><option value="<?= $b ?>" <?= $bimestre==$b?'selected':'' ?>><?= $b ?>º Bimestre</option><?php endfor; ?>
                    </select>
                </div>
                <table class="data-table">
                    <thead><tr><th>Aluno</th><th>Nota</th></tr></thead>
                    <tbody>
                        <?php foreach ($alunos as $a): ?>
                        <tr>
                            <td><?= Security::escapeHTML($a['nome']) ?></td>
                            <td>
                                <select name="nota[<?= $a['id'] ?>]" class="form-input">
                                    <option value="NA">NA</option>
                                    <option value="I">I - Insuficiente</option>
                                    <option value="R">R - Regular</option>
                                    <option value="B">B - Bom</option>
                                    <option value="MB">MB - Muito Bom</option>
                                </select>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="btn btn-primary" type="submit">Salvar Notas</button>
            </form>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>