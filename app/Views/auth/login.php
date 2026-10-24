<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - BiblioSys</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Biblio<span>Sys</span></h2>
            
            <?php if (isset($_SESSION['erro'])): ?>
                <div class="alert alert-error" style="text-align: center; justify-content: center;"><?= $_SESSION['erro'];
                unset($_SESSION['erro']); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>E-mail de Acesso</label>
                    <input type="email" name="email" class="form-control" required value="admin@email.com" placeholder="seu@email.com">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" required value="123456" placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 1rem; margin-top: 8px;">
                    Acessar o Sistema
                </button>
            </form>
        </div>
    </div>
</body>
</html>