<?php
include("header.php");

$db = new DB();

$banners = $db->getRows("SELECT * FROM banner");
$db = new DB();
$cursos = $db->getRows("SELECT * FROM cursos WHERE situacao = 'A'");
if ($banners) {
    ?>
    <section id="slider" class="boxed-slider">
        <div class="container clearfix">
            <div class="fslider" data-easing="easeInQuad">
                <div class="flexslider">
                    <div class="slider-wrap">
                        <?php
                        foreach ($banners as $banner) {
                            ?>
                            <div class="slide" data-thumb="/uploads/<?php echo $banner->ban_ds_path; ?>">
                                <a href="<?php echo $banner->ban_ds_url; ?>">
                                    <img src="/uploads/<?php echo $banner->ban_ds_path; ?>" alt="Slide 2">
                                    <div class="flex-caption slider-caption-bg"><?php echo $banner->ban_ds_name; ?></div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
}
?>
<!-- Content
============================================= -->
<section id="quemsomos" class="page-section topmargin-lg">
    <div class="container clearfix">

            <h2 class="center">Quem Somos</h2>
            <div class="heading-block center">
            </div>
            <h4>CURSOS A+</h4>
            <p class="nobottommargin">
                <strong>Missão</strong><br />
                Ser coadjuvantes tecnológicos no processo ensino-aprendizagem para que os verdadeiros atores, alunos/alunas e a aprendizagem, possam brilhar em sua trilha profissional. <br />
                <br />
                <strong>Visão</strong><br />
                Toda vez que se anuncia uma vaga no mercado de trabalho, há um chamado intríseco: “busque conhecimento”. E nós vamos buscá-lo para compartilhar no mundo virtual e físico com você aluno, com você aluna.<br />
                <br />
                <strong>Valores</strong><br />
                Interação, Verdade, Afetividade, Contribuição, Apoio, Instrução Positiva, Formação de Qualidade.<br />

                Nós estamos aqui. Nosso sistema, nossos professores e instrutores, todos aliados do seu aprendizado. <br />

                Se você é uma pessoa física ou jurídica e se identificou com nossa filosofia de trabalho, será uma honra tê-lo conosco e poder interagir com você na vida virtual e na presencial!
            </p>

    </div>

</section>
<section id="duvidas" class="page-section topmargin-lg">
    <div class="container clearfix">

            <h2 class="center">Dúvidas</h2>
            <div class="heading-block center">
            </div>
            <br>
            <!--            <<<d></d>></d>iv class="divider"><i class="icon-circle"></i></div> -->
            <div class="col-md-6 col-xs-12 nobottommargin">
                <h4 id="faq-1">Por que matricular-se nos cursosamais.com.br?</h4>
                <p class="nobottommargin">
                    Porque proporcionamos a você o aprendizado significativo com o ensino efetivo por meio do ensino a distância somado ao estudo dirigido. Aliamos qualidade, flexibilidade e economia. Você não precisa estar conectado à internet todo o tempo para poder estudar. Estude quando puder, onde puder e acesse o conteúdo quantas vezes quiser no seu celular, tablete ou computador.<br />
                    Estude, anote suas dúvidas, envie para o tutor e feito isso agende sua aula presencial (Jacarepaguá, Rio de Janeiro, RJ).<br />
                    Assim, estamos apoiando você e garantindo de todas as formas a sua aprendizagem.

                </p>

                <div class="line"></div>
                <h4 id="faq-2">Como eu faço matrícula?</h4>
                <p>Clique em CURSO, escolha aquele que deseja e matricule-se ao lado. Preencha todos os dados do formulário de cadastro, crie seu próprio login e senha e clique em "enviar".<br />
                	Fique atento ao e-mail automático com orientações para que você retorne ao site após ter liberado sua primeira entrada na sala de aula virtual.
				</p>

                <div class="line"></div>
                <h4 id="faq-3">Como entro na sala de aula virtual?</h4>
                <p>
                	No site, no alto, na lateral direita há o item login clique e digite o usuário e a senha que você mesmo cadastrou.
                </p>

                <div class="line"></div>
                <h4 id="faq-4">Como entro na sala de aula virtual?</h4>
                <p>No site, no alto na lateral direita há o item login clique e digite o usuário e a senha que você mesmo cadastrou.</p>
                <div class="line"></div>
            </div>
            <div class="col-md-6 col-xs-12 nobottommargin col_last">
                <h4 id="faq-7">A compra é segura?</h4>
                <p>Sim, a compra é segura. O Pagseguro possui um sistema de segurança aferido e certificado, que garante a confidencialidade das informações aqui disponibilizadas e a venda sem prejuízo à sua segurança. Além disso, você mesmo ao fazer sua liberação através do e-mail tem a garantia de acesso a Sala de Aula Virtual.</p>
                <div class="line"></div>

                <h4 id="faq-8">Duração mínima de cursos?</h4>
                <p>Não há duração mínima, pois a distância você faz o seu tempo. Mas, para uma melhor organização estipulamos 1 mês no mínimo assistindo às aulas e pedindo orientação aos professores segundo a agenda de dúvidas e envio de trabalhos. O conteúdo no site ficará disponível para você durante 06 meses.</p>

                <div class="line"></div>
                <h4 id="faq-9">O professor/tutor estará disponível por quanto tempo?</h4>
                <p>Durante o período da agenda. Verifique a agenda ao lado de cada módulo.</p>

                <div class="line"></div>
                <h4>Há algum custo além do valor do módulo? </h4>
                <p>Apenas a matrícula e o módulo conforme você for terminando seus estudos. Você organiza seus estudos e sua vida financeira. O módulo pode ser pago via boleto bancário ou cartão de crédito através do PagSeguro ou a pedido através do contato para fazer pagamento especial.</p>



            </div>

    </div>
</section>
<!-- #content end -->
<section id="nossoscursos" class="page-section topmargin-lg">
    <h2 class="center">Nossos Cursos</h2>
    <div class="heading-block center">
    </div>
    <div class="container">
        <div class="row">
            <?php
            $i = 0;
            foreach ($cursos as $curso) {
                if($curso->link=="") {
                    continue;
                }
                if ($i == 4) {
                    echo "</div><div class='row'>";
                    $i = 0;
                }
                ?>
                <div class="col-md-3 col-sm-6 produto-item">
                    <div class="block last">
                        <a href="/curso.php/<?php echo $curso->link; ?>" title="<?php echo $curso->titulo_curso; ?>">
                            <div style='width: 213px; height: 120px; overflow: hidden;'>
                                <img src="/uploads/<?php echo $curso->imagem_curso; ?>" onerror="this.src='images/thumb-curso.jpg';" alt="<?php echo $curso->titulo_curso; ?>" />
                            </div>
                            <div class="produto-caption">
                                <h4><?php echo Encoding::utf8($curso->titulo_curso); ?></h4>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
    </div>

</section>
<section id="contato" class="page-section topmargin-lg">
    <h2 class="center">Contato</h2>
    <div class="heading-block center">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="nobottommargin" id="template-contactform" name="template-contactform" action="include/sendemail.php" method="post">
                    <div class="form-process"></div>
                    <div class="col_one_third">
                        <label for="template-contactform-name">Nome <small>*</small></label>
                        <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                    </div>
                    <div class="col_one_third">
                        <label for="template-contactform-email">Email <small>*</small></label>
                        <input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
                    </div>
                    <div class="col_one_third col_last">
                        <label for="template-contactform-phone">Telefone</label>
                        <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="(00)0000-0000" class="sm-form-control" />
                    </div>
                    <div class="clear"></div>
                    <div class="col_full">
                        <label for="template-contactform-subject">Assunto <small>*</small></label>
                        <input type="text" id="template-contactform-subject" name="template-contactform-subject" value="" class="required sm-form-control" />
                    </div>
                    <div class="clear"></div>
                    <div class="col_full">
                        <label for="template-contactform-message">Mensagem <small>*</small></label>
                        <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                    </div>
                    <div class="col_full hidden">
                        <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                    </div>
                    <div class="col_full">
                        <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Enviar a mensagem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
		<div class="whats">
			<a href="https://web.whatsapp.com/send?phone=5521999762416"> <img src="/images/whatsapp.png" alt=""></a>
		</div>
    <br>
    <br>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var ocClients = $("#oc-clients-full");

            ocClients.owlCarousel({
                margin: 30,
                loop: true,
                nav: false,
                autoplay: true,
                dots: false,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    480: {
                        items: 3
                    },
                    768: {
                        items: 4
                    },
                    992: {
                        items: 5
                    },
                    1200: {
                        items: 6
                    }
                }
            });

        });
    </script>
</div>
</div>
</section>
<!-- #content end -->
<?php
include("footer.php");
