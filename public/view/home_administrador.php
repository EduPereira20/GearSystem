<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GearSystem Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

    <aside class="sidebar">
    <h3 class="logo mb-4">⚙ GearSystem</h3>
    <a href="home_administrador.php" class="menu-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="#" class="menu-link"><i class="bi bi-file-earmark-text"></i> Ordem de serviço</a>
    <a href="#" class="menu-link"><i class="bi bi-cash-stack"></i> Faturamento</a>
    <a href="#" class="menu-link"><i class="bi bi-people"></i> Clientes</a>
    <a href="cadastro_mecanicos.php" class="menu-link active" style="background: #1e293b; color: white;"><i class="bi bi-tools"></i> Cadastro de mecânicos</a>
    <a href="#" class="menu-link"><i class="bi bi-hand-index-thumb"></i> Operações manuais</a>

    <button class="btn btn-dark w-100 text-start mt-2" data-bs-toggle="collapse" data-bs-target="#usuariosMenu">
      <i class="bi bi-person"></i> Usuários ▼
    </button>

    <div class="collapse submenu" id="usuariosMenu">
      <a href="/?route=usuario.store" class="submenu-link">Cadastro Usuário</a>
      <a href="/?route=usuarios" class="submenu-link">Listar Usuário</a>    
    
    </div>

    <button class="btn btn-dark w-100 text-start mt-2" data-bs-toggle="collapse" data-bs-target="#adminMenu">
      <i class="bi bi-shield-lock"></i> Administradores ▼
    </button>

    <div class="collapse submenu" id="adminMenu">
      <a href="/index.php?route=admin.cadastro" class="submenu-link">Cadastro Administrador</a>
      <a href="/index.php?route=admin.index" class="submenu-link">Listar Administradores</a>
    </div>
  </aside>

  <main class="content">
    <h2 class="mb-4">Dashboard Principal</h2>

          <div class="row g-4 mb-4">
      <!-- Card 1: Alterado de col-md-4 para col-md-6 -->
      <div class="col-md-6">
        <div class="card-custom">
          <h5>Serviços em aberto</h5>
          <h2>18</h2>
        </div>
      </div>

      <!-- Card 2: Alterado de col-md-4 para col-md-6 -->
      <div class="col-md-6">
        <div class="card-custom">
          <h5>Receita Mensal</h5>
          <h2>R$ 12.400</h2>
        </div>
      </div>
    </div>


    <div class="card-custom">
      <h4>Últimos Serviços</h4>
      <table class="table table-dark mt-3">
        <thead>
          <tr>
            <th>Cliente</th>
            <th>Veículo</th>
            <th>Serviço</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>João Silva</td>
            <td>Civic 2020</td>
            <td>Troca de Óleo</td>
            <td><span class="badge bg-success">Concluído</span></td>
          </tr>
          <tr>
            <td>Maria Souza</td>
            <td>HB20 2022</td>
            <td>Alinhamento</td>
            <td><span class="badge bg-warning">Aberto</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
