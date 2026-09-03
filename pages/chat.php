<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prisma-MakeUp - chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <link rel="stylesheet" href="../styles/styleChat.css">
</head>

<body>
    <?php include '../components/header.php'; ?>

    


<div id="chat-container" class="d-flex flex-column mb-4">
    <div class="card bg-light text-dark border-0 rounded-4 rounded-start-0 rounded-start-lg-4 p-3 shadow-sm me-auto mb-2" style="max-width: 75%;">
        <p class="mb-1 text-break">Tudo ótimo! E por aí, como estão as coisas?</p>
    </div>
</div>

<div id="form-container" class="form">
    <form id="meu-formulario" enctype="multipart/form-data" class="p-4 text-center">
        <div class="mb-3">
            <label for="foto" class="form-label fs-3">Selecione uma foto:</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label fs-3">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3" placeholder="Digite uma descrição para a foto..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="btn-enviar">Enviar Foto</button>
    </form>
</div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../scripts/scriptGeral.js"></script>
    <script src="../scripts/scriptChat.js"></script>
</body>

</html>