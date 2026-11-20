<?php

require_once '../../app/core/Auth.php';

Auth::requireLevel('aluno');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Declaração de Matrícula</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .declaracao-container {
            max-width: 700px;
            margin: 60px auto;
            text-align: center;
        }

        .declaracao-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .declaracao-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .declaracao-card h1 {
            margin-bottom: 10px;
        }

        .declaracao-card p {
            color: #64748b;
            margin-bottom: 30px;
        }

        .btn-declaracao {
            display: inline-block;
            padding: 14px 25px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-declaracao:hover {
            background: #1d4ed8;
        }
    </style>

</head>

<body>

<div class="app-container">

    <?php include '../shared/sidebar_aluno.php'; ?>

    <main class="main-content">

        <div class="content">

            <div class="declaracao-container">

                <div class="declaracao-card">

                    <div class="declaracao-icon">
                        📜
                    </div>

                    <h1>Declaração de Matrícula</h1>

                    <p>
                        Gere sua declaração de matrícula em formato PDF.
                    </p>

                    <form action="gerar_declaracao_pdf.php" method="POST">

                        <button type="submit" class="btn-declaracao">
                            Gerar Declaração em PDF
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>