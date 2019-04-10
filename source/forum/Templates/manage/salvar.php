<?
//require "../../../../config.php";

 ob_start();

# DADOS A SEREM ALTERADOS
#-----------------------------------------------------------
# Configuracoes de banco de dados
#-----------------------------------------------------------

//$host ="127.0.0.1"; 
//$usuario_base_dados="root"; 
//$senha_base_dados="";
//$base_dados="cursos_mais";



$host="mysql05.cursosamais.com.br"; // SERVIDOR E PORTA UTILIZADA   
$usuario_base_dados="cageconsult6"; // BASE DE DADOS 
$base_dados="cageconsult6"; // USURIO DO MYSQL
$senha_base_dados="ensino2016!"; // SENHA DO MYSQL



# Nao alterar nada abaixo
$conexao=@mysql_connect ("$host", "$usuario_base_dados", "$senha_base_dados") or die ('falha conexo CONFIG.PHP: ' . mysql_error());
mysql_select_db ("$base_dados") or die("falha select DB CONFIG.PHP: ");



ob_end_flush();

if (isset($_POST['acao']) && $_POST['acao']=="cadastrar"){

$Title = $_POST['Title'];
$Body = $_POST['Body'];
$Author = $_POST['Author'];
$produto = $_POST['produto'];
$id = $_POST['id_forum'];



if(!empty($id)){	
$sql = mysql_query("UPDATE feedback SET
Title='$Title',
Body='$Body',
produto='$produto'
where id ='$id'")or trigger_error('Erro ao executar consutla. Detalhes = ' . mysql_error());
} else {
$sql = mysql_query("INSERT INTO feedback (Title, Body, Author, TheDate, produto) VALUES ('$Title', '$Body', '$Author', '$TheDate','$produto')") or trigger_error('Erro ao executar consutla. Detalhes = ' . mysql_error());
}

echo "<script>window.location='http://www.cursosamais.com.br/acesso.php/forum/manage';alert('Forum editado com sucesso');</script>";

}

?>
