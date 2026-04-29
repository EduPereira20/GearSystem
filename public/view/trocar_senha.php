<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearSystem - Alterar Senha</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #0f172a;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-custom {
            background: #1e293b;
            border: none;
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0,0,0,.3);
        }

        .logo {
            color: #38bdf8;
            font-weight: bold;
            font-size: 1.8rem;
        }

        .form-control {
            background: #0f172a;
            border: 1px solid #334155;
            color: white;
        }

        .form-control:focus {
            background: #0f172a;
            color: white;
            border-color: #38bdf8;
            box-shadow: none;
        }

        .btn-custom {
            background: #38bdf8;
            border: none;
            color: black;
            font-weight: bold;
        }

        .btn-custom:hover {
            background: #0ea5e9;
        }
    </style>
</head>

<body>

    <div class="card-custom">

        <!-- Logo -->
        <div class="text-center mb-4">
            <i class="bi bi-shield-lock fs-1 text-info"></i>
            <h2 class="logo mt-2">GearSystem</h2>
            <p class="text-secondary">Alteração de senha</p>
        </div>

        <!-- Form -->
        <form action="/index.php?route=trocar.senha.post" method="POST">

            <div class="mb-3">
                <label class="form-label">Nova senha</label>
                <input 
                    type="password" 
                    name="nova_senha" 
                    required 
                    class="form-control"
                    placeholder="Digite a nova senha"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Confirmar senha</label>
                <input 
                    type="password" 
                    name="confirmar_senha" 
                    required 
                    class="form-control"
                    placeholder="Confirme a nova senha"
                >
            </div>

            <div class="d-grid">
                <button class="btn btn-custom">
                    <i class="bi bi-check-circle"></i> Alterar senha
                </button>
            </div>

        </form>

    </div>

</body>
</html>