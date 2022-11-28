<div class="rodape-site py-4 mt-3">
    <div class="container">
        <div class="pgto-social row text-center">
            <div class="col-auto me-auto">
                <strong><i class="fa-regular fa-credit-card"></i> Aceitamos</strong>
                <div class="mt-2 pt-2 border-top border-dark">
                    <i class="fa-brands fa-cc-visa fs-3 pe-2"></i>
                    <i class="fa-brands fa-cc-mastercard fs-3 pe-2"></i>
                    <i class="fa-brands fa-cc-apple-pay fs-3 pe-2"></i>
                    <i class="fa-brands fa-cc-amex fs-3 pe-2"></i>
                    <i class="fa-brands fa-pix fs-3 pe-2"></i>
                </div>
            </div>
            <div class="col-auto">
                <strong> <i class="fa-solid fa-circle-nodes"></i>Siga nossas Redes</strong>
                <div class="mt-2 pt-2 border-top border-dark">
                    <a href="#"><i class="fa-brands fa-facebook fs-3 pe-2"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter fs-3 pe-2"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fs-3 pe-2"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok fs-3 pe-2"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube fs-3 pe-2"></i></a>
                </div>
            </div>
        </div>
        <div class="info-matriz row mt-5 text-center">
            <div>Preços e condições exclusivos para o <?=$site??'' ?> (exceto alimentos e bebidas), podendo sofrer alterações sem prévia notificação.</div>
            <div>
                <?= $nomefantasia ??'' ?> |
                <?= $site??'' ?> |
                <?= $rua??'' ?>, <?= $bairro??'' ?>, Nrº <?= $numero??'' ?> |
                <?= $cidade??'' ?>, <?= $estado??'' ?>, CEP <?= $cep??'' ?> |
                CNPJ: <?= $cnpj??'' ?> |
                Telefones: <?= $telefone1??'' ?> - <?= $telefone2??''?>
            </div>
            <div>Observação: Ao utilizar o copom de desconto, cerifique-se de que o mesmo esteja no período de validade.</div>
        </div>
    </div>
</div>