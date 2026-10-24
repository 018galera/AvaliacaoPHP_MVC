<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="header-actions">
    <h1>Catálogo de Livros</h1>
    <a href="<?= BASE_URL ?>index.php?route=livros/create" class="btn btn-primary">+ Novo Livro</a>
</div>

<div class="card">
    <form method="GET" style="display: flex; gap: 12px; margin-bottom: 24px;">
        <input type="hidden" name="route" value="livros/index">
        <input type="text" name="busca" class="form-control" placeholder="Pesquisar por título ou autor..." value="<?= htmlspecialchars($busca) ?>" style="max-width: 400px;">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <?php if ($busca): ?>
            <a href="<?= BASE_URL ?>index.php?route=livros/index" class="btn btn-outline">Limpar Filtro</a>
        <?php endif; ?>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título do Livro</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                <tr>
                    <td style="color: var(--text-muted);">#<?= $livro['id'] ?></td>
                    <td style="font-weight: 500;"><?= htmlspecialchars($livro['titulo']) ?></td>
                    <td style="color: var(--text-muted);"><?= htmlspecialchars($livro['autor']) ?></td>
                    <td>
                        <span class="badge">
                            <?= htmlspecialchars($categorias[$livro['categoria_id']]['nome'] ?? 'Sem Categoria') ?>
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= BASE_URL ?>index.php?route=livros/edit&id=<?= $livro['id'] ?>" class="btn btn-outline" style="margin-right: 8px;">Editar</a>
                        <a href="<?= BASE_URL ?>index.php?route=livros/delete&id=<?= $livro['id'] ?>" class="btn btn-danger" onclick="return confirm('Excluir este livro?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($livros)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 40px;">Nenhum livro encontrado no acervo.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>