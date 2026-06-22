<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');

// Busca informações do aluno
$db = Database::getInstance();
$alunoId = Session::get('user_id');
$aluno = $db->fetch("SELECT u.nome, u.matricula, t.nome as turma, at2.ano_letivo
    FROM usuarios u
    JOIN alunos_turma at2 ON u.id = at2.aluno_id
    JOIN turmas t ON at2.turma_id = t.id
    WHERE u.id = ? AND at2.status = 'cursando'", [$alunoId]);

// Interpretar série e curso a partir do nome da turma
function interpretarTurma($nomeTurma) {
    $serie = ['1'=>'Primeira Série','2'=>'Segunda Série','3'=>'Terceira Série'];
    $cursos = [
        'A'=>'Design de Interiores - PI',
        'B'=>'Edificações - PI',
        'C'=>'Desenvolvimento de Sistemas - Mtec e NovoTec',
        'D'=>'Técnico em Informática - Mtec e NovoTec',
        'E'=>'Logística - Mtec',
        'S'=>'Administração - Mtec e NovoTec',
        'W'=>'Meio Ambiente - NovoTec',
        'V'=>'Recursos Humanos - NovoTec',
        'Z'=>'Segurança do Trabalho - NovoTec',
        'F'=>'Design de Interiores - Noturno'
    ];
    preg_match('/(\d)([A-Z])/', $nomeTurma, $m);
    $serieDesc = $serie[$m[1]] ?? 'Série desconhecida';
    $cursoDesc = $cursos[$m[2]] ?? 'Curso desconhecido';
    return "$serieDesc – $cursoDesc";
}
$infoTurma = interpretarTurma($aluno['turma'] ?? '');

// Mensagens não lidas
$msgCount = $db->fetch("SELECT COUNT(*) as total FROM mensagens WHERE destinatario_tipo = 'aluno' AND destinatario_id = ? AND lida = 0", [$alunoId])['total'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Aluno - Sistema Escolar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <header class="top-header">
                <h1>Olá, <?= Security::escapeHTML(explode(' ', $aluno['nome'])[0]) ?>!</h1>
                <span class="badge"><?= Security::escapeHTML($aluno['turma']) ?></span>
            </header>
            <div class="content">
                <div class="info-card">
                    <h2><?= $infoTurma ?></h2>
                    <p>Matrícula: <?= Security::escapeHTML($aluno['matricula']) ?></p>
                </div>
                <div class="dashboard-grid">
                    <a href="horarios.php" class="card">
                        <span class="icon">📅</span>
                        <span>Horários</span>
                    </a>
                    <a href="boletim.php" class="card">
                        <span class="icon">📊</span>
                        <span>Boletim</span>
                    </a>
                    <a href="faltas.php" class="card">
                        <span class="icon">📋</span>
                        <span>Faltas</span>
                    </a>
                    <a href="mensagens.php" class="card">
                        <span class="icon">💬</span>
                        <span>Mensagens <?= $msgCount ? "($msgCount)" : '' ?></span>
                    </a>
                    <a href="declaracao.php" class="card">
                        <span class="icon">📜</span>
                        <span>Declaração</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>