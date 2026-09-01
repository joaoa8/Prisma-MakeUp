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


        <section>
            <?php foreach ($produtos as $produto): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $produto['nome'];?></h5>
                    <p class="card-text"><?php echo $produto['nome'];?></p>
                    <p class="card-text"><?php echo $produto['preco'];?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <?php endforeach; ?>
        </section>



    </main>