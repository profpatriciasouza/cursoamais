<?php
$id = preg_replace("/[^0-9a-zA-Z]/", "", $this->id);
?>
<div class="control-group f" id="f<?= $id ?>">
    <label class="control-label" for="<?= $this->fieldName ?>"><?= $this->Label; ?>:</label>
    <div class="controls">
        <input type="files" name="<?= $this->fieldName ?>" id="<?= $this->id ?>" value="" />
    </div>
    <?php
    ?>

</div>

<fieldset  id="fl<?= $id ?>" class="multifile" style="border: 1px solid;margin-left: 163px;width: 300px;margin-bottom: 20px;">
    <ul  class="filelist">
        <?php
        if (is_array($this->value)) {
            foreach ($this->value as $file) {
                ?>
                <li>
                    <input type="hidden" name="<?= $this->fieldName ?>[]" value="<?= $file ?>" />
                    <?= $file ?> 
                    <br />
                    <small>
                        (
                        <a style="float: none;;" href="<?= System_CONFIG::$folder; ?>/uploads/<?= $file ?>">download</a> | 
                        <a style="float: none;" href="#" onclick="if(confirm('Tem certeza que deseja excluir este arquivo?')) $(this).parent().parent().remove(); return false;">excluir</a>)
                    </small>
                </li>
                <?php
            }
        } else {
            ?>
            <p>Ainda não há nenhum arquivo</p>
            <?php
        }
        ?>
    </ul>
</fieldset>
<?php
Plugins_Jquery::getUploadIf();
?>
<script type="text/javascript">
    $("#<?= $this->id ?>").uploadify({
        'swf': '<?php Plugins_Jquery::getUploadIfPath(); ?>uploadify.swf',
        'cancelImg': '<?php Plugins_Jquery::getUploadIfPath(); ?>uploadify-cancel.png',
        'uploader': '<?php Plugins_Jquery::getUploadIfPath(); ?>uploadify.php',
        'folder': 'files',
        'multi': true,
        'width': '110',
        'buttonText': 'Selecionar arquivos',
        'checkScript': '<?php Plugins_Jquery::getUploadIfPath(); ?>check.php',
        'displayData': 'speed',
        'removeCompleted': true,
        'auto': true,
        onUploadSuccess: function(file, data, response) {
            arquivo = $.parseJSON(data);
            //alert("arquivo enviado com sucesso, clique em 'salvar' para gravar o arquivo");
            newHTML = "<li>";
            newHTML+= "<input type='hidden' name='<?= $this->id ?>[]' value = '"+arquivo.file+"' />"+arquivo.file;
            newHTML+= "<br /><small>(";
            newHTML+= "<a style='float: none;' href='<?= System_CONFIG::$folder; ?>/uploads/"+arquivo.file+"'>download</a> |";
            newHTML+= "<a style='float: none;' href='#' onclick=\"if(confirm('Tem certeza que deseja excluir este arquivo?')) $(this).parent().parent().remove(); return false;\">excluir</a>";
            newHTML+= ")</small></li>";
            $("#fl<?= $id ?> .filelist").append($(newHTML));
        }
    });
   
</script>