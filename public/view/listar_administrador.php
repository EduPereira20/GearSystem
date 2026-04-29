<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>GearSystem - Listar Usuários</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- O link abaixo assume que seu CSS está na pasta styles -->
<link rel="stylesheet" href="../styles/dashboard.css">

<style>
body {
    background: #0f172a;
    color: white;
    overflow-x: hidden;
}

.sidebar {
    width: 280px;
    min-height: 100vh;
    background: #111827;
    padding: 20px;
    position: fixed;
}

.content {
    margin-left: 280px;
    padding: 30px;
}

.logo {
    font-size: 1.8rem;
    font-weight: bold;
    color: #38bdf8;
}

.menu-link, .submenu-link {
    color: #cbd5e1;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 10px;
    transition: .3s;
}

.menu-link:hover, .submenu-link:hover {
    background: #1e293b;
    color: white;
}

.submenu {
    padding-left: 20px;
}

.card-custom {
    background: #1e293b;
    border: none;
    border-radius: 20px;
    padding: 20px;
    color: white;
    box-shadow: 0 10px 25px rgba(0,0,0,.25 );
}

.table {
    border-radius: 15px;
    overflow: hidden;
}

.modal-content {
    border-radius: 20px;
}

/* Estilo para o placeholder */
.form-control::placeholder {
    color: #64748b;
    opacity: 1;
}
</style>
</head>
<body>

<!-- SIDEBAR -->
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
    <h2 class="mb-4">Gerenciar Usuários</h2>

  <div class="card-custom">
    <h4 class="mb-3">Buscar Usuário</h4>

    <form method="GET" action="">
        <input type="hidden" name="route" value="admin.index">

        <div class="input-group mb-4">
            <input 
                type="text" 
                name="busca"
                value="<?= $_GET['busca'] ?? '' ?>"
                class="form-control bg-dark text-white border-secondary" 
                placeholder="Digite nome ou e-mail do administrador"
            >

            <button class="btn btn-primary">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </form>


        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
<?php if (count($administradores) > 0): ?>
    
    <?php foreach ($administradores as $admin): ?>
        <tr>
            <td><?= htmlspecialchars($admin['nome_completo']) ?></td>
            <td><?= htmlspecialchars($admin['email']) ?></td>
            <td><?= htmlspecialchars($admin['usuario']) ?></td>
            <td><span class="badge bg-success">Ativo</span></td>
            <td>
                <button 
    type="button"
    class="btn btn-warning btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#resetModal"
    onclick="prepararReset('<?= $admin['nome_completo'] ?>', '<?= $admin['email'] ?>')"
>
    <i class="bi bi-key"></i> Reiniciar Senha
</button>
            </td>
        </tr>
    <?php endforeach; ?>

<?php else: ?>

    <tr>
        <td colspan="5" class="text-center">Nenhum usuário encontrado</td>
    </tr>

<?php endif; ?>
</tbody>
        </table>
    </div>
</main>


<div class="modal fade" id="resetModal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Confirmar Reinício de Senha</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Você está prestes a reiniciar a senha de <strong id="resetNome">...</strong>.  
  

                Um e-mail com instruções será enviado para: <strong id="resetEmail">...</strong>
            </div>
            <div class="modal-footer border-secondary">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                <button class="btn btn-warning" onclick="executarReset(event)">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Função para preencher os dados no modal antes de abrir
function prepararReset(nome, email) {
    document.getElementById('resetNome').innerText = nome;
    document.getElementById('resetEmail').innerText = email;

    emailSelecionado = email;
}

function executarReset(event) {
    let btn = event.target;
    const originalText = btn.innerHTML;

    // estado: carregando
    btn.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Enviando...`;
    btn.disabled = true;

    fetch('/?route=admin.reset', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'email=' + encodeURIComponent(emailSelecionado)
    })
    .then(response => response.text())
    .then(data => {

        // ✅ sucesso
        btn.innerHTML = `<i class="bi bi-check-circle"></i> Enviado!`;
        btn.classList.remove('btn-warning');
        btn.classList.add('btn-success');

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-warning');
            btn.disabled = false;

            const modalElement = document.getElementById('resetModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
        }, 2000);

    })
    .catch(() => {

        // ❌ erro
        btn.innerHTML = `<i class="bi bi-x-circle"></i> Erro ao enviar`;
        btn.classList.remove('btn-warning');
        btn.classList.add('btn-danger');

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-warning');
            btn.disabled = false;
        }, 2000);
    });
}

</script>

</body>
</html>
