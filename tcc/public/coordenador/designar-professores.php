<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$db = Database::getInstance();
$professores = $db->fetchAll("SELECT id, nome FROM usuarios WHERE tipo = 'professor' AND ativo = 1");
$turmas = $db->fetchAll("SELECT id, nome FROM turmas WHERE ativo = 1");
$materias = $db->fetchAll("SELECT id, nome FROM materias WHERE ativo = 1");
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $ctrl = new CoordenadorController();
    $ctrl->designarProfessor($_POST['professor_id'], $_POST['turma_id'], $_POST['materia_id']);
    $msg = 'Professor designado com sucesso!';
}
$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Designar Professores</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<style>
    h1{
        color: aliceblue;
    }
</style>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_coordenador.php'; ?>
        <main class="main-content">
            <h1>Designar Professor</h1>
            <?php if ($msg): ?><div class="alert success"><?= $msg ?></div><?php endif; ?>
            <form method="POST" class="form-card">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <div class="form-group">
                    <select name="professor_id" class="form-input" required>
                        <option value="">Professor</option>
                        <?php foreach ($professores as $p): ?><option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="turma_id" class="form-input" required>
                        <option value="">Turma</option>
                        <?php foreach ($turmas as $t): ?><option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="materia_id" class="form-input" required>
                        <option value="">Matéria</option>
                        <?php foreach ($materias as $m): ?><option value="<?= $m['id'] ?>"><?= $m['nome'] ?></option><?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Designar</button>
            </form>
        </main>
    </div>
</body>
</html>