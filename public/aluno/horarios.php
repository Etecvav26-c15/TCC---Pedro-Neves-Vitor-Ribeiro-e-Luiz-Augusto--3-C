<?php
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');
$controller = new AlunoController(Session::get('user_id'));
$horarios = $controller->getHorarios();
$dias = ['segunda','terca','quarta','quinta','sexta','sabado'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><title>Horários</title><link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <h1>📅 Horários de Aula</h1>
            <div class="grid-horarios">
                <?php foreach ($dias as $dia): ?>
                <div class="dia-col">
                    <h3><?= ucfirst($dia) ?></h3>
                    <?php foreach ($horarios as $h):
                        if ($h['dia_semana'] === $dia): ?>
                    <div class="aula-card">
                        <strong><?= Security::escapeHTML($h['materia']) ?></strong>
                        <small><?= substr($h['horario_inicio'],0,5) ?> - <?= substr($h['horario_fim'],0,5) ?></small>
                        <span><?= Security::escapeHTML($h['professor']) ?></span>
                    </div>
                    <?php endif; endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>