<?php

require_once '../../app/core/Auth.php';

Auth::requireLevel('professor');

$ctrl = new ProfessorController(Session::get('user_id'));

$turmas = $ctrl->getTurmas();

$turmaId = $_GET['turma_id'] ?? ($turmas[0]['id'] ?? 0);
$materiaId = $_GET['materia_id'] ?? 0;
$bimestre = $_GET['bimestre'] ?? '1';

$alunos = $ctrl->getAlunosDaTurma($turmaId);
$materias = $ctrl->getMateriasPorTurma($turmaId);

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['csrf_token']) &&
        Security::validateCSRF($_POST['csrf_token'])
    ) {

        $notas = $_POST['nota'] ?? [];

        $ctrl->lancarNotas(
            $turmaId,
            $_POST['materia_id'],
            $_POST['bimestre'],
            date('Y'),
            $notas
        );

        $msg = 'Notas lançadas com sucesso!';
    }
}

$csrfToken = Security::generateCSRFToken();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lançar Notas</title>

    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <div class="app-container">

        <?php include '../shared/sidebar_professor.php'; ?>

        <main class="main-content">

            <!-- CABEÇALHO -->

            <div class="page-header notas-page-header">

                <div>

                    <h1>📝 Lançar Notas</h1>

                    <p class="page-description">
                        Selecione a turma, matéria e bimestre para lançar as notas dos alunos.
                    </p>

                </div>

            </div>


            <!-- SELEÇÃO DA TURMA -->

            <div class="notas-turma">

                <form method="GET">

                    <div class="campo-turma">

                        <label for="turma_id">
                            Turma
                        </label>

                        <select
                            name="turma_id"
                            id="turma_id"
                            onchange="this.form.submit()"
                            class="form-input"
                        >

                            <?php foreach ($turmas as $t): ?>

                                <option
                                    value="<?= $t['id'] ?>"
                                    <?= $turmaId == $t['id'] ? 'selected' : '' ?>
                                >
                                    <?= Security::escapeHTML($t['nome']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </form>

            </div>


            <?php if ($alunos): ?>

                <!-- CARD PRINCIPAL -->

                <form method="POST" class="notas-card">

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= $csrfToken ?>"
                    >


                    <?php if ($msg): ?>

                        <div class="alert success">
                            <?= Security::escapeHTML($msg) ?>
                        </div>

                    <?php endif; ?>


                    <!-- FILTROS -->

                    <div class="notas-filtros">

                        <div class="campo-nota">

                            <label for="materia_id">
                                Matéria
                            </label>

                            <select
                                name="materia_id"
                                id="materia_id"
                                class="form-input"
                                required
                            >

                                <?php foreach ($materias as $m): ?>

                                    <option
                                        value="<?= $m['id'] ?>"
                                        <?= $materiaId == $m['id'] ? 'selected' : '' ?>
                                    >
                                        <?= Security::escapeHTML($m['nome']) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <div class="campo-nota">

                            <label for="bimestre">
                                Bimestre
                            </label>

                            <select
                                name="bimestre"
                                id="bimestre"
                                class="form-input"
                                required
                            >

                                <?php for ($b = 1; $b <= 4; $b++): ?>

                                    <option
                                        value="<?= $b ?>"
                                        <?= $bimestre == $b ? 'selected' : '' ?>
                                    >
                                        <?= $b ?>º Bimestre
                                    </option>

                                <?php endfor; ?>

                            </select>

                        </div>

                    </div>


                    <!-- TABELA DE ALUNOS -->

                    <div class="notas-tabela">

                        <table class="notas-table">

                            <thead>

                                <tr>

                                    <th>
                                        Aluno
                                    </th>

                                    <th>
                                        Nota
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($alunos as $a): ?>

                                    <tr>

                                        <td>
                                            <?= Security::escapeHTML($a['nome']) ?>
                                        </td>

                                        <td>

                                            <select
                                                name="nota[<?= $a['id'] ?>]"
                                                class="nota-select"
                                            >

                                                <option value="NA">
                                                    NA
                                                </option>

                                                <option value="I">
                                                    I - Insuficiente
                                                </option>

                                                <option value="R">
                                                    R - Regular
                                                </option>

                                                <option value="B">
                                                    B - Bom
                                                </option>

                                                <option value="MB">
                                                    MB - Muito Bom
                                                </option>

                                            </select>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>


                    <!-- BOTÃO -->

                    <div class="notas-acoes">

                        <button
                            class="btn btn-primary btn-salvar-notas"
                            type="submit"
                        >
                            Salvar Notas
                        </button>

                    </div>

                </form>

            <?php else: ?>

                <div class="table-card">

                    <div class="empty-table">
                        Nenhum aluno encontrado nesta turma.
                    </div>

                </div>

            <?php endif; ?>

        </main>

    </div>

</body>

</html>