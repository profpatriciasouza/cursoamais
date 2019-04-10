<div class="grid-<?= $this->tag ?>">Carregando dados de <? echo $this->nomePrograma; ?></div>
<script>
    
    function grid<?= $this->tag; ?>(pg) {
        pg = pg ===undefined? 1 : pg;
        $.ajax({
            url:'<?php echo $this->getSubCadastroURL($this->tag, 'grid'); ?>&pg='+pg
            , dataType: 'html'
            , success: function(msg) {
                $(".grid-<?= $this->tag ?>").html(msg);
                $(".grid-<?= $this->tag ?> a[rel=facebox]").facebox();
            }
    
        });
    }
    grid<?= $this->tag; ?>(1);

</script>