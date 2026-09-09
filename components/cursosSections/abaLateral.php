<?php
// Define a lista de cursos antes do HTML carregar
$cursos = [
    [
        'titulo' => 'Automaquiagem do Zero ao Avançado',
        'thumb' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=600',
        'instrutor' => 'Aline Costa',
        'instrutor_foto' => 'https://i.pravatar.cc/100?img=5',
        'aulas' => '12',
        'nota' => '4.9',
        'alunos' => '1.2k'
    ],
    [
        'titulo' => 'Técnicas de Contorno e Iluminação',
        'thumb' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?w=600',
        'instrutor' => 'Beatriz Lima',
        'instrutor_foto' => 'https://i.pravatar.cc/100?img=9',
        'aulas' => '8',
        'nota' => '4.8',
        'alunos' => '850'
    ],
    [
        'titulo' => 'Rotina de Skincare e Preparação de Pele',
        'thumb' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=600',
        'instrutor' => 'Carla Mendes',
        'instrutor_foto' => 'https://i.pravatar.cc/100?img=20',
        'aulas' => '15',
        'nota' => '5.0',
        'alunos' => '2.1k'
    ]
];
?>
<div class="container-fluid">
    <div class="row">
        
        <!-- 1. ABA LATERAL (Gaveta no celular / Barra fixa no computador) -->
        <nav id="sidebarCursos" class="col-md-3 col-lg-2 offcanvas-md offcanvas-start bg-light border-end min-vh-100 p-3">
            <div class="offcanvas-header border-bottom mb-3 d-md-none">
                <h5 class="offcanvas-title fw-bold">Categorias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarCursos"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column">
                <span class="fw-bold text-uppercase text-muted small mb-3">Filtrar por</span>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item mb-1">
                        <a href="#" class="nav-link active rounded-3"><i class="bi bi-grid-fill me-2"></i> Todos os Cursos</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="#" class="nav-link text-dark rounded-3"><i class="bi bi-palette me-2"></i> Maquiagem</a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="#" class="nav-link text-dark rounded-3"><i class="bi bi-stars me-2"></i> Skincare</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- 2. ÁREA PRINCIPAL (Vitrine de Cursos) -->
        <main class="col-md-9 col-lg-10 p-4">
            
            <!-- Botão de abrir menu no celular -->
            <button class="btn btn-outline-dark d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarCursos">
                <i class="bi bi-list"></i> Categorias
            </button>

            <h4 class="fw-bold mb-4">Cursos Disponíveis</h4>

            <!-- GRID ESTILO YOUTUBE (Ajustado para o espaço com sidebar) -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3">
                <?php foreach ($cursos as $curso): ?>
                <div class="col">
                    <div class="card border-0 bg-transparent h-100 curso-youtube-card">
                        
                        <!-- Miniatura 16:9 -->
                        <div class="position-relative overflow-hidden rounded-3 mb-2">
                            <div class="ratio ratio-16x9">
                                <img src="<?php echo $curso['thumb']; ?>" class="object-fit-cover rounded-3" alt="Capa do curso">
                            </div>
                            <span class="position-absolute bottom-0 end-0 text-white px-2 py-1 m-2 rounded fw-semibold" style="font-size: 0.75rem; background-color: rgba(0, 0, 0, 0.8);">
                                <?php echo $curso['aulas']; ?> aulas
                            </span>
                        </div>

                        <!-- Informações do Curso -->
                        <div class="d-flex gap-2">
                            <img src="<?php echo $curso['instrutor_foto']; ?>" class="rounded-circle object-fit-cover" width="36" height="36" alt="Instrutor">
                            <div>
                                <h6 class="fw-bold mb-1 titulo-curso" style="font-size: 0.95rem; line-height: 1.3;">
                                    <?php echo $curso['titulo']; ?>
                                </h6>
                                <p class="text-secondary small mb-0"><?php echo $curso['instrutor']; ?></p>
                                <p class="text-secondary small mb-0">⭐ <?php echo $curso['nota']; ?> • <?php echo $curso['alunos']; ?> alunos</p>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </main>

    </div>
</div>