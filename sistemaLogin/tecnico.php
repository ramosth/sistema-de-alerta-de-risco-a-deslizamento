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
                    <a href="tecnico.php"><li><center>Adicionar Técnico</center></li></a>
                    <a href="consultarTecnico1.php"><li><center>Consultar Técnico</center></li></a>
                    <a href="administrativo1.php"><li><center>Voltar</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Cadastro de Técnicos</h1>  
                <hr>

                 <form method="post" action="cadastrarTecnico1.php">
                     <!-- Nome<br> -->
                     <input type="text" name="nome" placeholder="Digite o seu nome" class="campo" maxlength="40" required autofocus><br>
                     <!-- Email<br> -->
                     <input type="email" name="email" placeholder="Digite o seu e-mail" class="campo" maxlength="50" required><br>
                     <!-- Usuário<br> -->
                     <input type="text" name="usuario" placeholder="Digite o usuario" class="campo" maxlength="50" required><br>
                     <!-- Senha<br> -->
                     <input type="password" name="senha" placeholder="Digite a senha" class="campo" maxlength="20" required><br><br>

                     <input type="submit" name="salvar" value="Salvar" class="btn">
                     <input type="reset" value="Limpar" class="btn">
                     
                 </form>
           </section>
       </div> 
    </body>

</html>