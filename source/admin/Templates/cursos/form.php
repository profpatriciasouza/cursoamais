<?php
$this->getHeader();
?>
<div class="page-heading">
    <h2>Cursos</h2>  
    <p>Veja seus cursos cadastrados</p>
    <div class='wrapper'>
        <div class='row'>
            <div class="row">
                <div class="col-md-12">
                    <!--notification start-->

                    <?php
                    Error::showAlerts();
                    ?>

                    <form method='POST' action="" enctype='multipart/form-data'>
                        <section class="panel">
                            <header class="panel-heading">
                                Dados do curso
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <?php
                                $HTMLInput = new HTML_Input("titulo_curso", "text", "titulo_curso", "Título", "", true);
                                $HTMLInput->value = Encoding::utf8($this->curso->titulo_curso);
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("link", "text", "link", "Link", "Informe o link para este curso Ex: curso-de-maquiagem", true);
                                $HTMLInput->value = $this->curso->link;
                                $HTMLInput->help = "Você deve preencher o nome do curso, sem espaço e sem acentuação, por exemplo: curso-de-maquiagem";
                                $HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("conteudo_site", "rte", "conteudo_site", "Conteúdo para o site", "Preencha o conteúdo do site", true);
                                $HTMLInput->value = $this->curso->conteudo_site;
                                $HTMLInput->build();
                                ?>
                                <div class='row'>
                                    <?php
                                    $HTMLInput = new HTML_Input("matricula", "money", "matricula", "Matrícula", "", true);
                                    $HTMLInput->value = $this->curso->matricula.".00";
                                    $HTMLInput->class = "col-xs-6";
                                    $HTMLInput->build();
                                    ?>
                                    <?php
                                    $HTMLInput = new HTML_Input_Select("situacao", "situacao", "Situação", "", true);
                                    $HTMLInput->addOption(new HTML_Input_Select_Option("A", "Ativo", true));
                                    $HTMLInput->addOption(new HTML_Input_Select_Option("N", "Inativo"));
                                    $HTMLInput->class = "col-xs-6";
                                    $HTMLInput->value = $this->curso->situacao;
                                    $HTMLInput->build();
                                    ?>
                                </div>

                                <?php
                                $HTMLInput = new HTML_Input("linkparceiro", "text", "linkparceiro", "Link para acesso a parceiro", "Informe o link para parceiro", true);
                                $HTMLInput->value = $this->curso->linkparceiro;
                                //$HTMLInput->build();
                                ?>
                                <?php
                                $HTMLInput = new HTML_Input("imagem_curso", "file", "imagem_curso", "Imagem do curso", "Informe uma imagem para o curso", true);
                                $HTMLInput->value = $this->curso->imagem_curso;
                                $HTMLInput->build();
                                ?>
                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <header class="panel-heading">
                                Abas
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-up" href="javascript:;"></a>
                                </span>
                            </header>
                            <div class="panel-body" style='display:none;'>
                                <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    $titulo = "tit" . $i;
                                    $HTMLInput = new HTML_Input($titulo, "text", $titulo, "Título", "Digite o título");
                                    $HTMLInput->value = $this->curso->$titulo;
                                    $HTMLInput->build();

                                    $descricao = "descr" . $i;
                                    $HTMLInput = new HTML_Input($descricao, "textarea", $descricao, "Descrição", "Digite a descrição");
                                    $HTMLInput->value = $this->curso->$descricao;
                                    $HTMLInput->build();
                                }
                                ?>
                                <div class='form-group'>
                                    <br />
                                    <button type="submit" class="btn btn-primary">Salvar tudo</button>
                                </div>
                            </div>
                        </section>
                    </form>


                    <!--notification end-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->getFooter();

