<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body class="d-flex flex-column min-vh-100">
    <?php include '../components/header.php' ?>
    <?php
    // Simulando o produto que o cliente clicou para ver os detalhes
    $produto = [
        'nome' => 'Batom Matte 01',
        'preco' => 'R$ 22,00',
        'imagem' => '../assets/maquiagens/batom1.jpg',
        'descricao' => 'Batom líquido com acabamento matte aveludado, cor intensa e longa duração. Enriquecido com vitamina E para não ressecar os lábios durante o uso.',
        'categoria' => 'Lábios',
        'estoque' => true
    ];
    ?>

    <main class="container my-5 pt-4">


        <div class="row gx-lg-5 py-5 align-items-center">

            <!-- COLUNA DA ESQUERDA: Imagem do Produto -->
            <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                <div class="card border-0 shadow-sm w-100 d-flex justify-content-center align-items-center p-4" style="background-color: #F4D6F8; border-radius: 20px; height: 500px;">
                    <!-- mix-blend-mode tira o fundo branco caso a imagem não seja PNG transparente -->
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" class="img-fluid" style="max-height: 100%; object-fit: contain; mix-blend-mode: multiply;">
                </div>
            </div>

            <!-- COLUNA DA DIREITA: Informações e Compra -->
            <div class="col-12 col-lg-6">

                <!-- Título e Preço -->
                <h1 class="fw-bold text-dark mb-2" style="font-size: 2.5rem;"><?php echo $produto['nome']; ?></h1>
                <p class="text-muted mb-4">Cód: 984572 • Vendido e entregue por Prisma MakeUp</p>

                <div class="fw-bold mb-4 py-2" style="font-size: 2rem; color: darkmagenta;">
                    <?php echo $produto['preco']; ?>
                    <span class="d-block text-muted fw-normal mt-1" style="font-size: 0.9rem;">em até 2x de R$ 11,00 sem juros</span>
                </div>

                <!-- Descrição Curta -->
                <p class="mb-4 py-4" style="font-size: 20px; line-height: 1.6; color: #555;">
                    <?php echo $produto['descricao']; ?>
                </p>

                <!-- Ações de Compra -->
                <div class="d-flex gap-3 mb-4 align-items-center">
                    <!-- Seletor de Quantidade -->


                    <!-- Botão Principal -->
                    <button class="btn w-100 fw-bold rounded-pill text-light shadow-sm py-3 fs-5" style="background-color: #DE97F2; transition: filter 0.2s;">
                        <i class="bi bi-bag-check-fill me-2"></i> ADICIONAR AO CARRINHO
                    </button>
                </div>


                <!-- Informações Extras (Acordeão) -->


            </div>
        </div>
        <hr>
        <div>
            <h3 class="text-start">Como usar</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus delectus illum, inventore similique quasi dolores vitae beatae enim molestias cumque expedita voluptatibus aperiam architecto voluptate! Provident labore recusandae natus laborum.</p>
        </div>
    </main>
    <?php include '../components/footer.php' ?>

    <script src="../scripts/scriptGeral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>