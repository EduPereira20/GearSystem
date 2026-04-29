<?php

require_once __DIR__ . '/../config/database.php';

class AdministradorDAO { 

    public function listar() {

        try {
            $conn = Database::connect();

            $sql = "SELECT nome_completo, email, usuario FROM administradores";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Erro ao listar administradores: " . $e->getMessage();
            return [];
        }
    }

    public function buscar($busca){

            $conn = Database::connect();

            $sql = 'SELECT * FROM administradores 
                WHERE nome_completo LIKE :busca 
                OR email LIKE :busca';

            $stmt = $conn->prepare($sql);

            $busca = "%$busca%";

            $stmt->bindParam(':busca', $busca);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insertAdmin($nome_completo, $documento, $telefone, $email, $usuario, $senha, $cargo){

    try{
        $conn = Database::connect();

        $sql = "INSERT INTO administradores
                (nome_completo, documento, telefone, email, usuario, senha, cargo)
                VALUES 
                (:nome_completo, :documento, :telefone, :email, :usuario, :senha, :cargo)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome_completo', $nome_completo);
        $stmt->bindParam(':documento', $documento);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cargo', $cargo);

        return $stmt->execute();

    } catch(PDOException $e){
        echo "Erro ao inserir administrador: " . $e->getMessage();
        return false;
        }

    }
    public function administradorExiste($usuario){
        $conn = Database::connect();

        $sql = "SELECT COUNT(*) FROM administradores WHERE usuario = :usuario";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        return $stmt->fetchColumn();
    
}

public function salvarToken($email, $token, $expira)
    {
        $conn = Database::connect();

        $sql = 'UPDATE administradores 
            SET reset_token = :token, token_expira_em = :expira
            WHERE email = :email';

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expira', $expira);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function buscarPorEmailAdm($email) {
        $conn = Database::connect();
    
        $sql = "SELECT * FROM administradores WHERE email = :email LIMIT 1";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
}



}
