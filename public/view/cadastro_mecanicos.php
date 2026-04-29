<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GearSystem - Cadastro de Mecânico</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- O link abaixo assume que seu CSS está na pasta styles, conforme seu arquivo anterior -->
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link rel="stylesheet" href="../assets/css/style_mecanico.css">
<body>

 <!-- funcao para mostrar formatado as opções da especialidade do mecanico -->

 <?php
function formatarEspecialidade($valor)
{
  return match ($valor) {
    'motor' => 'Motor / Câmbio',
    'suspensao' => 'Suspensão / Freios',
    'eletrica' => 'Elétrica / Injeção',
    'alinhamento' => 'Alinhamento / Balanceamento',
    'geral' => 'Mecânica Geral',
    default => $valor
  };
}
?>


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
      <a href="cadastro_usuario.php" class="submenu-link">Cadastro Usuário</a>
      <a href="listar_usuarios.php" class="submenu-link">Listar Usuário</a>
    </div>

    <button class="btn btn-dark w-100 text-start mt-2" data-bs-toggle="collapse" data-bs-target="#adminMenu">
      <i class="bi bi-shield-lock"></i> Administradores ▼
    </button>

    <div class="collapse submenu" id="adminMenu">
      <a href="/index.php?route=admin.cadastro" class="submenu-link">Cadastro Admin</a>
      <a href="#" class="submenu-link">Listar Admin</a>
    </div>
  </aside>

  <main class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2><i class="bi bi-person-plus-fill text-info"></i> Cadastro de Mecânico</h2>
      <a href="dashboard.html" class="btn btn-outline-light btn-sm">
        <i class="bi bi-arrow-left"></i> Voltar
      </a>
    </div>

  <div class="card-custom">

    <!-- ALERTA DE SUCESSO -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>

            <div>
                <strong>Mecânico cadastrado com sucesso!</strong><br>

                <?php if (isset($_GET['id'])): ?>
                    Número do mecânico:
                    <strong>
                        MEC-<?= str_pad($_GET['id'], 5, '0', STR_PAD_LEFT) ?>
                    </strong>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- FORMULÁRIO -->
    <form action="/?route=mecanico.store" method="POST">

        <div class="row g-3">

            <div class="col-12">
                <h5 class="text-info border-bottom border-secondary pb-2 mb-3">
                    Dados do Mecânico
                </h5>
            </div>

            <div class="col-md-8">
                <label class="form-label">Nome Completo</label>
                <input type="text" name="nome_completo" class="form-control"
                       placeholder="Ex: Ricardo Oliveira" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Telefone</label>
                <input type="tel" name="telefone" class="form-control"
                       placeholder="(00) 00000-0000"
                       maxlength="15"
                       oninput="mascaraTelefone(this)"
                       required>
            </div>

            <div class="col-md-8">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control"
                       placeholder="mecanico@gearsystem.com" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Especialidade</label>
                <select name="especialidade" class="form-select" required>
                    <option value="" selected disabled>Selecione...</option>
                    <option value="motor">Motor / Câmbio</option>
                    <option value="suspensao">Suspensão / Freios</option>
                    <option value="eletrica">Elétrica / Injeção</option>
                    <option value="alinhamento">Alinhamento / Balanceamento</option>
                    <option value="geral">Mecânica Geral</option>
                </select>
            </div>

            <div class="col-12 mt-4 d-flex justify-content-end gap-3">
                <button type="reset" class="btn btn-secondary">Limpar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

        </div>
    </form>
    </div>
  </div>
     

<div class="mt-5">

    <h4 class="text-info mb-4">
        <i class="bi bi-tools"></i> Lista de Mecânicos
    </h4>

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle shadow-sm rounded">

            <thead class="table-secondary text-dark">
                <tr>
                    <th>Número Registro</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Especialidade</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($mecanicos)): ?>

                    <?php foreach ($mecanicos as $mecanico): ?>
                        <tr>

                            <!-- ID estilizado -->
                            <td>
                                <span class="badge bg-info text-dark">
                                    MEC-<?= str_pad($mecanico['id_mecanico'], 5, '0', STR_PAD_LEFT) ?>
                                </span>
                            </td>

                            <!-- Nome com destaque -->
                            <td class="fw-semibold">
                                <?= $mecanico['nome_completo'] ?>
                            </td>

                            <td><?= $mecanico['email'] ?></td>

                            <td><?= $mecanico['telefone'] ?></td>

                            <!-- Especialidade estilizada -->
                            <td>
                                <span class="badge bg-warning text-dark text-uppercase">
                                   <?= formatarEspecialidade($mecanico['especialidade']) ?>
                                </span>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Nenhum mecânico cadastrado
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>
    </div>

</div>


</form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Função para Máscara de CPF
    function mascaraCPF(i ) {
      let v = i.value.replace(/\D/g, "");
      v = v.replace(/(\d{3})(\d)/, "$1.$2");
      v = v.replace(/(\d{3})(\d)/, "$1.$2");
      v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
      i.value = v;
    }

    // Função para Máscara de Telefone
    function mascaraTelefone(i) {
      let v = i.value.replace(/\D/g, "");
      v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
      v = v.replace(/(\d)(\d{4})$/, "$1-$2");
      i.value = v;
    }

    // Função para Máscara de CEP
    function mascaraCEP(i) {
      let v = i.value.replace(/\D/g, "");
      v = v.replace(/^(\d{5})(\d)/, "$1-$2");
      i.value = v;
    }
  </script>
</body>
</html>
