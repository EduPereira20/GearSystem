<?php

require_once __DIR__ . '/../config/database.php';

class UsuarioDAO {

    public function usuarioExiste($usuario) {

        $conn = Database::connect();

        $sql = "SELECT COUNT(*) FROM usuario WHERE usuario = :usuario";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function insert($nome_completo, $documento, $telefone, $setor, $email, $usuario, $senha) {

        try {
            $conn = Database::connect();

            $dataCadastro = date('Y-m-d H:i:s');

            $sql = "INSERT INTO usuario 
                    (nome_completo, documento, telefone, setor, email, usuario, senha, data_cadastro)
                    VALUES 
                    (:nome_completo, :documento, :telefone, :setor, :email, :usuario, :senha, :data_cadastro)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nome_completo', $nome_completo);
            $stmt->bindParam(':documento', $documento);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':setor', $setor);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':data_cadastro', $dataCadastro);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro ao inserir usuário: " . $e->getMessage());
            return false;
        }
    }

    public function listar()
    {
        $conn = Database::connect();

        if (!$conn) {
            die('Erro: conexão com banco falhou');
        }

        $sql = 'SELECT * FROM usuario';
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($busca)
    {
        $conn = Database::connect();

        $sql = 'SELECT * FROM usuario 
            WHERE nome_completo LIKE :busca 
            OR email LIKE :busca';

        $stmt = $conn->prepare($sql);

        $busca = "%$busca%";

        $stmt->bindParam(':busca', $busca);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorUsuario($usuario)
{
    $conn = Database::connect();

    $sql = "SELECT * FROM usuario WHERE usuario = :usuario LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function atualizarSenha($id, $senha) {

    $conn = Database::connect();

    $sql = "UPDATE usuario 
            SET senha = :senha, primeiro_login = 0 
            WHERE id_usuario = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

public function salvarToken($email, $token, $expira)
    {
        $conn = Database::connect();

        $sql = 'UPDATE usuario 
            SET reset_token = :token, token_expira_em = :expira
            WHERE email = :email';

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expira', $expira);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function buscarPorEmail($email) {
        $conn = Database::connect();
    
        $sql = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
}
}