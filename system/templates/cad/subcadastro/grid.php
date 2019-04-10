<?php
$m = isset($_GET['m']) ? $_GET['m'] : "index";
$a = isset($_GET['a']) ? $_GET['a'] : "";
?>
<fieldset>
    <legend><?php echo $this->nomePrograma; ?></legend>

    <a name="<? echo $this->tag ?>"></a>
    <fieldset class="pull-right">
        <a class="btn" rel="facebox" href="<?php echo $this->getSubCadastroURL($this->tag, 'insert'); ?>">Inserir</a>
    </fieldset>
    <table class="table">
        <thead>
            <tr>
                <?php
                $cols = 1;
                foreach ($this->gridFields as $gridField) {
                    if (!$gridField->showOnGrid)
                        continue;

                    $cols++;
                    ?>
                    <td><?= $gridField->Label; ?></td>
                    <?php
                }
                ?>
                <td>Ações</td>
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
                            <a
                                class="btn" rel="facebox"
                                href='<?php echo $this->getSubCadastroURL($this->tag, 'edit'); ?>&<?= $this->buildQueryPK($data); ?>'
                                <i class="icon-edit"></i> Editar
                            </a>
                            <a
                                target="ifrmproc"
                                class="btn"
                                type="submit" 
                                value="excluir" 
                                href='<?php echo $this->getSubCadastroURL($this->tag, 'delete'); ?>&<?= $this->buildQueryPK($data); ?>'
                                onclick="return confirm('Tem certeza que deseja excluir este item? \n\nEste processo não poderá ser desfeito.');" 
                                ><i class="icon-remove"></i> Excluir</a>
                        </td>
                    </tr>

                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
   $this->gridData->processaPaginacao();
    ?>
    <div class="line">
        <div  class="pagination">
            <ul>
                <?php
                for ($i = 0; $i < $this->gridData->numPaginas; $i++) {
                    $pg = $i + 1;
                    ?>
                    <li class="<?php echo (!isset($_GET['pg']) && $pg == 1) || (isset($_GET['pg']) && $_GET['pg'] == $pg) ? 'active' : ""; ?>">
                        <a href="#pg<?php echo $pg ?>" onclick="grid<?php echo $_GET['tag'] ?>('<?php echo $pg ?>')"><?= $pg ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</fieldset>