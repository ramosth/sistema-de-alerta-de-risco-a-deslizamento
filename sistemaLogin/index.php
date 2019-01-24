<?php
session_start();
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
                    <a href="login1.php"><li><center>Login</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Cadastro de Usuários</h1>  
                <hr>

                 <form method="post" action="processa.php">
                     <!-- Nome<br> -->
                     <input type="text" name="nome" placeholder="Digite o seu nome" class="campo" maxlength="40" required autofocus><br>
                     <!-- Email<br> -->
                     <input type="email" name="email" placeholder="Digite o seu e-mail" class="campo" maxlength="50" required><br><br>

                     <input type="submit" name="salvar" value="Salvar" class="btn">
                     <input type="reset" value="Limpar" class="btn">
                     
                 </form>
           </section>
       </div> 
    </body>

</html>