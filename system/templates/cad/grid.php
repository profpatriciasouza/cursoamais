<?php
$this->getHeader();
$m = isset($_GET['m']) ? $_GET['m'] : "index";
$a = isset($_GET['a']) ? $_GET['a'] : "";
?>

<div class="container-fluid">
    <?php
    $fechaSpan9 = "";
    if ($this->getSubMenu()) {
        $fechaSpan9 = "</div>";
        echo "<div class='span9'>";
    }
    ?>
    <div class="pull-right">
        <?php
        if (count($this->fieldsets[0]->filtro) > 0) {
            ?>
            <form method="GET" class="form-inline" action="<?= $this->getPathLink(); ?>">
                <h3>Filtro</h3>
                <input type="hidden" name="m" value="<?= $m ?>" />
                <input type="hidden" name="a" value="<?= $a ?>" />
                <input type="hidden" name="pg" value="1" />
                <?php
                foreach ($this->fieldsets[0]->filtro as $field) {
                    $field->build();
                }

                $input = new Cad_Input(Cad_FieldsTypes::$SUBMIT, "senha");
                $input->value = "buscar";
                //$input->preHTML = "<a href='#filtro-avancao' onclick=\"alert('Aguardando implementa��o.')\">ver filtro avan�ado</a>";
                $input->build();
                ?>
            </form>
            </fieldset>
            <?php
        }
        ?>
    </div>

    <fieldset class="acoes">
        <?php
        $qry= "";
        if(isset($_GET['CO'])) {
            $qry="&CO=".$_GET['CO'];
        }
        
        $acesso = System::getMenu('Incluir', Map::$modulo, Map::$acao, 'insert');
        $acesso->html = "<a class=btn href={link}".$qry.">{descricaoacesso}</a>";
        echo $acesso;
        echo " ";
        if ($this->ajuda != "") {
            $acesso = System::getMenu('Ajuda', System::$modulo, System::$acao, 'ajuda');
            $acesso->html = "<a class=btn href='#ajuda' onclick='$(\"#ajuda\").toggle();'>{descricaoacesso}</a>";
            echo $acesso;
        }
        ?>
    </fieldset>
    <div class="hero-unit" id="ajuda" style="margin-top: 10px; display:none">
        <?php echo $this->ajuda; ?>
    </div>
    <?php
    $this->gridData->getPaginacao();
    ?>
    <table  class="table table-striped">
        <thead>
            <tr>
                <?php
                $cols = 1;
                foreach ($this->gridFields as $gridField) {
                    if (!$gridField->showOnGrid)
                        continue;

                    $cols++;
                    ?>
                    <th><?= $gridField->Label; ?></th>
                    <?php
                }
                ?>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!is_array($this->gridData->rows)) {
                ?>
                <tr>
                    <td colspan="<?= $cols ?>"><?= $this->getMsg("CAD1004") ?></td>
                </tr>
                <?php
            } else {
                foreach ($this->gridData->rows as $data) {
                    System_Log::logit("Grid Row: ", print_r($data, 1));
                    ?>
                    <tr class="<?= Cad_Grid::getRandomBG(); ?>">
                        <?php
                        foreach ($this->gridFields as $gridField) {
                            if (!$gridField->showOnGrid)
                                continue;

                            $field = $gridField->getGridFieldName();
                            if (isset($data->$field))
                                $gridField->value = ($data->$field);
                            System_Log::logit("Grid field: " . $field, print_r($gridField, 1));
                            ?>
                            <td><?= $gridField->getGridValue(); ?></td>

                            <?php
                        }
                        ?>
                        <td nowrap>
                            <?php
                            $acesso = System::getMenu('Editar', Map::$modulo,Map::$acao, 'edit');
                            $acesso->html = "<a class=btn href={link}?" . $this->buildQueryPK($data) .$qry. ">{descricaoacesso}</a>";
                            if($this->permiteAlterar)
                            echo $acesso;
                            ?>
                            <?php
                            $acesso = System::getMenu('Excluir', Map::$modulo, Map::$acao, 'delete');
                            $acesso->onclick = 'return confirm(\'Tem certeza que deseja excluir este item? \n\nEste processo não poderá ser desfeito.\')';
                            $acesso->html = "<a class=btn {onclick} href={link}?" . $this->buildQueryPK($data) . ">{descricaoacesso}</a>";
                            if($this->permiteExcluir)
                            echo $acesso;
                            ?>

                        </td>
                    </tr>

                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
    $this->gridData->getPaginacao();
    echo $fechaSpan9;
    ?>

</div>
</div>

<?php
$this->getFooter();
?>