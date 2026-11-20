
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

        <a href="../professor/dashboard.php"
           class="sidebar-link <?= $ativo('dashboard.php') ?>"
           <?= $ativo('dashboard.php') ? 'aria-current="page"' : '' ?>>
            📋 Página Inicial
        </a>

        <a href="../professor/chamada.php"
           class="sidebar-link <?= $ativo('chamada.php') ?>"
           <?= $ativo('chamada.php') ? 'aria-current="page"' : '' ?>>
            ✅ Chamada
        </a>

        <a href="../professor/lancar-notas.php"
           class="sidebar-link <?= $ativo('lancar-notas.php') ?>"
           <?= $ativo('lancar-notas.php') ? 'aria-current="page"' : '' ?>>
            📝 Notas
        </a>

        <a href="../professor/plano-aula.php"
           class="sidebar-link <?= $ativo('plano-aula.php') ?>"
           <?= $ativo('plano-aula.php') ? 'aria-current="page"' : '' ?>>
            📖 Plano de Aula
        </a>

        <a href="../professor/lista-alunos.php"
           class="sidebar-link <?= $ativo('lista-alunos.php') ?>"
           <?= $ativo('lista-alunos.php') ? 'aria-current="page"' : '' ?>>
            👥 Lista de Alunos
        </a>

        <a href="../logout.php" class="sidebar-link">
            🚪 Sair
        </a>

    </nav>
</aside>
