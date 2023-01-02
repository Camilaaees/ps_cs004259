<div class="container">

    <hr class="mb-5">

    <div class="row row-cols-5">
        <?php foreach ($promocoes as $p) {
            $primeiraImagem = $p['imagens'][0]['url'] ?? 'https://picsum.photos/300';
            $titulo = strlen($p['titulo']) < 50 ? $p['titulo'] : substr($p['titulo'], 0, 50) . '...';

            echo <<<HTML
                <div class="col produto position-relative mb-3 py-4 px-4">
                    <img src="{$primeiraImagem}" class="img-fluid rounded" alt="{$p['titulo']}">
                    <p class="mb-0 mt-2 text-center"><strong>{$titulo}</strong></p>
            HTML;
        ?>
                Descricao: <?= $p['descricao'] ?><br>
                Desconto: <?= $p['desconto'] ?> <br>
                Encerramento: <?= $p['datafinal'] ?> <br>
                Ativo: <?= $p['ativo'] ?> <br>
            </div>
        <?php } ?>
    </div>

</div>