<?php

$route = $_GET['route'] ?? 'home';

if ($route === 'usuario.store') {
    require_once __DIR__ . '/../app/controller/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->store();
}

header("Location: /view/cadastro_usuario.php");
exit;