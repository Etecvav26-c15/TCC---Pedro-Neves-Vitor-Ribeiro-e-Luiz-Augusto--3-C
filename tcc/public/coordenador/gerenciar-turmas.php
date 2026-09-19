<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $ctrl = new CoordenadorController();
    $ctrl->criarTurma($_POST['nome'], $_POST['turno']);
    $msg = 'Turma criada!';
}
$csrfToken = Security::generateCSRFToken();
$db = Database::getInstance();
$turmas = $db->fetchAll("SELECT * FROM turmas WHERE ativo = 1 ORDER BY nome");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Turmas</title>
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
            <h1>🏫 Turmas</h1>
            <?php if ($msg): ?><div class="alert success"><?= $msg ?></div><?php endif; ?>
            <form method="POST" class="form-card" style="margin-bottom:20px;">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <div class="form-group"><input class="form-input" name="nome" placeholder="Nome da turma (ex: 3C)" required></div>
                <div class="form-group">
                    <select name="turno" class="form-input" required>
                        <option value="">Turno</option>
                        <option value="matutino">Matutino</option>
                        <option value="vespertino">Vespertino</option>
                        <option value="noturno">Noturno</option>
                        <option value="integral">Integral</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Criar Turma</button>
            </form>
            <table class="data-table">
                <thead><tr><th>Nome</th><th>Turno</th><th>Ano Letivo</th></tr></thead>
                <tbody>
                    <?php foreach ($turmas as $t): ?>
                    <tr><td><?= $t['nome'] ?></td><td><?= $t['turno'] ?></td><td><?= $t['ano_letivo'] ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>