<?php
include_once("conexao.php");

//se o usuario clica no botão "Salvar" da pagina "index.php" entra nesta verificação 
if(isset($_POST['salvar'])) {
  $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); //recebe o valor do campo "usuario" da pagina "login.php" e armazena em uma nova variavel na pagina atual "valida.php"
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); //cria senha criptografada, ou seja, transforma a senha digitada em 32 caracteres aleatorios. Sempre a mesma sequencia de caracteres para uma mesma senha.
  
  //Pesquisar o usuário no BD
  $sql = "INSERT INTO tbusuarios(nome, email, dataCriacao) VALUES ('$nome', '$email', NOW())"; 
  $enviar = mysqli_query($conn, $sql);
  $linhas = mysqli_affected_rows($conn); //informa quantas linhas foram afetadas

}else{
  print "<center><h1><p style='color:red;'>Página não encontrada </p></h1></center><br>"; //mensagem de erro pois mesmo que alguem tente acessar a pagina só com o endereço (url) não terá exito porque é preciso apertar o botao apos informar usuario e senha
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
                    <a href="index.php"><li><center>Cadastro</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Confirmação de Cadastro</h1>  
                <hr><br><br>

                <?php 
                	if($linhas == 1){
                		print "<center><h1><p style='color:green;'>Cadastro efetuado com sucesso! </p></h1></center>";
                	}
                	else{
                		print "<center><h1><p style='color:red;'>Cadastro NÃO efetuado.<br>Já existe um usuário com este e-mail.<br>Tente Novamente.</p></h1></center>";
                	}
                 ?>

           </section>
       </div> 
    </body>

</html>