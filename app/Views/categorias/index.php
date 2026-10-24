<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="header-actions">
    <h1>Gestão de Categorias</h1>
    <a href="<?= BASE_URL ?>index.php?route=categorias/create" class="btn btn-primary">+ Nova Categoria</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Categoria</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td style="color: var(--text-muted);">#<?= $cat['id'] ?></td>
                    <td style="font-weight: 500;"><?= htmlspecialchars($cat['nome']) ?></td>
                    <td style="text-align: right;">
                        <a href="<?= BASE_URL ?>index.php?route=categorias/show&id=<?= $cat['id'] ?>" class="btn btn-outline" style="margin-right: 8px;">Ver Livros</a>
                        <a href="<?= BASE_URL ?>index.php?route=categorias/edit&id=<?= $cat['id'] ?>" class="btn btn-outline" style="margin-right: 8px;">Editar</a>
                        <a href="<?= BASE_URL ?>index.php?route=categorias/delete&id=<?= $cat['id'] ?>" class="btn btn-danger" onclick="return confirm('Atenção: Excluir esta categoria apagará todos os livros vinculados a ela. Deseja continuar?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>