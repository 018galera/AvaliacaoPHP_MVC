<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>BiblioSys - Gestão de Acervo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">
</head>
<body>
    <aside class="sidebar">
        <div class="brand">Biblio<span>Sys</span></div>
        <nav class="nav-links">
            <a href="<?= BASE_URL ?>index.php?route=livros/index" class="<?= strpos($_SERVER['REQUEST_URI'], 'livros') !== false ? 'active' : '' ?>">
                📚 Acervo de Livros
            </a>
            <a href="<?= BASE_URL ?>index.php?route=categorias/index" class="<?= strpos($_SERVER['REQUEST_URI'], 'categorias') !== false ? 'active' : '' ?>">
                📑 Categorias
            </a>
            <a href="<?= BASE_URL ?>index.php?route=api/livros" target="_blank">
                ⚙️ API JSON
            </a>
            <a href="<?= BASE_URL ?>index.php?route=auth/logout" class="logout" style="margin-top: auto;">
                🚪 Sair do Sistema
            </a>
        </nav>
    </aside>
    
    <main class="main-content">
        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success"><?= $_SESSION['sucesso'];
            unset($_SESSION['sucesso']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error"><?= $_SESSION['erro'];
            unset($_SESSION['erro']); ?></div>
        <?php endif; ?>