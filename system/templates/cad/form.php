<?php
$this->getHeader();


$m = Map::$modulo;
$a = Map::$acao;
?>
<iframe name="ifrmproc" style="display:none;"></iframe>
<div class="container-fluid">
    <?php
    $fechaSpan9 = "";
    if ($this->getSubMenu()) {
        $fechaSpan9 = "</div>";
        echo "<div class='span9'>";
    }
    ?>
    <fieldset class="acoes">
        <?php
        $acesso = System::getMenu('Incluir', System::$modulo, System::$acao, 'insert');
        $acesso->html = "<a class=btn href={link}>{descricaoacesso}</a>";
        //echo $acesso;
        ?>
        <?php
        $acesso = new System_Acesso(null, 'Voltar', System::$modulo, System::$acao, 'grid');
        $acesso->html = "<a class=btn href={link}>{descricaoacesso}</a>";
        //echo $acesso;
        ?>
        <?php
        
        $acesso = System::getMenu('Excluir', System::$modulo, System::$acao, 'delete');
        $acesso->onclick = 'return confirm(\'Tem certeza que deseja excluir este item? \n\nEste processo não poderá ser desfeito.\')';
        $acesso->html = "<a class=btn {onclick} href={link}&" . $this->buildQueryPK($this->fieldsets[0]->row) . ">{descricaoacesso}</a>";
        if(!$this->inibirGrid)
        echo $acesso;
        ?>
    </fieldset>
    <?php
    $qry = "";
    if (isset($_GET['CO'])) {
        $qry = "&CO=" . $_GET['CO'];
    }
    ?>
    <form class="form-horizontal" method="POST" action="/<?php echo Map::$area ?>/<?php echo Map::$modulo ?>/<?php echo Map::$acao ?>/acao-cadastro/<?= $this->acao ?>?<?= $this->buildQueryPK($this->row); ?><?php echo $qry; ?>">
        <?php
        
        foreach ($this->fieldsets as $k => $fieldset) {
            $fieldset->build();
        }

        if ($this->acao != "insert") {
            foreach ($this->subCadastros as $tag => $subCadastro) {
                call_user_func_array($subCadastro, array($tag, $this));
            }
        }

        $input = new Cad_Input(Cad_FieldsTypes::$SUBMIT, "salvar");
        $input->value = $this->acao == "insert" ? $this->getMsg("CAD1001") : $this->getMsg("CAD1002");
        $input->build();
        ?>
    </form>
        <?php
        echo $fechaSpan9;
        ?>
</div>
    <?php
    $this->getFooter();
    ?>