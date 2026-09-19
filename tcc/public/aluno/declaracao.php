<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');
$controller = new AlunoController(Session::get('user_id'));
$declaracao = $controller->gerarDeclaracao();
if (!$declaracao) {
    die('Não foi possível gerar a declaração.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Declaração de Matrícula</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <div class="content">
                <h1>📜 Declaração de Matrícula</h1>
                <p>Declaramos que <strong><?= Security::escapeHTML($declaracao['aluno']['nome']) ?></strong>, matrícula <?= Security::escapeHTML($declaracao['aluno']['matricula']) ?>, está regularmente matriculado(a) na turma <?= Security::escapeHTML($declaracao['aluno']['turma']) ?> no ano letivo de <?= $declaracao['aluno']['ano_letivo'] ?>.</p>
                <p><small>Código de verificação: <strong><?= $declaracao['codigo'] ?></strong></small></p>
                <p><small>Emitido em: <?= $declaracao['data'] ?></small></p>
                <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
            </div>
        </main>
    </div>
</body>
</html>