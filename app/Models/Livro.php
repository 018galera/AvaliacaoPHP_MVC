<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Livro
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all($busca = '')
    {
        if ($busca) {
            $stmt = $this->db->prepare("SELECT * FROM livros WHERE titulo LIKE ? OR autor LIKE ? ORDER BY id DESC");
            $stmt->execute(["%$busca%", "%$busca%"]);
        } else {
            $stmt = $this->db->query("SELECT * FROM livros ORDER BY id DESC");
        }
        return $stmt->fetchAll();
    }

    public function findByCategory($categoria_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM livros WHERE categoria_id = ?");
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($titulo, $autor, $categoria_id)
    {
        $stmt = $this->db->prepare("INSERT INTO livros (titulo, autor, categoria_id) VALUES (?, ?, ?)");
        return $stmt->execute([$titulo, $autor, $categoria_id]);
    }

    public function update($id, $titulo, $autor, $categoria_id)
    {
        $stmt = $this->db->prepare("UPDATE livros SET titulo = ?, autor = ?, categoria_id = ? WHERE id = ?");
        return $stmt->execute([$titulo, $autor, $categoria_id, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM livros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}