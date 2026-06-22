<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$ctrl = new CoordenadorController();
$relatorio = $ctrl->getRelatorioGeral();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Coordenador</title>
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
            <h1>Painel do Coordenador</h1>
            <br>
            <br>
            <div class="dashboard-grid">
                <a href="cadastrar-aluno.php" class="card"><span>👤 Cadastrar Aluno</span></a>
                <a href="cadastrar-funcionario.php" class="card"><span>👥 Cadastrar Funcionário</span></a>
                <a href="gerenciar-turmas.php" class="card"><span>🏫 Gerenciar Turmas</span></a>
                <a href="gerenciar-horarios.php" class="card"><span>📅 Gerenciar Horários</span></a>
                <a href="designar-professores.php" class="card"><span>🔗 Designar Professores</span></a>
                <a href="relatorios.php" class="card"><span>📊 Relatórios</span></a>
            </div>
        </main>
    </div>
</body>
</html>