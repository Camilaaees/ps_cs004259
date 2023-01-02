<div class="container">

    <div class="row">
        <div class="col-6 d-flex flex-column justify-content-center">
            <div class="text-center">
                <h1><?= $categoria['nome'] ?></h1>
            </div>
            <div class=" text-center">
                <?= $categoria['descricao'] ?>
            </div>
        </div>
        <div class="col-6">
            <img src="<?= $categoria['imagens'][0]['url'] ?>" class="img-fluid w-100 rounded mt-4 mb-1" alt="<?= $categoria['nome'] ?>">
        </div>

    </div>

    <hr class="mb-5">

    <div class="row row-cols-5">
        <?php
            foreach($produtos as $p) {
                $primeiraImagem = $p['imagens'][0]['url'] ?? 'https://picsum.photos/300';
                $preco = number_format($p['preco'], 2, ',', '.');
                $nome = strlen($p['nome'])<50 ? $p['nome'] : substr($p['nome'], 0, 50) . '...';
                $link = '/produtos/'.$p['idproduto'];

                echo <<<HTML
                    <div class="col produto position-relative mb-3">
                        <img src="{$primeiraImagem}" class="img-fluid rounded" alt="{$p['nome']}">
                        <p class="mb-0 mt-2 text-center"><strong>{$nome}</strong></p>
                        <a href="{$link}" class="btn btn-success btn-sm w-100 my-2 stretched-link">R$ {$preco}</a>
                    </div>
                HTML;
            }
        ?>
    </div>

</div>