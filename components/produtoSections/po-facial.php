<?php
    $produtos = [
        [
            'nome' => 'corretivo1',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/po1.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo2',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/po2.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo3',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/po3.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo4',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/po4.jpg',
            'descricao' => 'maquiagem muito bacana'
        ]
    ]
    ?>

    <main>
        <h1 class="fst-italic mb-0 text-decoration-underline" style="background-color: lightpink">Corretivos</h1>

        <div class="row align-items-center justify-content-center" style="background-color: lightpink">
            
            <!-- 1º VEM A FOTO (Ficará na Esquerda) -->
            <div class="col-12 col-lg-4 text-center text-lg-end mb-4 mb-lg-0 ms-lg-5">
                <img src="../assets/maquiagens/po2.jpg" alt="Banner da Loja" class="img-fluid rounded shadow" style="max-width: 90%; height: 650px; object-fit: fill;">
            </div>

            <!-- 2º VÊM OS PRODUTOS (Ficarão na Direita) -->
            <!-- A MÁGICA DO ESPAÇO: Coloquei 'offset-lg-1'. Ele pula 1 coluna inteira em branco antes de desenhar os produtos, criando o afastamento ideal! -->
            <div class="col-12 col-lg-5 p-5 offset-lg-1">
                <div class="row m-0">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-6 mt-3 mb-4">
                            
                            <!-- Mantive o seu w-75 que deixou os cards mais finos -->
                            <div class="card h-100 border border-info w-75" style="background-color: lightblue">
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

        </div>

    </main>