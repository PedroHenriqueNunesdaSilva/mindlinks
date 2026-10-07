<?php
require_once 'auth_check.php';
/** @var PDO $pdo */
/** @var string $tema */
/** @var string $idioma */
// $pdo, $tema e $idioma já vêm prontos do auth_check.php

$usuario = $_SESSION['usuario'];

// --- MOCK: enquanto não existe tabela de comunidades no banco.
// Quando existir, isso vira dois SELECT usando $pdo, no mesmo formato de array.
$comunidadesEmAlta = [
    ['id' => 1, 'nome' => 'Devs PHP BR',       'membros' => 812,  'icone' => 'fa-code'],
    ['id' => 2, 'nome' => 'Astronomia Curiosa','membros' => 540,  'icone' => 'fa-meteor'],
    ['id' => 3, 'nome' => 'Games Retro',       'membros' => 1203, 'icone' => 'fa-gamepad'],
    ['id' => 4, 'nome' => 'Culinária Vegana',  'membros' => 390,  'icone' => 'fa-carrot'],
];

$minhasComunidades = [
    ['id' => 1, 'nome' => 'Devs PHP BR',       'icone' => 'fa-code'],
    ['id' => 5, 'nome' => 'Cine Clube',        'icone' => 'fa-film'],
    ['id' => 6, 'nome' => 'Estudos de Física', 'icone' => 'fa-atom'],
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($idioma) ?>" data-tema="<?= htmlspecialchars($tema) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= t('inicio') ?> - MIND LINKS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">Mind Links</div>
    <ul class="nav-links">
        <li><a href="principal.php" ><?= t('inicio') ?></a></li>
        <li><a href="homepage.php" class="ativo"><?= t('home_page') ?></a></li>
        <li><a href="perfil.php"><?= t('seu_perfil') ?></a></li>
        <li><a href="configuracoes.php"><?= t('configuracoes') ?></a></li>
    </ul>
</nav>

<div class="app-layout">

    <!-- SIDEBAR: ícones circulares, cada um é uma comunidade que o usuário já participa -->
    <aside class="sidebar-comunidades">
        <?php foreach ($minhasComunidades as $c): ?>
            <a href="#" class="icone-comunidade" title="<?= htmlspecialchars($c['nome']) ?>">
                <i class="fa-solid <?= htmlspecialchars($c['icone']) ?>"></i>
            </a>
        <?php endforeach; ?>

        <a href="#" class="icone-comunidade icone-adicionar" title="<?= t('adicionar_comunidade') ?>">
            <i class="fa-solid fa-plus"></i>
        </a>
    </aside>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="conteudo-principal">
        <h2 class="titulo-secao"><?= t('comunidades_em_alta') ?></h2>

        <div class="carrossel-wrapper">
            <div class="carrossel-track">
                <?php foreach ($comunidadesEmAlta as $c): ?>
                    <div class="card-comunidade">
                        <i class="fa-solid <?= htmlspecialchars($c['icone']) ?>"></i>
                        <p class="card-nome"><?= htmlspecialchars($c['nome']) ?></p>
                        <span class="card-membros"><?= (int) $c['membros'] ?> membros</span>
                    </div>
                <?php endforeach; ?>

                <?php // conjunto duplicado — truque para o loop do carrossel ficar invisível ?>
                <?php foreach ($comunidadesEmAlta as $c): ?>
                    <div class="card-comunidade" aria-hidden="true">
                        <i class="fa-solid <?= htmlspecialchars($c['icone']) ?>"></i>
                        <p class="card-nome"><?= htmlspecialchars($c['nome']) ?></p>
                        <span class="card-membros"><?= (int) $c['membros'] ?> membros</span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

</div>

</body>
</html>