<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('professor');
$ctrl = new ProfessorController(Session::get('user_id'));
$turmas = $ctrl->getTurmas();
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard Professor</title><link rel="stylesheet" href="../assets/css/style.css"></head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_professor.php'; ?>
        <main class="main-content">
            <h1>Painel do Professor</h1>
            <div class="dashboard-grid">
                <a href="chamada.php" class="dashboard-card"><span>✅</span><h3>Chamada</h3></a>
                <a href="lancar-notas.php" class="dashboard-card"><span>📝</span><h3>Notas</h3></a>
                <a href="plano-aula.php" class="dashboard-card"><span>📖</span><h3>Plano de Aula</h3></a>
                <a href="lista-alunos.php" class="dashboard-card"><span>👥</span><h3>Lista de Alunos</h3></a>
                <a href="../logout.php" class="dashboard-card"><span>🚪</span><h3>Sair</h3></a>
            </div>
        </main>
    </div>
</body>
</html>