
<ul class="pagination">
    <?php
    for ($i = 0; $i < $this->numPaginas; $i++) {
        $pg = $i + 1;

        if ($this->paginaAtual - 5 > $i)
            continue;
        if ($this->paginaAtual + 5 < $i)
            continue;

        $get = $_GET;
        unset($get['pg']);
        unset($get['m']);
        unset($get['a']);
        ?>
        <li class="<?php echo (!isset($_GET['pg']) && $pg == 1) || (isset($_GET['pg']) && $_GET['pg'] == $pg) ? 'active' : ""; ?>">
            <a rel="<?php echo $pg; ?>" href="<?php echo $this->url(Map::$area, Map::$modulo, Map::$acao, Map::$parametros); ?>?pg=<?= $pg ?>&<?php echo http_build_query($get); ?>"><?= $pg ?></a>
        </li>
        <?php
    }
    ?>
</ul>