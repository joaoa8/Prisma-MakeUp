<?php
    $produtos = [
        [
            'nome' => 'corretivo1',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/batom1.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo2',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/gloss1.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo3',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/batom2.jpg',
            'descricao' => 'maquiagem muito bacana'
        ],
        [
            'nome' => 'corretivo4',
            'preco' => 'R$22',
            'imagem' => '../assets/maquiagens/gloss2.jpg',
            'descricao' => 'maquiagem muito bacana'
        ]
    ]
    ?>

    <main>
        <div class="container-titulo-linhas d-flex align-items-center my-5">

         <!-- Linha Esquerda: flex-grow-1 faz ela esticar o máximo possível -->
         <div class="linha-lateral flex-grow-1"></div>

         <!-- O Texto Central: px-4 dá um espaçamento para as linhas não colarem nas letras -->
         <div class="text-center px-4">
             <h2 class="titulo-principal m-0">Batom e gloss</h2>
             <span class="subtitulo">cor intensa e brilho espelhado em um só duo</span>
         </div>

         <!-- Linha Direita: flex-grow-1 faz ela esticar igual a outra -->
         <div class="linha-lateral flex-grow-1"></div>

     </div>

        <div class="row align-items-center justify-content-center m-0" >
            
            <!-- 1º VEM A FOTO (Ficará na Esquerda) -->
            <div class="imagem-produto col-12 col-lg-4 text-center text-lg-end me-5 mb-4 mb-lg-0">
                <img src="../assets/maquiagens/batom1.jpg" alt="Banner da Loja" class="img-fluid rounded shadow" style="max-width: 90%; height: 650px; object-fit: fill;">
            </div>

            <!-- 2º VÊM OS PRODUTOS (Ficarão na Direita) -->
            <!-- A MÁGICA DO ESPAÇO: Coloquei 'offset-lg-1'. Ele pula 1 coluna inteira em branco antes de desenhar os produtos, criando o afastamento ideal! -->
            <div class="col-12 col-xl-5 col-lg-10 col-md-10 col-sm-10 p-5 ms-5 container-vitrine">
                <div class="row m-0">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-6 mt-3 mb-4">
                            
                            <!-- Mantive o seu w-75 que deixou os cards mais finos -->
                        <div class="card h-100 w-100 shadow-sm border-0" style="background-color: #F4D6F8; border-radius: 13px">
                            <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>" style="height: 200px; object-fit: cover; border-radius: 13px 13px 0 0">
                             
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title mb-1 fw-bold" style="font-size: 1.3rem;"><?php echo $produto['nome']; ?></h6>
                                <p class="card-text text-muted small" style="font-size: 1rem"><?php echo $produto['descricao']?></p>
                                
                                <div class="mt-auto" >
                                    <div class="fw-bold mb-2 fs-4 " style="font-size: 1.2rem; color: darkmagenta"><?php echo $produto['preco']; ?></div>
                                    <button class="btn btn-sm w-100 fw-bold rounded-pill text-light " style="font-size: 15px; background-color: #DE97F2; ">COMPRAR</button>
                                </div>
                            </div>
                        </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

    </main>