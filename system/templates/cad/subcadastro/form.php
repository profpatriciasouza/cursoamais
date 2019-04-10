<?php
$m = isset($_GET['m']) ? $_GET['m'] : "index";
$a = isset($_GET['a']) ? $_GET['a'] : "";
?>
<div class="container-fluid">
    <form target="ifrmproc" class="form-horizontal" method="POST" action="<?php echo $this->getSubCadastroURL($this->tag, $_GET['ta']); ?>&<?= $this->buildQueryPK($this->row); ?>">
        <?php
        foreach ($this->fieldsets as $fieldset) {
            $fieldset->build();
        }


        $input = new Cad_Input(Cad_FieldsTypes::$SUBMIT, "salvar");
        $input->value = $this->acao == "insert" ? $this->getMsg("CAD1001") : $this->getMsg("CAD1002");
        $input->build();
        
        if($this->acao != "insert") {
            foreach($this->subCadastros as $tag => $subCadastro) {
                call_user_func_array($subCadastro, array($tag, $this));
            }
        }
        
        System::runRender('on_render_form');
        ?>
    </form>
</div>
<?php
?>