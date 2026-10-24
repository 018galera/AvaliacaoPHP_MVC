<?php

namespace App\Controllers;

use App\Models\Categoria;

class CategoriaController
{
    private $model;

    public function __construct()
    {
        $this->model = new Categoria();
    }

    public function index()
    {
        $categorias = $this->model->all();
        require __DIR__ . '/../Views/categorias/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            if (empty($nome)) {
                $_SESSION['erro'] = 'O nome da categoria é obrigatório.';
            } else {
                $this->model->create($nome);
                $_SESSION['sucesso'] = 'Categoria criada com sucesso!';
                header('Location: ' . BASE_URL . 'index.php?route=categorias/index');
                exit;
            }
        }
        require __DIR__ . '/../Views/categorias/form.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $categoria = $this->model->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            if (empty($nome)) {
                $_SESSION['erro'] = 'O nome é obrigatório.';
            } else {
                $this->model->update($id, $nome);
                $_SESSION['sucesso'] = 'Categoria atualizada!';
                header('Location: ' . BASE_URL . 'index.php?route=categorias/index');
                exit;
            }
        }
        require __DIR__ . '/../Views/categorias/form.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
            $_SESSION['sucesso'] = 'Categoria excluída (e livros associados).';
        }
        header('Location: ' . BASE_URL . 'index.php?route=categorias/index');
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        $categoria = $this->model->find($id);

        // Instancia o model de Livro para buscar os relacionados
        $livroModel = new \App\Models\Livro();
        $livros = $livroModel->findByCategory($id);

        require __DIR__ . '/../Views/categorias/show.php';
    }
}