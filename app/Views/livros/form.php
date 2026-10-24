<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="header-actions">
    <h1><?= isset($livro) ? 'Editar Livro' : 'Cadastrar Novo Livro' ?></h1>
</div>

<div class="card" style="max-width: 700px;">
    <form method="POST">
        <div class="form-group">
            <label>Título do Livro</label>
            <input type="text" name="titulo" class="form-control" value="<?= isset($livro) ? htmlspecialchars($livro['titulo']) : '' ?>" required placeholder="Ex: O Senhor dos Anéis">
        </div>
        <div class="form-group">
            <label>Autor</label>
            <input type="text" name="autor" class="form-control" value="<?= isset($livro) ? htmlspecialchars($livro['autor']) : '' ?>" required placeholder="Ex: J.R.R. Tolkien">
        </div>
        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">Selecione uma categoria...</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($livro) && $livro['categoria_id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" class="btn btn-primary">Salvar Registro</button>
            <a href="<?= BASE_URL ?>index.php?route=livros/index" class="btn btn-outline">Cancelar</a>
        </div>
    </form>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>