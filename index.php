<?php

// index.php
declare(strict_types=1);
session_start();

$scriptName = $_SERVER['SCRIPT_NAME'];
$baseDir = str_replace('\\', '/', dirname($scriptName));
define('BASE_URL', ($baseDir === '/' ? '' : $baseDir) . '/');

// Autoloader
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
        return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file))
        require $file;
});

// =====================================================================
// TESTE DE CONEXÃO E ARQUIVO (RAIO-X DO BANCO DE DADOS)
// =====================================================================
// Vamos forçar o carregamento do db.php para ver se ele acha
$arquivoDb = __DIR__ . '/app/Config/db.php';

if (!file_exists($arquivoDb)) {
    die("<h2>ERRO FATAL ENCONTRADO!</h2> O arquivo do banco de dados não existe no caminho: <br><b>" . $arquivoDb . "</b><br><br>Verifique se a pasta se chama exatamente 'Config' e o arquivo 'db.php' (sem .txt no final).");
}

// Se o arquivo existe, tenta usar a classe
require_once $arquivoDb;
if (!class_exists('App\Config\Database')) {
    die("<h2>ERRO DE NAMESPACE!</h2> O arquivo existe, mas a classe 'Database' não foi encontrada lá dentro. Verifique se a linha 2 do db.php é exatamente: <b>namespace App\Config;</b>");
}

// Tenta conectar de verdade
try {
    \App\Config\Database::getConnection();
} catch (\Exception $e) {
    die("<h2>ERRO NO MYSQL!</h2> O arquivo está certo, mas não conectou ao banco. Verifique se o MySQL está verde no XAMPP. Erro: " . $e->getMessage());
}
// =====================================================================


// Roteamento
$route = $_GET['route'] ?? 'auth/login';
$routeParts = explode('/', $route);
$rotaBase = ucfirst($routeParts[0]);

if ($rotaBase === 'Livros')
    $rotaBase = 'Livro';
if ($rotaBase === 'Categorias')
    $rotaBase = 'Categoria';

$controllerName = 'App\\Controllers\\' . $rotaBase . 'Controller';
$methodName = $routeParts[1] ?? 'index';

// Auth Check
if (!isset($_SESSION['user']) && $routeParts[0] !== 'auth' && $routeParts[0] !== 'api') {
    header('Location: ' . BASE_URL . 'index.php?route=auth/login');
    exit;
}

// Executa o Controller e o Método
if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    http_response_code(404);
    echo "<h1>404 - Página não encontrada</h1>";
    echo "<p>O sistema tentou carregar a classe: <b>" . htmlspecialchars($controllerName) . "</b></p>";
}