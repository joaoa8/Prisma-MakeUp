<?php $arquivo_atual = basename($_SERVER['PHP_SELF']); ?>

<header id="main-header" class="fixed-top w-100 z-3"
        style="transition: background-color 0.4s ease, backdrop-filter 0.4s ease;">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid ms-0">

                <a href="/pages/produtos.html" class="navbar-brand d-inline-block p-0 m-2">
                    <img src="assets/logo.png" alt="logo" class="img-fluid" style="max-width: 250px;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MenuNav"
                    aria-controls="MenuNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-center mt-3 mt-lg-0" id="MenuNav">
                    <ul class="navbar-nav ms-auto d-flex flex-column flex-lg-row align-items-center gap-3 gap-lg-4">
                        <li class="nav-item">
                            <a class="nav-link p-0 text-green2" href="<?php if($arquivo_atual == "index.php"){echo "#";}else{echo "../index.php";}?>">SOBRE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-0 text-white" href="/Prisma-MakeUp/pages/produtos.html">PRODUTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-0 text-white" href="/Prisma-MakeUp/pages/cursos.php">APRENDER</a>
                        </li>
                        <li class="nav-item fw-bold rounded-pill bg-purple2 p-2 px-3">
                            <a class="nav-link p-0 text-white" href="./Prisma-MakeUp/pages/login.php"><i class="bi bi-person me-1"></i>Login</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>