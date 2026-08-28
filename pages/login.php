<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <link rel="stylesheet" href="../styles/styleCad.css">
</head>
<body>
    <?php include '../components/header.php'; ?>
    <main class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-card position-fixed top-50 start-50 translate-middle">
            <ul class="nav nav-pills nav-fill mb-4" id="authTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login"
                        type="button" role="tab" aria-controls="login" aria-selected="true">Entrar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="signup-tab" data-bs-toggle="pill" data-bs-target="#signup"
                        type="button" role="tab" aria-controls="signup" aria-selected="false">Criar conta</button>
                </li>
            </ul>

            <div class="tab-content" id="authTabContent">

                <section class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <div class="mb-3 text-center">
                        <h1 class="fs-4 fw-bold mb-1">Bem vinda de volta!</h1>
                        <p class="text-secondary mb-0">Entre com seu e-mail e senha</p>
                    </div>
                    <form method="post" id="loginForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="seu@email.com">
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Sua senha">
                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    aria-label="Mostrar senha">
                                    <i class="icon-eye bi bi-eye-fill"></i>
                                    <i class="icon-eye-slash bi bi-eye-slash-fill d-none"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <a href="saveLogin.html" class="link-forgot">Esqueci senha/email</a>
                        </div>
                        <button type="submit" class="btn btn-login w-100">Entrar</button>
                    </form>
                </section>

                <section class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                    <div class="mb-3 text-center">
                        <h1 class="fs-4 fw-bold mb-1">Crie sua conta</h1>
                        <p class="text-secondary mb-0">Preencha os dados abaixo</p>
                    </div>
                    <form method="post" id="signupForm">
                        <div class="mb-3">
                            <label for="nameSignup" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" name="name" id="nameSignup" placeholder="Seu nome">
                        </div>
                        <div class="mb-3">
                            <label for="emailSignup" class="form-label">E-mail</label>
                            <input type="text" class="form-control" name="email" id="emailSignup"
                                placeholder="seu@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="passwordSignup" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="passwordSignup"
                                    placeholder="Sua senha">
                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    aria-label="Mostrar senha">
                                    <i class="icon-eye bi bi-eye-fill"></i>
                                    <i class="icon-eye-slash bi bi-eye-slash-fill d-none"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-signup w-100">Criar conta</button>
                    </form>
                </section>

            </div>
        </div>
    </main>    

    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const input = btn.closest('.input-group').querySelector('input');
                const eyeIcon = btn.querySelector('.icon-eye');
                const eyeSlashIcon = btn.querySelector('.icon-eye-slash');
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';
                eyeIcon.classList.toggle('d-none', isHidden);
                eyeSlashIcon.classList.toggle('d-none', !isHidden);
                btn.setAttribute('aria-label', isHidden ? 'Esconder senha' : 'Mostrar senha');
            });
        });

        document.querySelectorAll('#loginForm, #signupForm').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                if (window.history.length > 1) {
                    window.history.back();
                    return;
                }

                window.location.href = '../index.php';
            });
        });
    </script>
</body>
</html>