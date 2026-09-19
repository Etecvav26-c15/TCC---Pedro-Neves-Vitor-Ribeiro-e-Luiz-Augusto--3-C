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
        'C'=>'Desenvolvimento de Sistemas - PI',
        'C¹'=> 'Desenvolvimento de Sistemas - Mtec',
        'C²'=> 'Desenvolvimento de Sistemas - NovoTec',
        'C³'=> 'Desenvolvimento de Sistemas - Mtec',
        'D'=>'Técnico em Informática - Mtec',
        'D¹'=>'Técnico em Informática - Mtec',
        'D²'=>'Técnico em Informática - NovoTec',
        'E'=>'Logística - Mtec',
        'S⁶'=> 'Administração - Mtec',
        'S⁵'=> 'Administração - NovoTec',
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
            <h1>Painel do Aluno</h1>
            <br>
            <br>
            <div class="info-card aluno-info">

    <h2>👋 Bem-vindo, <?= htmlspecialchars($aluno['nome']) ?></h2>

    <div class="info-grid">

        <div>
            <strong>Matrícula</strong>
            <p><?= htmlspecialchars($aluno['matricula']) ?></p>
        </div>

        <div>
            <strong>Turma</strong>
            <p><?= htmlspecialchars($aluno['turma']) ?></p>
        </div>

        <div>
            <strong>Curso</strong>
            <p><?= htmlspecialchars($infoTurma) ?></p>
        </div>

        <div>
            <strong>Mensagens</strong>
            <p><?= $msgCount ?> não lida(s)</p>
        </div>

    </div>

</div>

        <div class="dashboard-grid">

            <a href="../aluno/boletim.php" class="dashboard-card">
                <span>📊</span>
                <h3>Boletim</h3>
                <p>Consultar notas.</p>
            </a>

            <a href="../aluno/faltas.php" class="dashboard-card">
                <span>📅</span>
                <h3>Faltas</h3>
                <p>Consultar frequência.</p>
            </a>

            <a href="../aluno/horarios.php" class="dashboard-card">
                <span>⏰</span>
                <h3>Horários</h3>
                <p>Ver aulas.</p>
            </a>

            <a href="../aluno/mensagens.php" class="dashboard-card">
                <span>💬</span>
                <h3>Mensagens</h3>
                <p><?= $msgCount ?> nova(s).</p>
            </a>

            <a href="../aluno/declaracao.php" class="dashboard-card">
                <span>📄</span>
                <h3>Declaração</h3>
                <p>Emitir declaração.</p>
            </a>

        </div>
        </main>
    </div>
</body>
</html>