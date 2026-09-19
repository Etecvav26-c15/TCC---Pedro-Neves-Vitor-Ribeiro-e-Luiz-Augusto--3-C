<?php

require_once '../../app/core/Auth.php';

Auth::requireLevel('aluno');

$controller = new AlunoController(Session::get('user_id'));

$faltas = $controller->getFaltas();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Frequência</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <div class="app-container">

        <?php include '../shared/sidebar_aluno.php'; ?>

        <main class="main-content">

            <div class="page-header">

                <div>

                    <h1>📋 Frequência</h1>

                    <p class="page-description">
                        Consulte suas presenças, faltas e faltas justificadas.
                    </p>

                </div>

            </div>

            <div class="table-card">

                <table class="data-table frequencia-table">

                    <colgroup>
                        <col class="col-materia">
                        <col class="col-presencas">
                        <col class="col-faltas">
                        <col class="col-justificadas">
                    </colgroup>

                    <thead>

                        <tr>
                            <th>Matéria</th>
                            <th>Presenças</th>
                            <th>Faltas</th>
                            <th>Justificadas</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($faltas)): ?>

                            <?php foreach ($faltas as $f): ?>

                                <tr>

                                    <td>
                                        <?= Security::escapeHTML($f['materia']) ?>
                                    </td>

                                    <td>
                                        <?= (int) $f['presencas'] ?>
                                    </td>

                                    <td>
                                        <?= (int) $f['faltas'] ?>
                                    </td>

                                    <td>
                                        <?= (int) $f['justificadas'] ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="4" class="empty-table">
                                    Nenhuma chamada registrada.
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</body>

</html>