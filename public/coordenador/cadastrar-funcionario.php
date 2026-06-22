<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {
    $ctrl = new CoordenadorController();
    try {
        $ctrl->cadastrarFuncionario($_POST, $_POST['tipo']);
        $msg = 'Funcionário cadastrado!';
    } catch (Exception $e) { $msg = 'Erro: ' . $e->getMessage(); }
}
$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Funcionário</title>
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
            <h1>Cadastrar Funcionário</h1>
            <?php if ($msg): ?><div class="alert"><?= $msg ?></div><?php endif; ?>
            <form method="POST" class="form-card">
                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                <div class="form-group"><input class="form-input" name="nome" placeholder="Nome completo" required></div>
                <div class="form-group"><input class="form-input" type="email" name="email" placeholder="Email" required></div>
                <div class="form-group"><input class="form-input" type="password" name="senha" placeholder="Senha" required></div>
                <div class="form-group"><input class="form-input" name="matricula" placeholder="Matrícula"></div>
                <div class="form-group">
                    <select name="tipo" class="form-input" required>
                        <option value="">Tipo</option>
                        <option value="professor">Professor</option>
                        <option value="coordenador">Coordenador</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </form>
        </main>
    </div>
</body>
</html>