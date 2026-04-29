<?php
$mensagem = '';
$tipo = '';

if (isset($_GET['error'])) {
    if ($_GET['error'] === 'login_invalido') {
        $mensagem = "Usuário ou senha inválidos!";
        $tipo = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GearSystem - Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

  <div class="login-card text-center">

    <!-- LOGO -->
    <div class="mb-4">
      <i class="bi bi-gear-fill login-icon"></i>
      <h2 class="logo mt-2">GearSystem</h2>
      <p class="text-light">Sistema de Gestão Automotiva</p>
    </div>

    <!-- ALERTA -->
    <?php if ($mensagem): ?>
      <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        <?= $mensagem ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <!-- FORM -->
    <form action="/index.php?route=login" method="POST">

      <div class="mb-3 text-start">
        <label class="form-label">Usuário</label>
        <input 
          type="text" 
          name="usuario" 
          class="form-control" 
          placeholder="Digite seu usuário"
          required
        >
      </div>

      <div class="mb-3 text-start">
        <label class="form-label">Senha</label>
        <input 
          type="password" 
          name="senha" 
          class="form-control" 
          placeholder="Digite sua senha"
          required
        >
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-login">
          Entrar no Sistema
        </button>
      </div>

      <small class="text-secondary">
        © 2026 GearSystem - Todos os direitos reservados
      </small>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
  </script>

</body>
</html>