<?php

require_once __DIR__ . '/../vendor/autoload.php';

$route = $_GET['route'] ?? 'home';

switch ($route) {

    case 'usuario.store':
        require_once __DIR__ . '/../app/controller/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->store();
        exit;

    case 'admin.index':
        require_once __DIR__ . '/../app/controller/AdministradorController.php';
        $controller = new AdministradorController();
        $controller->index();
        exit;

    case 'usuarios':
        require_once __DIR__ . '/../app/controller/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->listarUsuarios();
        exit;

    case 'admin.cadastro':
        require_once __DIR__ . '/../app/controller/AdministradorController.php';
        $controller = new AdministradorController();
        $controller->cadastrarAdministrador();
        exit;

    case 'login':
        require_once __DIR__ . '/../app/controller/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->login();
        exit;

    case 'trocar.senha':
        require __DIR__ . '/view/trocar_senha.php';
        exit;

    case 'trocar.senha.post':
        require_once __DIR__ . '/../app/controller/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->trocarSenha();
        exit;

    case 'mecanico.cadastro':
        require_once __DIR__ . '/../app/controller/MecanicoController.php';
        $controller = new MecanicoController();
        $controller->index();
        exit;

    case 'mecanico.store':
        require_once __DIR__ . '/../app/controller/MecanicoController.php';
        $controller = new MecanicoController();
        $controller->store();
        exit;

    case 'usuario.reset':
        require_once __DIR__ . '/../app/controller/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->enviarReset();
        exit;

    case 'admin.reset':
        require_once __DIR__ . '/../app/controller/AdministradorController.php';
        $controller = new AdministradorController();
        $controller->enviarReset();
        exit;

    case 'login.form':
        require __DIR__ . '/view/login_usuario.php';
        exit;
        
    default:
        require __DIR__ . '/view/home_administrador.php';
        exit;
}