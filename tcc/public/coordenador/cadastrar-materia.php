<?php
require_once '../../app/core/Auth.php';

Auth::requireLevel('coordenador');

$msg = '';
$tipo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::validateCSRF($_POST['csrf_token'])) {

    $ctrl = new CoordenadorController();

    try {

        $ctrl->cadastrarMateria($_POST);

        $msg = "Matéria cadastrada com sucesso!";
        $tipo = "sucesso";

    } catch (Exception $e) {

        $msg = "Erro: " . $e->getMessage();
        $tipo = "erro";

    }

}

$csrfToken = Security::generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Cadastrar Matéria</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="app-container">

    <?php include '../shared/sidebar_coordenador.php'; ?>

    <main class="main-content">

        <h1 style="color: aliceblue;">📚 Cadastrar Matéria</h1>

        <form method="POST" class="form-card">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= $csrfToken ?>"
            >

            <div class="form-group">

                <input
                    class="form-input"
                    type="text"
                    name="nome"
                    placeholder="Nome da matéria"
                    required
                >

            </div>

            <div class="form-group">

                <input
                    class="form-input"
                    type="text"
                    name="codigo"
                    placeholder="Código (Ex.: MAT101)"
                >

            </div>


            <div class="form-group">

                <textarea
                    class="form-input"
                    name="descricao"
                    rows="5"
                    placeholder="Descrição da matéria (opcional)"
                ></textarea>

            </div>

            <button
                class="btn btn-primary"
                type="submit">

                Cadastrar Matéria

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

            <?= htmlspecialchars($msg) ?>

        </div>

    </div>

</div>

<?php endif; ?>

<script src="../assets/js/toast.js"></script>

</body>

</html>