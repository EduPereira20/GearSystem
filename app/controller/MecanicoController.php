<?php

require_once __DIR__ . '/../dao/MecanicoDAO.php';

class MecanicoController
{
    public function store()
    {
        $nome = $_POST['nome_completo'] ?? null;
        $especialidade = $_POST['especialidade'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $email = $_POST['email'] ?? null;

        $dao = new MecanicoDAO();

        $id = $dao->insert($nome, $especialidade, $telefone, $email);

        header("Location: /?route=mecanico.cadastro&success=1&id=$id");
        exit;
    }

    public function index()
    {
        $dao = new MecanicoDAO();

        $mecanicos = $dao->listarMecanico();

    
        require __DIR__ . '/../../public/view/cadastro_mecanicos.php';
    }
}
