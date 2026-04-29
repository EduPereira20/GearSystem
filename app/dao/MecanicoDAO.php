<?php

require_once __DIR__ . '/../config/database.php';

class MecanicoDAO
{
    public function insert($nome, $especialidade, $telefone, $email)
    {
        $conn = Database::connect();

        $sql = "INSERT INTO mecanicos 
                (nome_completo, especialidade, telefone, email)
                VALUES (:nome, :especialidade, :telefone, :email)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':especialidade', $especialidade);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $conn->lastInsertId();
    }

    public function listarMecanico() {
        $conn = Database::connect();
        $sql = "SELECT * FROM mecanicos ORDER BY id_mecanico DESC";
        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
