<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');
$controller = new AlunoController(Session::get('user_id'));
$faltas = $controller->getFaltas();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faltas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <h1>📋 Faltas</h1>
            <table class="data-table">
                <thead><tr><th>Matéria</th><th>Total de Faltas</th></tr></thead>
                <tbody>
                    <?php foreach ($faltas as $f): ?>
                    <tr><td><?= Security::escapeHTML($f['materia']) ?></td><td><?= $f['total_faltas'] ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>