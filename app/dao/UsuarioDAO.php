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
}