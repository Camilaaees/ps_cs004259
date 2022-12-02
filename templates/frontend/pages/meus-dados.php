<div class="container my-5">
    <div class="row">
        <div class="col-3 text-center bg-secondary text-light py-2 rounded-2">
            <div>Bem Vindo(a): <strong><?=$cliente['prinome']?></strong> <br></div>
            <div style="font-size: .8em;">(<?=$cliente['email']?>)<br></div>
            <div class="mt-5">
                <a href="/logout" class="badge text-bg-danger text-decoration-none">Sair</a>
            </div>

        </div>
        <div class="col-9 ps-5">
            - Meus pedidos <br>
            - Meus Endereços <br>
            - Meus Favoritos
        </div>
    </div>
</div>