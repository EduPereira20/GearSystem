<?php

var_dump($_GET);

$mensagem = '';
$tipo = '';

if (isset($_GET['success'])) {
    if ($_GET['success'] == 'sucess') {
        $mensagem = "Usuário cadastrado com sucesso!";
        $tipo = "success";
    }
}

if (isset($_GET['error'])) {

    switch ($_GET['error']) {
        case 'usuario_existe':
            $mensagem = "Usuário já existe!";
            $tipo = "warning";
            break;

        case 'erro_insercao':
            $mensagem = "Erro ao cadastrar usuário.";
            $tipo = "danger";
            break;

        default:
            $mensagem = "Erro desconhecido.";
            $tipo = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GearSystem - Cadastro de Usuário</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">

  <style>
    body { background: #0f172a; color: white; }

    .form-label { color: #cbd5e1; font-weight: 500; }

    .form-control, .form-select {
      background: #0f172a;
      border: 1px solid #334155;
      color: white;
      padding: 10px;
    }

    .form-control:focus, .form-select:focus {
      background: #0f172a;
      color: white;
      border-color: #38bdf8;
      box-shadow: 0 0 8px rgba(56, 189, 248, 0.3 );
    }

    .form-control::placeholder { color: #64748b; }

    .btn-save {
      background: #38bdf8;
      color: #0f172a;
      font-weight: bold;
      border: none;
      padding: 12px 30px;
      transition: 0.3s;
    }

    .btn-save:hover {
      background: #0ea5e9;
      transform: translateY(-2px);
    }

    .btn-cancel {
      background: transparent;
      border: 1px solid #475569;
      color: #cbd5e1;
      padding: 12px 30px;
    }

    .btn-cancel:hover {
      background: #1e293b;
      color: white;
    }
  </style>
</head>

<body>

<aside class="sidebar">
  <h3 class="logo mb-4">⚙ GearSystem</h3>

  <a href="home_administrador.php" class="menu-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="#" class="menu-link"><i class="bi bi-file-earmark-text"></i> Ordem de serviço</a>
  <a href="#" class="menu-link"><i class="bi bi-cash-stack"></i> Faturamento</a>
  <a href="#" class="menu-link"><i class="bi bi-people"></i> Clientes</a>

  <a href="cadastro_mecanicos.php" class="menu-link active" style="background: #1e293b; color: white;">
    <i class="bi bi-tools"></i> Cadastro de mecânicos
  </a>

  <a href="#" class="menu-link"><i class="bi bi-hand-index-thumb"></i> Operações manuais</a>

  <button class="btn btn-dark w-100 text-start mt-2" data-bs-toggle="collapse" data-bs-target="#usuariosMenu">
    <i class="bi bi-person"></i> Usuários ▼
  </button>

  <div class="collapse submenu" id="usuariosMenu">
    <a href="cadastro_usuario.php" class="submenu-link">Cadastro Usuário</a>
    <a href="listar_usuarios.php" class="submenu-link">Listar Usuário</a>
  </div>

  <button class="btn btn-dark w-100 text-start mt-2" data-bs-toggle="collapse" data-bs-target="#adminMenu">
    <i class="bi bi-shield-lock"></i> Administradores ▼
  </button>

  <div class="collapse submenu" id="adminMenu">
    <a href="#" class="submenu-link">Cadastro Admin</a>
    <a href="#" class="submenu-link">Listar Admin</a>
  </div>
</aside>

<main class="content">

  <!-- 🔥 ALERTA -->
  <?php if ($mensagem): ?>
    <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
      <?= $mensagem ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-plus text-info"></i> Cadastro de Usuário</h2>

    <a href="dashboard.html" class="btn btn-outline-light btn-sm">
      <i class="bi bi-arrow-left"></i> Voltar
    </a>
  </div>

  <div class="card-custom">
    <form action="/index.php?route=usuario.store" method="POST">

      <div class="row g-3">

        <div class="col-12">
          <h5 class="text-info border-bottom border-secondary pb-2 mb-3">
            Informações de Acesso
          </h5>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nome Completo</label>
          <input type="text" name="nome_completo" class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="col-md-5">
          <label class="form-label">CPF</label>
          <input type="text" name="documento" class="form-control" maxlength="14" oninput="mascaraCPF(this)" required>
        </div>

        <div class="col-md-7">
          <label class="form-label">Usuário</label>
          <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="col-md-7">
          <label class="form-label">Telefone</label>
          <input type="tel" name="telefone" class="form-control" maxlength="15" oninput="mascaraTelefone(this)" required>
        </div>

        <div class="col-md-5">
          <label class="form-label">Cargo / Função</label>
          <input type="text" name="setor" class="form-control">
        </div>

      </div>

      <div class="col-12 mt-5 d-flex justify-content-end gap-3">
        <button type="reset" class="btn btn-cancel">Limpar</button>
        <button type="submit" class="btn btn-save">Cadastrar Usuário</button>
      </div>

    </form>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function mascaraCPF(i) {
  let v = i.value.replace(/\D/g, "");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d)/, "$1.$2");
  v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  i.value = v;
}

function mascaraTelefone(i) {
  let v = i.value.replace(/\D/g, "");
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
  v = v.replace(/(\d)(\d{4})$/, "$1-$2");
  i.value = v;
}
</script>

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