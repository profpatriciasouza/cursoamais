<section class="panel">
    <header class="panel-heading">
        O que ler <a target="_blank" href="<?php echo  $this->url("alunos", "modulos", "leituras-indicadas"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> ver</a>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <textarea id="oqueler" name="oqueler" class="form-control"><?php echo Encoding::utf8($this->modulo->oqueler); ?></textarea>
        <div class='form-group'>
            <br />
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>