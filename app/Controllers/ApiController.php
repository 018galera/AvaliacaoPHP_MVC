<?php

namespace App\Controllers;

use App\Models\Livro;

class ApiController
{
    private $model;

    public function __construct()
    {
        $this->model = new Livro();
    }

    public function livros()
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->all());
    }

    public function inserir()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['titulo'], $input['autor'], $input['categoria_id'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados incompletos']);
            return;
        }

        $this->model->create($input['titulo'], $input['autor'], $input['categoria_id']);
        echo json_encode(['sucesso' => true]);
    }

    public function excluir()
    {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
            echo json_encode(['sucesso' => true]);
        } else {
            http_response_code(404);
            echo json_encode(['erro' => 'Livro não encontrado']);
        }
    }
}