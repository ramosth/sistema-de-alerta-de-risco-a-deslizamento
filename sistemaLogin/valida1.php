<?php
session_start();
include_once("conexao.php");

//se o usuario clica no botão "Acessar" da pagina "login1.php" entra nesta verificação 
if(isset($_POST['btnLogin'])) {
  $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING); //recebe o valor do campo "usuario" da pagina "login.php" e armazena em uma nova variavel na pagina atual "valida.php"
  $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING); //cria senha criptografada, ou seja, transforma a senha digitada em 32 caracteres aleatorios. Sempre a mesma sequencia de caracteres para uma mesma senha.
  
  if((!empty($usuario)) and (!empty($senha))) {

    //Pesquisar o usuário no BD
    $result_usuario = "SELECT * FROM tbtecnicos WHERE usuario='$usuario' and senha='$senha'"; 
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $row_usuario = mysqli_fetch_assoc($resultado_usuario);

    if($row_usuario){

        // as variaveis globais irao receber o valor que vem do banco de dados, ou seja, de usuarios cadastrados
        $_SESSION['id'] = $row_usuario['id'];
        $_SESSION['nome'] = $row_usuario['nome'];
        $_SESSION['email'] = $row_usuario['email'];
        header("Location: administrativo1.php");
    }else{
        header("Location: login1.php");
        exit;
    }

  }else{
    header("Location: login1.php");
    exit;
  }
}else{
  //dará "erro" pois mesmo que alguem tente acessar a pagina só com o endereço (url) não terá êxito porque é preciso apertar o botao apos informar usuario e senha
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
                </ul>
           </nav>
           <section>
                <h1>Confirmação de Login</h1>  
                <hr><br><br>
           </section>
       </div> 
    </body>

</html>