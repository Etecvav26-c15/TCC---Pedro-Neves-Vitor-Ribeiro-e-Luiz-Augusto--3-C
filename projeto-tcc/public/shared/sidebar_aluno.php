
<?php

$paginaAtual = basename(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

$ativo = function (string $arquivo) use ($paginaAtual): string {
    return $paginaAtual === basename($arquivo) ? 'active' : '';
};

?>

<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo">📚</div>
        <span class="system-name">Escolar</span>
    </div>

    <nav class="sidebar-nav">

        <a href="../aluno/dashboard.php"
           class="sidebar-link <?= $ativo('dashboard.php') ?>"
           <?= $ativo('dashboard.php') ? 'aria-current="page"' : '' ?>>
            📋 Página Inicial
        </a>

        <a href="../aluno/boletim.php"
           class="sidebar-link <?= $ativo('boletim.php') ?>"
           <?= $ativo('boletim.php') ? 'aria-current="page"' : '' ?>>
            📊 Boletim
        </a>

        <a href="../aluno/faltas.php"
           class="sidebar-link <?= $ativo('faltas.php') ?>"
           <?= $ativo('faltas.php') ? 'aria-current="page"' : '' ?>>
            📅 Faltas
        </a>

        <a href="../aluno/horarios.php"
           class="sidebar-link <?= $ativo('horarios.php') ?>"
           <?= $ativo('horarios.php') ? 'aria-current="page"' : '' ?>>
            ⏰ Horários
        </a>

        <a href="../aluno/mensagens.php"
           class="sidebar-link <?= $ativo('mensagens.php') ?>"
           <?= $ativo('mensagens.php') ? 'aria-current="page"' : '' ?>>
            💬 Mensagens
        </a>

        <a href="../aluno/declaracao.php"
           class="sidebar-link <?= $ativo('declaracao.php') ?>"
           <?= $ativo('declaracao.php') ? 'aria-current="page"' : '' ?>>
            📄 Declaração
        </a>

        <a href="../logout.php" class="sidebar-link">
            🚪 Sair
        </a>

    </nav>
</aside>
