<?php

require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioController {

    public function store() {

        $nome_completo = $_POST['nome_completo'] ?? null;
        $documento = $_POST['documento'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $setor = $_POST['setor'] ?? null;
        $email = $_POST['email'] ?? null;
        $usuario = $_POST['usuario'] ?? null;

        
        $senha = password_hash($usuario, PASSWORD_DEFAULT);

        $dao = new UsuarioDAO();

        
        $existe = $dao->usuarioExiste($usuario);

        if ($existe > 0) {
            header("Location: /view/cadastro_usuario.php?error=usuario_existe");
            exit;
        }

       
        $sucesso = $dao->insert(
            $nome_completo,
            $documento,
            $telefone,
            $setor,
            $email,
            $usuario,
            $senha
        );

        if ($sucesso) {
            header("Location: /view/cadastro_usuario.php?success=1");
        } else {
            header("Location: /view/cadastro_usuario.php?error=1");
        }

        exit;
    }
}