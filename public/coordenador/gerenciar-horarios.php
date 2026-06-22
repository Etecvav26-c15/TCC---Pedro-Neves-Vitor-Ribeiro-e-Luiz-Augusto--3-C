<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('coordenador');
$db = Database::getInstance();
// Exibe horários existentes; a implementação de cadastro/edição segue padrão similar
$horarios = $db->fetchAll("
    SELECT h.id, t.nome as turma, m.nome as materia, u.nome as professor,
           h.dia_semana, h.horario_inicio, h.horario_fim
    FROM horarios_aula h
    JOIN professor_turma_materia ptm ON h.professor_turma_materia_id = ptm.id
    JOIN turmas t ON ptm.turma_id = t.id
    JOIN materias m ON ptm.materia_id = m.id
    JOIN usuarios u ON ptm.professor_id = u.id
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Horários</title>
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
            <h1>📅 Horários Cadastrados</h1>
            <table class="data-table">
                <thead><tr><th>Turma</th><th>Matéria</th><th>Professor</th><th>Dia</th><th>Início</th><th>Fim</th></tr></thead>
                <tbody>
                    <?php foreach ($horarios as $h): ?>
                    <tr>
                        <td><?= $h['turma'] ?></td><td><?= $h['materia'] ?></td><td><?= $h['professor'] ?></td>
                        <td><?= $h['dia_semana'] ?></td><td><?= substr($h['horario_inicio'],0,5) ?></td><td><?= substr($h['horario_fim'],0,5) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Formulário para adicionar novo horário similar às outras páginas -->
        </main>
    </div>
</body>
</html>