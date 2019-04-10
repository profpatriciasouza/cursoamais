<section class="panel">
    <header class="panel-heading">
        Conteúdo <a target="_blank" href="<?php echo  $this->url("alunos", "modulos", "sobre"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> ver</a>
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <textarea id="conteudo" name="conteudo" class="form-control"><?php echo Encoding::utf8($this->modulo->conteudo); ?></textarea>
        <div class='form-group'>
            <br />
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>