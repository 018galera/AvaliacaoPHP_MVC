<?php

namespace App\Controllers;

use App\Models\Livro;
use App\Models\Categoria;

class LivroController
{
    private $model;
    private $categoriaModel;

    public function __construct()
    {
        $this->model = new Livro();
        $this->categoriaModel = new Categoria();
    }

    public function index()
    {
        $busca = $_GET['busca'] ?? '';
        $livros = $this->model->all($busca);

        // Para exibir o nome da categoria na tabela, buscamos todas
        $categoriasArray = $this->categoriaModel->all();
        // Transforma em array associativo [id => nome] para facilitar a view
        $categorias = [];
        foreach ($categoriasArray as $cat) {
            $categorias[$cat['id']] = $cat;
        }

        require __DIR__ . '/../Views/livros/index.php';
    }

    public function create()
    {
        $categorias = $this->categoriaModel->all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $autor = trim($_POST['autor'] ?? '');
            $categoria_id = $_POST['categoria_id'] ?? '';

            if (empty($titulo) || empty($autor) || empty($categoria_id)) {
                $_SESSION['erro'] = 'Todos os campos são obrigatórios.';
            } else {
                $this->model->create($titulo, $autor, $categoria_id);
                $_SESSION['sucesso'] = 'Livro cadastrado!';
                header('Location: ' . BASE_URL . 'index.php?route=livros/index');
                exit;
            }
        }
        require __DIR__ . '/../Views/livros/form.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $livro = $this->model->find($id);
        $categorias = $this->categoriaModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $autor = trim($_POST['autor'] ?? '');
            $categoria_id = $_POST['categoria_id'] ?? '';

            if (empty($titulo) || empty($autor) || empty($categoria_id)) {
                $_SESSION['erro'] = 'Todos os campos são obrigatórios.';
            } else {
                $this->model->update($id, $titulo, $autor, $categoria_id);
                $_SESSION['sucesso'] = 'Livro atualizado!';
                header('Location: ' . BASE_URL . 'index.php?route=livros/index');
                exit;
            }
        }
        require __DIR__ . '/../Views/livros/form.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
            $_SESSION['sucesso'] = 'Livro excluído.';
        }
        header('Location: ' . BASE_URL . 'index.php?route=livros/index');
    }
}