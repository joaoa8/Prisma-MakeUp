<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisma-MakeUp - Recuperar Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <link rel="stylesheet" href="../styles/styleCad.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main class="container-fluid d-flex justify-content-center align-items-center">
        <div class="auth-card">
            <div class="mb-3 text-center">
                <i class="bi bi-lock-fill fs-2 text-purple2"></i>
                <h1 class="fs-4 fw-bold mb-1 mt-2">Esqueci minha senha</h1>
                <p class="text-secondary mb-0">Informe seu e-mail e enviaremos um link para criar uma nova senha</p>
            </div>

            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="seu@email.com" required>
                </div>
                <button type="submit" class="btn btn-login w-100 mb-3">Enviar link de recuperação</button>
                <div class="text-center">
                    <a href="../pages/login.php" class="link-forgot">Voltar para o login</a>
                </div>
            </form>
        </div>
    </main>

    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../scripts/scriptGeral.js"></script>
</body>
</html>
