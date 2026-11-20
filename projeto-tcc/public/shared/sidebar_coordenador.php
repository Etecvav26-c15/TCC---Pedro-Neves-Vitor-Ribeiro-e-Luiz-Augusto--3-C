
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

        <a href="../coordenador/dashboard.php"
           class="sidebar-link <?= $ativo('dashboard.php') ?>"
           <?= $ativo('dashboard.php') ? 'aria-current="page"' : '' ?>>
            📋 Página Inicial
        </a>

        <a href="../coordenador/cadastrar-aluno.php"
           class="sidebar-link <?= $ativo('cadastrar-aluno.php') ?>"
           <?= $ativo('cadastrar-aluno.php') ? 'aria-current="page"' : '' ?>>
            👤 Cadastrar Aluno
        </a>

        <a href="../coordenador/cadastrar-funcionario.php"
           class="sidebar-link <?= $ativo('cadastrar-funcionario.php') ?>"
           <?= $ativo('cadastrar-funcionario.php') ? 'aria-current="page"' : '' ?>>
            👥 Cadastrar Funcionário
        </a>

        <a href="../coordenador/gerenciar-turmas.php"
           class="sidebar-link <?= $ativo('gerenciar-turmas.php') ?>"
           <?= $ativo('gerenciar-turmas.php') ? 'aria-current="page"' : '' ?>>
            🏫 Gerenciar Turmas
        </a>

        <a href="../coordenador/cadastrar-materia.php"
           class="sidebar-link <?= $ativo('cadastrar-materia.php') ?>"
           <?= $ativo('cadastrar-materia.php') ? 'aria-current="page"' : '' ?>>
            📖 Cadastrar Matéria
        </a>

        <a href="../coordenador/cadastrar-horario.php"
           class="sidebar-link <?= $ativo('cadastrar-horario.php') ?>"
           <?= $ativo('cadastrar-horario.php') ? 'aria-current="page"' : '' ?>>
            ⏱️ Cadastrar Horário
        </a>

        <a href="../coordenador/gerenciar-horarios.php"
           class="sidebar-link <?= $ativo('gerenciar-horarios.php') ?>"
           <?= $ativo('gerenciar-horarios.php') ? 'aria-current="page"' : '' ?>>
            📅 Gerenciar Horários
        </a>

        <a href="../coordenador/designar-professores.php"
           class="sidebar-link <?= $ativo('designar-professores.php') ?>"
           <?= $ativo('designar-professores.php') ? 'aria-current="page"' : '' ?>>
            🔗 Designar Professores
        </a>

        <a href="../coordenador/relatorios.php"
           class="sidebar-link <?= $ativo('relatorios.php') ?>"
           <?= $ativo('relatorios.php') ? 'aria-current="page"' : '' ?>>
            📊 Relatórios
        </a>

        <a href="../logout.php" class="sidebar-link">
            🚪 Sair
        </a>

    </nav>
</aside>
