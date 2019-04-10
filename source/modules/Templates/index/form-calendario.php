<section class="panel">
    <header class="panel-heading">
        Calendário
        <span class="tools pull-right">
            <a class="fa fa-chevron-up" href="javascript:;"></a>
        </span>
    </header>
    <div class="panel-body" style="display:none;">
        <?php
        $HTMLInput = new HTML_Input("inicio", "data", "inicio", "Data de ínicio", "Preencha a data de ínicio");
        $HTMLInput->value = date("d/m/Y", strtotime($this->data->inicio));
        $HTMLInput->build();
        
        $HTMLInput = new HTML_Input("fim", "data", "fim", "Data de fim", "Preencha a data de fim");
        $HTMLInput->value = date("d/m/Y", strtotime($this->data->fim));
        $HTMLInput->build();
        
        $HTMLInput = new HTML_Input("duvidas_de", "data", "duvidas_de", "Dúvidas de:", "Apartir de quando a pessoa poderá tirar dúvidas?");
        $HTMLInput->value = date("d/m/Y", strtotime($this->data->duvidas_de));
        $HTMLInput->build();
        
        $HTMLInput = new HTML_Input("duvidas_a", "data", "duvidas_a", "Dúvidas até:", "Até quando a pessoa poderá tirar dúvidas?");
        $HTMLInput->value = date("d/m/Y", strtotime($this->data->duvidas_a));
        $HTMLInput->build();
        
        $HTMLInput = new HTML_Input("entrega_ate", "data", "entrega_ate", "Entrega até:", "Até quando a pessoa poderá entregar as atividades??");
        $HTMLInput->value = date("d/m/Y", strtotime($this->data->entrega_ate));
        $HTMLInput->build();
        ?>
        <div class='form-group'>
            <br />
            <button type="submit" class="btn btn-primary">Salvar tudo</button>
        </div>
    </div>
</section>