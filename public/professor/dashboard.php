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
                <a href="chamada.php" class="card"><span>✅ Chamada</span></a>
                <a href="lancar-notas.php" class="card"><span>📝 Notas</span></a>
                <a href="plano-aula.php" class="card"><span>📖 Plano de Aula</span></a>
                <a href="lista-alunos.php" class="card"><span>👥 Lista de Alunos</span></a>
            </div>
            <h2>Minhas Turmas</h2>
            <ul>
                <?php foreach ($turmas as $t): ?><li><?= $t['nome'] ?></li><?php endforeach; ?>
            </ul>
        </main>
    </div>
</body>
</html>