<?php

require_once __DIR__ . '/../app/core/Session.php';
require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

Session::start();

$token = $_GET['token'] ?? '';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller = new AuthController();

    // Solicitação de recuperação
    if (empty($token)) {

        $result = $controller->recuperarSenha($_POST['email']);

        if ($result['success']) {
            $message = $result['message'];
        } else {
            $error = $result['message'];
        }

    }
    // Redefinição da senha
    else {

        if ($_POST['nova_senha'] != $_POST['confirmar_senha']) {

            $error = "As senhas não coincidem.";

        } else {

            $result = $controller->resetarSenha(
                $token,
                $_POST['nova_senha']
            );

            if ($result['success']) {

                $message = 'Senha alterada com sucesso! <a href="login.php">Faça login</a>.';

            } else {

                $error = $result['message'];

            }

        }

    }

}
?>
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <h2>Recuperar Senha</h2>
        <?php if ($message): ?><div class="alert success"><?= $message ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert error"><?= $error ?></div><?php endif; ?>

        <?php if (!$token): ?>
            <form method="POST">
                <div class="form-group"><input class="form-input" type="email" name="email" placeholder="Seu email" required></div>
                <button class="btn btn-primary btn-block" type="submit">Enviar Link</button>
            </form>
        <?php else: ?>
         <form method="POST">

    <div class="form-group">

        <input
            class="form-input"
            type="password"
            name="nova_senha"
            placeholder="Nova senha"
            required
            minlength="8">

    </div>

    <div class="form-group">

        <input
            class="form-input"
            type="password"
            name="confirmar_senha"
            placeholder="Confirmar senha"
            required>

    </div>

    <button
        class="btn btn-primary btn-block"
        type="submit">

        Alterar Senha

    </button>

</form>
        <?php endif; ?>
        <a href="login.php">Voltar ao login</a>
    </div>
</body>
</html>

