<?php
require_once __DIR__ . '../../app/controller/AdministradorController.php';

$dao = new AdministradorDAO();

$dados = $dao->listar();

echo "<pre>";
print_r($dados);
echo "</pre>";

?>