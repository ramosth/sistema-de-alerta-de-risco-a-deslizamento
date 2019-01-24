<?php
session_start(); //para poder gravar as informações nas variaveis globais
include_once("conexao.php");

if(isset($_POST['salvar'])) {
	/*$nome = $_GET['nome'];
	$email = $_GET['email'];
	$usuario = $_GET['usuario']; 
	$senha = $_GET['senha'];*/

	$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); 
  	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); 
  	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING); 
  	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); 

	//Pesquisar o usuário no BD
	  $sql = "INSERT INTO tbtecnicos(nome, email, usuario, senha, dataCriacao) VALUES ('$nome', '$email', '$usuario', '$senha', NOW())"; 
	  $enviar = mysqli_query($conn, $sql);
	  $linhas = mysqli_affected_rows($conn); //informa quantas linhas foram afetadas
}
else{
	//mensagem de erro pois mesmo que alguem tente acessar a pagina só com o endereço (url) não terá exito porque é preciso apertar o botao apos informar usuario e senha
  	header("Location: index.php"); //redimenciona o usuario para uma pagina correta, no caso, "index.php"
  	exit;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Sistema de Deslizamento - Login: PHP + MySQL</title>
    	<link rel="stylesheet" href="_css/estilo.css">
	</head>

    <body>
       <div class="container">
           <nav>
                <ul class="menu">
                    <a href="tecnico.php"><li>Cadastro de Técnicos</li></a>
                </ul>
           </nav>
           <section>
                <h1>Confirmação de Cadastro de Técnico</h1>  
                <hr><br><br>

                <?php 
                	if($linhas == 1){
                		print "<center><h1><p style='color:green;'>Cadastro de Técnico efetuado com sucesso! </p></h1></center>";
                	}
                	else{
                		print "<center><h1><p style='color:red;'>Cadastro NÃO efetuado.<br>Já existe um técnico com este e-mail.<br>Tente Novamente.</p></h1></center>";
                	}
                 ?>

           </section>
       </div> 
    </body>

</html>