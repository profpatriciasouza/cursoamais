<section class="panel">
    <header class="panel-heading">
        Avaliação Final <a target="_blank" href="<?php echo  $this->url("alunos", "modulos", "sobre"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> ver</a>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <?php
        $select = new HTML_Input_Select("exam", "exam", "Exame final");
        $select->addOption(new HTML_Input_Select_Option("", "(em desenvolvimento) Selecione uma avaliação", true));
        $select->build();
        ?>
        <div class='form-group'>
            <br />
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>