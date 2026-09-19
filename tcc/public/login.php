<?php

require_once __DIR__ . '/../app/autoload.php';
require_once __DIR__ . '/../app/config/config.php'; // constantes globais
// app/autoload.php


Session::start();

// Se já estiver logado, redireciona
if (Session::get('logged_in')) {
    header('Location: ' . Auth::dashboardUrl(Session::get('user_tipo')));
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::validateCSRF($_POST['csrf_token'] ?? '')) {
        $error = 'Token de segurança inválido. Recarregue a página.';
    } else {
        $controller = new AuthController();
        $result = $controller->login($_POST['email'], $_POST['senha']);
        if ($result['success']) {
            header('Location: ' . $result['redirect']);
            exit;
        } else {
            $error = $result['message'];
        }
    }
}

$csrfToken = Security::generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Escolar</title>
    <link rel="stylesheet" href="/TCC/public/assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">

        <div class="login-card">

            <div class="login-logo">
                📚
            </div>

            <h1>Sistema Escolar</h1>
            

            <?php if ($error): ?>
                <div class="alert error">
                    <?= Security::escapeHTML($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

                <div class="form-group">
                    <label>Email</label>
                    <input
                        class="form-input"
                        type="email"
                        name="email"
                        placeholder="Digite seu email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Senha</label>
                    <input
                        class="form-input"
                        type="password"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <button class="btn btn-primary btn-block" type="submit">
                    Entrar
                </button>

                <a href="recuperar-senha.php" class="link">
                    Esqueci minha senha
                </a>

            </form>

        </div>

    </div>
</body>
</html>