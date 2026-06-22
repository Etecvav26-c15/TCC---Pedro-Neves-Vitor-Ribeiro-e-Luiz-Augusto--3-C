<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');
$controller = new AlunoController(Session::get('user_id'));
$mensagens = $controller->getMensagens();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title>Mensagens</title><link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <h1>💬 Mensagens</h1>
            <?php foreach ($mensagens as $msg): ?>
            <div class="card msg-card">
                <h3><?= Security::escapeHTML($msg['titulo']) ?></h3>
                <p><?= nl2br(Security::escapeHTML($msg['conteudo'])) ?></p>
                <small>Por: <?= Security::escapeHTML($msg['remetente']) ?> em <?= date('d/m/Y', strtotime($msg['data_envio'])) ?></small>
            </div>
            <?php endforeach; ?>
        </main>
    </div>
</body>
</html>