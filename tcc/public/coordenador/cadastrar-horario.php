<?php
require_once '../../app/core/Auth.php';

Auth::requireLevel('coordenador');

$db = Database::getInstance();

$vinculos = $db->fetchAll("
SELECT
    ptm.id,
    u.nome AS professor,
    t.nome AS turma,
    m.nome AS materia
FROM professor_turma_materia ptm
JOIN usuarios u ON ptm.professor_id = u.id
JOIN turmas t ON ptm.turma_id = t.id
JOIN materias m ON ptm.materia_id = m.id
ORDER BY turma,materia
");

$msg = "";
$tipo = "";

if($_SERVER['REQUEST_METHOD']=="POST" && Security::validateCSRF($_POST['csrf_token'])){

    $ctrl = new CoordenadorController();

    try{

        $ctrl->cadastrarHorario($_POST);

        $msg="Horário cadastrado com sucesso!";
        $tipo="sucesso";

    }catch(Exception $e){

        $msg=$e->getMessage();
        $tipo="erro";

    }

}

$csrfToken = Security::generateCSRFToken();
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Cadastrar Horário</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<div class="app-container">

<?php include '../shared/sidebar_coordenador.php'; ?>

<main class="main-content">

<h1 style="color:white;">Cadastrar Horário</h1>

<form class="form-card" method="POST">

<input
type="hidden"
name="csrf_token"
value="<?= $csrfToken ?>"
>

<div class="form-group">

<label>Turma / Matéria / Professor</label>

<select
class="form-input"
name="professor_turma_materia_id"
required>

<option value="">Selecione</option>

<?php foreach($vinculos as $v): ?>

<option value="<?= $v['id'] ?>">

<?= $v['turma'] ?>
-
<?= $v['materia'] ?>
-
<?= $v['professor'] ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="form-group">

<label>Dia da semana</label>

<select class="form-input" name="dia_semana">

<option>Segunda</option>

<option>Terça</option>

<option>Quarta</option>

<option>Quinta</option>

<option>Sexta</option>

</select>

</div>

<div class="form-group">

<label>Horário início</label>

<input
type="time"
class="form-input"
name="horario_inicio"
required>

</div>

<div class="form-group">

<label>Horário fim</label>

<input
type="time"
class="form-input"
name="horario_fim"
required>

</div>

<button
class="btn btn-primary"
type="submit">

Cadastrar Horário

</button>

</form>

</main>

</div>

<?php if($msg): ?>

<div id="toast" class="toast <?= $tipo ?>">

<div class="toast-icon">

<?= $tipo=="sucesso" ? "✅":"❌"; ?>

</div>

<div class="toast-content">

<div class="toast-title">

<?= $tipo=="sucesso" ? "Sucesso":"Erro"; ?>

</div>

<div class="toast-message">

<?= htmlspecialchars($msg) ?>

</div>

</div>

</div>

<?php endif; ?>

<script src="../assets/js/toast.js"></script>

</body>

</html>