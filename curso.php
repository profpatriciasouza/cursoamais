<?php
include("header.php");

// find curso
$link = $_SERVER['REQUEST_URI'];
$link = explode("/curso.php/", $link);
$db = new DB("cursos");
$curso = $db->getRow("SELECT id, titulo_curso, conteudo_site FROM cursos where link = '$link[1]'");
//find indicators
$db = new DB("indicadores");
$indicators = $db->getRows("SELECT ordem, Usuario_Nome FROM indicadores");
?>

<section id="quemsomos" class="page-section topmargin-lg">
    <div class="container clearfix">

            <h2 class="center"><?=$curso->titulo_curso?></h2>
            <div class="heading-block center">
            </div>
            <h4>CURSOS A+</h4>
            <?=$curso->conteudo_site?>


     		<button type="button" class="btn btn-success btn-matriula text-center" data-toggle="modal" data-target=".bd-example-modal-lg"><a href="#">matricule-se</a></button>
    </div>

</section>


<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<form class="nobottommargin" id="template-contactform" name="template-contactform" action="/cadastro.php" method="post">
			<div class="content-cad">
            <div class="form-process"></div>
            <input type="hidden" id="template-contactform-id" name="curso" value="<?=$curso->id?>" />
            <div class="col_half">
                <label for="template-contactform-name">Nome <small>*</small></label>
                <input type="text" id="template-contactform-name" name="Nome" value="" class="sm-form-control required" />
            </div>

            <div class="col_half">
                <label for="template-contactform-name">Sobrenome <small>*</small></label>
                <input type="text" id="template-contactform-sobrenome" name="sobrenome" value="" class="sm-form-control required" />
            </div>

            <div class="col_half">
                <label for="template-contactform-email">Email <small>*</small></label>
                <input type="email" id="template-contactform-email" name="Email" value="" class="required email sm-form-control" />
            </div>

             <div class="col_half">
                <label for="template-contactform-phone">CPF <small>*</small></label>
                <input type="text" id="template-contactform-cpf" name="CPF" value="" class="sm-form-control" />
            </div>

            <div class="col_half">
                <label for="template-contactform-phone">Telefone</label>
                <input type="text" id="template-contactform-phone" name="phone" value="" class="sm-form-control" />
            </div>



            <div class="col_half">
                <label for="template-contactform-subject">Whatsapp <small></small></label>
                <input type="text" id="template-contactform-whatsapp" name="whatsapp" value="" class=" sm-form-control" />
            </div>

            <div class="col_half">
                <label for="template-contactform-subject">Login <small>*</small></label>
                <input type="text" id="template-contactform-login" name="login" value="" class="required sm-form-control" />
            </div>
            <div class="col_half">
                <label for="template-contactform-subject">Senha <small>*</small></label>
                <input type="text" id="template-contactform-senha" name="Senha" value="" class="required sm-form-control" />
            </div>
            <div class="clear"></div>

            <div class="col_full">
                <label for="template-contactform-subject">Quem indicou? <small>*</small></label>
                <select name="Indicou" id="select" class="sm-form-control">
                  <?php foreach ($indicators as $key => $indicator) : ?>
                    <option value="<?=$indicator->ordem?>"><?=$indicator->Usuario_Nome?></option>
                  <?php endforeach;?>
                </select>
            </div>

            <div class="col_full hidden">
                <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
            </div>
            <div class="col_full">
                <button class="button button-3d nomargin button-cad" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">MATRICULE-SE</button>
            </div>
       </div>
   		</form>
    </div>
  </div>
</div>



<?php
include("footer.php");?>
