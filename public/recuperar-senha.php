<?php
/**
 * Página de recuperação de senha
 */
require_once __DIR__.'/../app/core/Session.php';
Session::start();
$step = $_GET['step'] ?? 'solicitar';
$token = $_GET['token'] ?? '';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    if (isset($_POST['email'])) {
        $result = $controller->recuperarSenha($_POST['email']);
        if ($result['success']) $message = 'Um link de recuperação foi gerado (verifique o email).';
        else $error = $result['message'];
    } elseif (isset($_POST['nova_senha']) && !empty($token)) {
        $result = $controller->resetarSenha($token, $_POST['nova_senha']);
        if ($result['success']) $message = 'Senha alterada com sucesso! <a href="login.php">Faça login</a>.';
        else $error = $result['message'];
    }
}
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
                <div class="form-group"><input class="form-input" type="password" name="nova_senha" placeholder="Nova senha" required minlength="8"></div>
                <button class="btn btn-primary btn-block" type="submit">Alterar Senha</button>
            </form>
        <?php endif; ?>
        <a href="login.php">Voltar ao login</a>
    </div>
</body>
</html>