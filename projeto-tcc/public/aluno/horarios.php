<?php

require_once '../../app/core/Auth.php';

Auth::requireLevel('aluno');

$controller = new AlunoController(Session::get('user_id'));

$horarios = $controller->getHorarios();


// =========================================================
// DIAS DA SEMANA
// =========================================================

$dias = [
    'segunda' => 'Segunda',
    'terca'   => 'Terça',
    'quarta'  => 'Quarta',
    'quinta'  => 'Quinta',
    'sexta'   => 'Sexta',
    'sabado'  => 'Sábado'
];


// =========================================================
// ORGANIZA OS HORÁRIOS
// =========================================================

$horariosPorDia = [];

$faixasHorario = [];

foreach ($horarios as $h) {

    $dia = strtolower(trim($h['dia_semana']));

    $inicio = substr($h['horario_inicio'], 0, 5);
    $fim = substr($h['horario_fim'], 0, 5);

    $faixa = $inicio . ' - ' . $fim;

    $horariosPorDia[$dia][$faixa] = $h;

    $faixasHorario[$faixa] = [
        'inicio' => $inicio,
        'fim' => $fim
    ];
}


// =========================================================
// ORDENA OS HORÁRIOS
// =========================================================

uksort($faixasHorario, function ($a, $b) {

    $inicioA = explode(' - ', $a)[0];
    $inicioB = explode(' - ', $b)[0];

    return strcmp($inicioA, $inicioB);
});

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Horários</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>


<body>

<div class="app-container">


    <!-- =====================================================
         SIDEBAR
         ===================================================== -->

    <?php include '../shared/sidebar_aluno.php'; ?>


    <!-- =====================================================
         CONTEÚDO
         ===================================================== -->

    <main class="main-content">


        <!-- =================================================
             CABEÇALHO
             ================================================= -->

        <div class="page-header">

            <div>

                <h1>📅 Horários de Aula</h1>

                <p class="page-description">
                    Confira os horários das suas aulas durante a semana.
                </p>

            </div>

        </div>


        <!-- =================================================
             TABELA
             ================================================= -->

        <div class="horarios-container">

            <table class="horarios-table">


                <!-- =========================================
                     CABEÇALHO DA TABELA
                     ========================================= -->

                <thead>

                    <tr>

                        <th>Horário</th>

                        <?php foreach ($dias as $chave => $nome): ?>

                            <th>
                                <?= $nome ?>
                            </th>

                        <?php endforeach; ?>

                    </tr>

                </thead>


                <!-- =========================================
                     HORÁRIOS
                     ========================================= -->

                <tbody>

                    <?php foreach ($faixasHorario as $faixa => $dadosHorario): ?>

                        <tr>


                            <!-- =============================
                                 HORÁRIO
                                 ============================= -->

                            <th class="col-horario">

                                <?= $dadosHorario['inicio'] ?>

                                <br>

                                <span>
                                    até
                                </span>

                                <br>

                                <?= $dadosHorario['fim'] ?>

                            </th>


                            <!-- =============================
                                 DIAS
                                 ============================= -->

                            <?php foreach ($dias as $chave => $nome): ?>

                                <td>

                                    <?php

                                    $aula =
                                        $horariosPorDia[$chave][$faixa]
                                        ?? null;

                                    ?>


                                    <?php if ($aula): ?>

                                        <div class="aula">


                                            <!-- MATÉRIA -->

                                            <strong class="aula-materia">

                                                <?= Security::escapeHTML(
                                                    $aula['materia']
                                                ) ?>

                                            </strong>


                                            <!-- PROFESSOR -->

                                            <span class="aula-professor">

                                                <?= Security::escapeHTML(
                                                    $aula['professor']
                                                ) ?>

                                            </span>


                                        </div>

                                    <?php else: ?>

                                        <span class="aula-vazia">
                                            —
                                        </span>

                                    <?php endif; ?>

                                </td>

                            <?php endforeach; ?>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>

</html>