<?php

// Inicia a sessão para que os dados possam ser armazenados.
session_start();


// Define o Valor "Route" da URL caso exista, senão, só define o start como o inicial (Oq define como a página será carregada)
$route = $_GET ['route'] ?? 'start';

// Só para armazenar o nome do script, para o mesmo ser carregado junto com a URL.
$script = null;

// Usa o switch e os cases para decidir oq carregar, dependendo do valor da route.
switch ($route) {
    case 'start':
    $script = 'start'; // O start será carregado.
    break;

    case 'game':
    $script = 'game'; // O game será carregado.
    break;

    case 'gameover':
    $script = 'gameover'; // O gameover será carregado.
    break;

    // Se a rota não foir nenhuma das anteriores
    default:
        $script = '404';
        break;
}

    // Carrega o banco de dados.
    $capitals = require __DIR__. '/data/capitals.php';

    // Carrega o cabeçalho da página 
    require_once __DIR__. "/scripts/header.php";

    // Vem pra preencher a variável do script lá em cima e decidir o que será carregado.
    require_once __DIR__. "/scripts/$script.php";

    // Carrega o rodapé da página.
    require_once __DIR__. "/scripts/footer.php";
?>