<?php
$this->getHeader();
?>
<div class="page-heading">
    <h3>´</h3>  
    <p>Navegue através do menu a esquerda para acessar as opções do seu sistema</p>
    <div class='wrapper'>
        <div class='row'>
            <div class='col-xs-6'>
                <?php
                $token = file_get_contents(System_CONFIG::get('upload_dir') . "token.txt");
                $meli = new Meli(System_CONFIG::get('appid'), System_CONFIG::get('secret'));

                $user = $meli->authorize($token, "http://henon.com.br/ml/save-token");
                
                
                

                if (isset($user['body']->status) && $user['body']->status == "400") {
                    ?>
                    Mercado Livre negou acesso a API, faça login clicando abaixo:
                    <?php
                } else {

                    $items = $meli->get("/users/me", array("access_token" => $user['body']->access_token));
                    ?>
                    Você esta logado como: <?php echo $items['body']->nickname; ?> <br />
                    <?php
                }
                ?>
                <a href="<?php echo $meli->getAuthUrl("http://henon.com.br/ml/save-token");
                ?>" class="btn btn-default">Autenticar no Mercado Livre</a>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

