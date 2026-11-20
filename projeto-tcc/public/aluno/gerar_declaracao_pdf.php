<?php

ob_start();

require_once __DIR__ . '/../../libs/fpdf/fpdf.php';
require_once __DIR__ . '/../../app/core/Auth.php';
require_once __DIR__ . '/../../app/core/Session.php';
require_once __DIR__ . '/../../app/controllers/AlunoController.php';


// ======================================================
// VERIFICA SE É UM ALUNO LOGADO
// ======================================================

Auth::requireLevel('aluno');

$alunoId = Session::get('user_id');


// ======================================================
// BUSCA OS DADOS DO ALUNO
// ======================================================

$controller = new AlunoController($alunoId);

$dados = $controller->gerarDeclaracao();

$aluno = $dados['aluno'];


// ======================================================
// DADOS VINDOS DO BANCO
// ======================================================

$nome = $aluno['nome'];
$matricula = $aluno['matricula'];
$turma = $aluno['turma'];
$anoLetivo = $aluno['ano_letivo'];


// ======================================================
// DATA
// ======================================================

$dataGeracao = date('d/m/Y');
$horaGeracao = date('H:i:s');

$dataValidade = date('d/m/Y', strtotime('+30 days'));


// ======================================================
// CRIA O PDF
// ======================================================

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->SetMargins(20, 15, 20);


// ======================================================
// CABEÇALHO
// ======================================================

$pdf->SetFont('Arial', '', 9);

$pdf->Ln(2);

$pdf->SetFont('Arial', '', 8);

$pdf->Ln(8);


// ======================================================
// TÍTULO
// ======================================================

$pdf->SetFont('Arial', 'B', 15);

$pdf->Cell(
    0,
    10,
    utf8_decode('DECLARAÇÃO DE MATRÍCULA'),
    0,
    1,
    'C'
);

$pdf->Ln(10);


// ======================================================
// TEXTO PRINCIPAL
// ======================================================

$pdf->SetFont('Arial', '', 11);

$texto1 =
    'Declaramos para os devidos fins que ' .
    $nome .
    ', portador(a) do RA ' .
    $matricula .
    ', é aluno(a) regularmente matriculado(a) nesta Unidade de Ensino, ' .
    'na turma ' .
    $turma .
    ', no ano letivo de ' .
    $anoLetivo .
    '.';

$pdf->MultiCell(
    0,
    7,
    utf8_decode($texto1),
    0,
    'J'
);

$pdf->Ln(8);


// ======================================================
// SEGUNDO TEXTO
// ======================================================

$pdf->MultiCell(
    0,
    7,
    utf8_decode(
        'A presente declaração é emitida para fins de comprovação de matrícula e frequência escolar.'
    ),
    0,
    'J'
);

$pdf->Ln(8);


// ======================================================
// DADOS DO ALUNO
// ======================================================

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(
    0,
    7,
    utf8_decode('Informações do aluno'),
    0,
    1,
    'L'
);

$pdf->SetFont('Arial', '', 10);

$pdf->Cell(
    0,
    7,
    utf8_decode('Aluno: ' . $nome),
    0,
    1,
    'L'
);

$pdf->Cell(
    0,
    7,
    utf8_decode('Matrícula: ' . $matricula),
    0,
    1,
    'L'
);

$pdf->Cell(
    0,
    7,
    utf8_decode('Turma: ' . $turma),
    0,
    1,
    'L'
);

$pdf->Cell(
    0,
    7,
    utf8_decode('Ano letivo: ' . $anoLetivo),
    0,
    1,
    'L'
);

$pdf->Cell(
    0,
    7,
    utf8_decode('Data de emissão: ' . $dataGeracao),
    0,
    1,
    'L'
);

$pdf->Ln(15);


// ======================================================
// ASSINATURA
// ======================================================

$pdf->Cell(
    0,
    8,
    '________________________________________',
    0,
    1,
    'C'
);

$pdf->Cell(
    0,
    7,
    utf8_decode('Responsável pelas informações acadêmicas'),
    0,
    1,
    'C'
);

$pdf->Ln(20);


// ======================================================
// RODAPÉ
// ======================================================

$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(
    0,
    5,
    utf8_decode(
        'Documento gerado eletronicamente pelo Sistema Escolar.'
    ),
    0,
    'L'
);

$pdf->Ln(3);

$pdf->MultiCell(
    0,
    5,
    utf8_decode(
        'Este documento possui validade mediante conferência dos dados apresentados.'
    ),
    0,
    'L'
);

$pdf->Ln(3);

$pdf->Cell(
    0,
    5,
    utf8_decode(
        'Documento gerado em ' . $dataGeracao . ' às ' . $horaGeracao . '.'
    ),
    0,
    1,
    'L'
);

$pdf->Cell(
    0,
    5,
    utf8_decode(
        'Validade: ' . $dataValidade . '.'
    ),
    0,
    1,
    'L'
);


// ======================================================
// GERA O PDF
// ======================================================

ob_end_clean();

$nomeArquivo = 'Declaracao_Matricula_' .
    preg_replace('/[^A-Za-z0-9_-]/', '_', $matricula) .
    '.pdf';

$pdf->Output('I', $nomeArquivo);

exit;