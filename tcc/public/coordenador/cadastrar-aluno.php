<?php
require_once '../../app/core/Auth.php';

Auth::requireLevel('coordenador');

$db = Database::getInstance();
$turmas = $db->fetchAll("SELECT id, nome FROM turmas WHERE ativo = 1");

$msg = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {

    $ctrl = new CoordenadorController();

    try {

        $ctrl->cadastrarAluno($_POST);

        $msg = "Aluno cadastrado com sucesso!";
        $tipo = "sucesso";

    } catch (Exception $e) {

        $msg = $e->getMessage();
        $tipo = "erro";

    }

}

$csrfToken = Security::generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Cadastrar Aluno</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="app-container">

    <?php include '../shared/sidebar_coordenador.php'; ?>

    <main class="main-content">

        <h1>Cadastrar Aluno</h1>

        <form method="POST" class="form-card">

            <input type="hidden"
                   name="csrf_token"
                   value="<?= $csrfToken ?>">

            <div class="form-group">
                <input class="form-input"
                       name="nome"
                       placeholder="Nome completo"
                       required>
            </div>

            <div class="form-group">
                <input class="form-input"
                       type="email"
                       name="email"
                       placeholder="Email"
                       required>
            </div>

            <div class="form-group">
                <input class="form-input"
                       type="password"
                       name="senha"
                       placeholder="Senha"
                       required>
            </div>

            <div class="form-group">
                <input class="form-input"
                       name="matricula"
                       placeholder="Matrícula">
            </div>

            <div class="form-group">

                <select name="turma_id" class="form-input">

                    <option value="">Selecione a turma</option>

                    <?php foreach($turmas as $t): ?>

                        <option value="<?= $t['id']; ?>">

                            <?= htmlspecialchars($t['nome']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <button class="btn btn-primary" type="submit">
                Cadastrar
            </button>

        </form>

    </main>

</div>

<?php if (!empty($msg)): ?>

<div id="toast" class="toast <?= $tipo ?>">

    <div class="toast-icon">
        <?= $tipo === 'sucesso' ? '✅' : '❌'; ?>
    </div>

    <div class="toast-content">

        <div class="toast-title">
            <?= $tipo === 'sucesso' ? 'Sucesso' : 'Erro'; ?>
        </div>

        <div class="toast-message">
            <?= htmlspecialchars($msg); ?>
        </div>

    </div>

</div>

<?php endif; ?>

<script src="../assets/js/mais.js"></script>

</body>
</html>