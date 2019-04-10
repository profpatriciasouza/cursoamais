<section class="panel">
    <header class="panel-heading">
        Atividades  <a target="_blank" href="<?php echo $this->url("alunos", "modulos", "exercicios"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> ver</a>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <?php
        for ($i = 1; $i <= 3; $i++) {
            $titulo = "exercicio" . $i;
            $HTMLInput = new HTML_Input($titulo, "file", $titulo, "Atividade " . $i, "Escolha o vídeo");
            $HTMLInput->value = $this->modulo->$titulo;
            $HTMLInput->build();

            /* $descricao = "descr" . $i;
              $HTMLInput = new HTML_Input($descricao, "textarea", $descricao, "Descrição", "Digite a descrição");
              $HTMLInput->value = $this->curso->$descricao;
              $HTMLInput->build(); */
        }
        ?>
        <div class='form-group'>
            <br />
            
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>