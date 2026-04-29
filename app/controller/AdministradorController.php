<?php
require_once __DIR__ . '/../dao/AdministradorDAO.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdministradorController {

    public function index() {

        $dao = new AdministradorDAO();

        $busca = $_GET['busca'] ?? null;

        if($busca){
            $administradores = $dao->buscar($busca);
        } else{
            $administradores = $dao->listar();
        }

        require __DIR__ . '/../../public/view/listar_administrador.php';
    }

    public function cadastrarAdministrador(){
    
        $nome_completo = $_POST['nome_completo'] ?? null;
        $email = $_POST['email'] ?? null;
        $documento = $_POST['documento'] ?? null;
        $usuario = $_POST['usuario'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $cargo = $_POST['cargo'] ?? null;

        $senha = password_hash($usuario, PASSWORD_DEFAULT);

        $dao = new AdministradorDAO();

        $existe = $dao->administradorExiste($usuario);

        if($existe > 0){
            header("Location: /view/cadastro_administrador.php?error=usuario_existe");
            exit;
        }
        
        $sucesso = $dao->insertAdmin(
            $nome_completo,
            $documento,
            $telefone,
            $email,
            $usuario,
            $senha,
            $cargo
        );


        if ($sucesso) {
    header("Location: /view/cadastro_administrador.php?success=usuario_cadastrado");
} else {
    header("Location: /view/cadastro_administrador.php");
}
exit;   }

public function enviarReset()
{
    $email = $_POST['email'] ?? null;

    if (!$email) {
        echo 'erro: ' . $mail->ErrorInfo;
        return;
    }

    $dao = new AdministradorDAO();

    // 🔍 Buscar usuário pelo e-mail
    $usuarioData = $dao->buscarPorEmailAdm($email);

    if (!$usuarioData) {
        echo 'erro';
        return;
    }

    $usuarioLogin = $usuarioData['usuario'];

    // 🔥 Gerar token
    $token = bin2hex(random_bytes(16));
    $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // 💾 Salvar token no banco
    $dao->salvarToken($email, $token, $expira);

    // 🔗 Link (ajustado)
    $link = "http://localhost:8080/view/login_usuario.php";

    // 🚀 PHPMailer
    $mail = new PHPMailer(true);

    try {
        // CONFIG SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ndkextreemo@gmail.com';
        $mail->Password = 'zcbt navp qxyn dlbn'; // ⚠️ depois coloca isso em variável de ambiente
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // REMETENTE
        $mail->setFrom('ndkextreemo@gmail.com', 'GearSystem');

        // DESTINATÁRIO
        $mail->addAddress($email);

        // CONTEÚDO
        $mail->isHTML(true);
        $mail->charSet = 'UTF-8';
        $mail->Subject = 'Recuperação de acesso - GearSystem';

        $mail->Body = "
<div style='font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 30px;'>

    <div style='max-width: 600px; margin: auto; background: #ffffff; border-radius: 10px; padding: 30px;'>

        <h2 style='color: #0d6efd;'>GearSystem</h2> <h3 style='color: #333;'>Recuperação de senha</h3> <p style='color: #555;'> Olá,<br><br> Recebemos uma solicitação para redefinir sua senha. </p>

        <div style='background: #f1f5f9; padding: 15px; border-radius: 8px; margin: 20px 0;'>

            <p><strong>Usuário:</strong> {$usuarioLogin}</p>
            <p><strong>Senha:</strong> {$usuarioLogin}</p>

        </div>

        <p style='color: #555;'>
            Ao acessar o sistema, você deverá alterar sua senha.
        </p>

        <div style='text-align: center; margin: 30px 0;'>
            <a href='$link' 
               style='background-color: #ffc107; color: #000; padding: 12px 25px; 
                      text-decoration: none; border-radius: 5px; font-weight: bold;'>
                Acessar sistema
            </a>
        </div>

        <p style='color: #777; font-size: 14px;'> Ou copie e cole o link abaixo no navegador:<br> <a href='$link'>$link</a> </p>

        <hr>

        <p style='color: #999; font-size: 12px;'>
            Este e-mail foi enviado automaticamente.<br>
            GearSystem © 2026
        </p>

    </div>
</div>
";

        $mail->send();

        echo 'ok';
    } catch (Exception $e) {
        echo 'erro';
    }
}

}