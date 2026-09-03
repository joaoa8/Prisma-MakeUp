 <?php
    $produtos = [
        [
            'nome' => 'corretivo1',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/corretivo1.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo2',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/corretivo2.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo3',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/corretivo3.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo4',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/corretivo4.jpg',
            'descricao' => 'maquiagem muito bacana'
        ]
    ]
    ?>

    <main>
        <h1 class="fst-italic mb-0 text-decoration-underline" style="background-color: lightpink">Corretivos</h1>

<div class="row align-items-center" style="background-color: lightpink">
    <div class="col-12 col-lg-4 mb-5 mb-lg-0 m-4">
                <div class="row">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-6 mt-3 mb-4 ">
                            <div class="card h-100 w-75 border border-info" style="background-color: lightblue">

                                <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>" style="height: 200px; object-fit: cover;">
                                 
                                
                                <div class="card-body d-flex flex-column p-2">
                                    <h6 class="card-title mb-1" style="font-size: 0.85rem;"><?php echo $produto['nome']; ?></h6>

                                    <p class="card-text" style="font-size: 0.85rem"><?php echo $produto['descricao']?></p>
                                    
                                    <div class="mt-auto">
                                        <div class="text-danger fw-bold mb-2" style="font-size: 0.8rem;"><?php echo $produto['preco']; ?></div>
                                        <button class="btn btn-danger btn-sm w-100 fw-bold" style="font-size: 0.75rem;">COMPRAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <img src="../assets/maquiagens/foto.jpg" alt="Banner da Loja" class="img-fluid rounded shadow w-100" style="max-height: 500px; object-fit: cover;">
            </div>

        </div>



    </main>