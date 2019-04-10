<form id="subscribe-form" name="login-form" class="nobottommargin" action="/cadastro.php" method="post">

    <?php
    if (isset($curso)) {
        ?>
        <input type="hidden" name='curso' value='<?php echo $curso->id; ?>' />
        <?php
    }
    ?>
    <h3> Matricule-se </h3>

    <div class="col_full">
        <label for="login-form-username">Nome:</label>
        <input type="text" id="Nome" name="Nome" value="" class="form-control" />
        
    </div>

    <div class="col_full">
        <label for="login-form-username">CPF:</label>
        <input type="text" id="CPF" name="CPF" value="" class="form-control" />
    </div>

    <div class="col_full">
        <label for="login-form-username">Email:</label>
        <input type="text" id="Email" name="Email" value="" class="form-control" />
    </div>

    <div class="col_full">
        <label for="login-form-username">Repita seu email:</label>
        <input type="text" id="RepitaEmail" name="RepitaEmail" value="" class="form-control" />
    </div>

    <div class="col_full">
        <label for="login-form-password">Senha:</label>
        <input type="password" id="Senha" name="Senha" value="" class="form-control" />
    </div>

    <div class="col_full">
        <label for="login-form-password">Repita sua senha:</label>
        <input type="password" id="RepitaSenha" name="RepeteSenha" value="" class="form-control" />
    </div>
    <div class="col_full">
        <label for="AceitoReceberEmail">
            <input style="width: 15px; margin: -7px 8px 0px 0px; padding: 0px;float: left;" type="checkbox" id="AceitoReceberEmail" name="AceitoReceberEmail" value="" class="form-control" /> Desejo receber e-mails
        </label>
        
    </div>

    <div class="col_full nobottommargin">
        <button type='submit' class="button button-3d nomargin" id="login-form-submit">Registrar</button>
        <!-- <a href="#" class="fright">Esqueci minha senha?</a> -->
    </div>

</form>