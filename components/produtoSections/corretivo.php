 <?php
    $produtos = [
        [
            'nome' => 'Corretivo1',
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
     <div class="container-titulo-linhas d-flex align-items-center mt-5">

         <!-- Linha Esquerda: flex-grow-1 faz ela esticar o máximo possível -->
         <div class="linha-lateral flex-grow-1"></div>

         <!-- O Texto Central: px-4 dá um espaçamento para as linhas não colarem nas letras -->
         <div class="text-center px-4">
             <h2 class="titulo-principal m-0">Corretivos</h2>
             <span class="subtitulo">adeus olheiras, olá pele perfeita</span>
         </div>

         <!-- Linha Direita: flex-grow-1 faz ela esticar igual a outra -->
         <div class="linha-lateral flex-grow-1"></div>

     </div>

     <div class="row align-items-center justify-content-center m-0 " style="">
         <div class="col-12 col-lg-5 p-5 col-sm-12 container-vitrine justify-content-center">
             <div class="row">
                 <?php foreach ($produtos as $produto): ?>
                     <div class="card-produto col-6 mt-3 mb-4 d-flex justify-content-center">

                         <!-- O card continua normal, ele obedece o tamanho da coluna mãe -->
                         <div class=" card h-100 w-75 shadow-sm border-0" style="background-color: #F4D6F8; border-radius: 13px">
                             <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>" style="height: 200px; object-fit: cover; border-radius: 13px 13px 0 0">

                             <div class="card-body d-flex flex-column p-3">
                                 <h6 class="card-title mb-1 fw-bold" style="font-size: 1.3rem;"><?php echo $produto['nome']; ?></h6>
                                 <p class="card-text text-muted small" style="font-size: 1rem"><?php echo $produto['descricao'] ?></p>

                                 <div class="mt-auto">
                                     <div class="fw-bold mb-2 fs-4 " style="font-size: 1.2rem; color: darkmagenta"><?php echo $produto['preco']; ?></div>
                                     <button class="btn btn-sm w-100 fw-bold rounded-pill text-light " style="font-size: 15px; background-color: #DE97F2; ">COMPRAR</button>
                                 </div>
                             </div>
                         </div>

                     </div>
                 <?php endforeach; ?>
             </div>
         </div>
         <div class="col-12 col-lg-4 text-center text-lg-end mb-4 mb-lg-0 me-lg-5 ">
             <img src="../assets/maquiagens/blush2.jpg" alt="Banner da Loja" class="imagem-produto img-fluid rounded shadow d-none d-lg-block" style="max-width: 90%; height: 650px; object-fit: fill;">
         </div>

     </div>



 </main>