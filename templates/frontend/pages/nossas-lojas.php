<div class="container">

    <h1 class="h3 text-center mt-3">Empresas</h1>

    <div class="row w-75 mx-auto mt-3">
        <?= retornaHTMLAlertMensagemSessao() ?>

        <hr class="mb-5">
        <?php foreach ($empresas as $e) : ?>

            <div class="col-5">
                <div class="col-12 d-flex align-items-center fs-1">
                    <?= $e['nomefantasia'] ?>
                </div>
                <div class="col-12 d-flex align-items-center mt-3" style="font-size: 1.1em;">
                    Razão Social: <?= $e['razaosocial'] ?> <br>
                    Tipo: <?= $e['tipo'] ?> <br>
                    Telefone: <?= $e['telefone1'] ?> <br>
                    Site: <?= $e['site'] ?> <br>
                    Email: <?= $e['email'] ?> <br>
                    
                </div>
            </div>
            <div class="col-7">
                <div class="col-11 w-100 d-flex">
                    <img src="<?= $e['imagens'][0]['url'] ?>" alt="" class="img-fluid">
                </div>
            </div>
            <hr class="mt-5">
        <?php endforeach; ?>
    </div>

</div>