CREATE DATABASE IF NOT EXISTS biblioteca_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca_db;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

-- Inserindo dados iniciais para o sistema não começar vazio
INSERT INTO categorias (nome) VALUES ('Ficção Científica'), ('Tecnologia');
INSERT INTO livros (titulo, autor, categoria_id) VALUES ('Duna', 'Frank Herbert', 1), ('Clean Code', 'Robert Martin', 2);