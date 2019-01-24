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
          <a href="index.php"><li><center>Voltar</center></li></a>
        </ul>
      </nav>

      <section>
        <h1>Login de Técnico Cadastrado</h1>
        <hr>

        <form method="post" action="valida1.php" accept-charset="utf-8">
            <!-- Usuário<br> -->
            <input type="text" name="usuario" placeholder="Digite o seu usuário" class="campo" maxlength="40" required autofocus><br>
            <!-- Senha<br> -->
            <input type="password" name="senha" placeholder="Digite a sua senha" class="campo" maxlength="20" required><br><br>

            <input type="submit" name="btnLogin" value="Acessar" class="btn">
            <input type="reset" value="Limpar" class="btn">
                     
        </form>
      </section>
    </div> 
  </body>
</html>