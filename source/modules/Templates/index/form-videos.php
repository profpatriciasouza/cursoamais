<section class="panel">
    <header class="panel-heading">
        Vídeos <a target="_blank" href="<?php echo $this->url("alunos", "modulos", "videos"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> ver</a>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            $titulo = "video" . $i;
            $HTMLInput = new HTML_Input($titulo, "file", $titulo, "Vídeos " . $i, "Escolha o vídeo");
            $HTMLInput->value = Encoding::utf8($this->modulo->$titulo); //$this->modulo->$titulo;
            $HTMLInput->build();
            
            //<?php echo Encoding::utf8($this->modulo->oqueler);
        }
        ?>
        <div class='form-group'>
            <br />
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>