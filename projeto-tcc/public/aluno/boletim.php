<?php
/**
 * Página de boletim do aluno
 */
require_once '../../app/core/Auth.php';
Auth::requireLevel('aluno');
$alunoId = Session::get('user_id');
$controller = new AlunoController($alunoId);
$notas = $controller->getBoletim();
$info = $controller->getDashboardData();
$aluno = $info['aluno'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Boletim - Sistema Escolar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-container">
        <?php include '../shared/sidebar_aluno.php'; ?>
        <main class="main-content">
            <header class="top-header"><h1>📊 Boletim</h1></header>
            <div class="content">
                <table class="data-table">
                    <thead><tr><th>Matéria</th><th>1º Bim</th><th>2º Bim</th><th>3º Bim</th><th>4º Bim</th></tr></thead>
                    <tbody>
                        <?php
                        $materias = [];
                        foreach ($notas as $n) {
                            $materias[$n['materia']][$n['bimestre']] = $n['nota'];
                        }
                        foreach ($materias as $mat => $bims): ?>
                        <tr>
                            <td><?= Security::escapeHTML($mat) ?></td>
                            <td><?= $bims['1'] ?? '-' ?></td>
                            <td><?= $bims['2'] ?? '-' ?></td>
                            <td><?= $bims['3'] ?? '-' ?></td>
                            <td><?= $bims['4'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>