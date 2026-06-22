<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$ctrl = new CoordenadorController();
$relatorio = $ctrl->getRelatorioGeral();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relatórios</title>
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
            <h1>📊 Relatórios</h1>
            <div class="stats-row">
                <div class="stat-card"><strong>Alunos:</strong> <?= $relatorio['total_alunos'] ?></div>
                <div class="stat-card"><strong>Professores:</strong> <?= $relatorio['total_professores'] ?></div>
                <div class="stat-card"><strong>Turmas:</strong> <?= $relatorio['total_turmas'] ?></div>
            </div>
            <!-- Pode expandir com mais relatórios -->
        </main>
    </div>
</body>
</html>