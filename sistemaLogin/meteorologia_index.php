<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Sistema de Deslizamento - Login: PHP + MySQL</title>
    	<link rel="stylesheet" href="_css/estilo.css">
	</head>

    <body>
       <div class="container">
           <nav>
                <ul class="menu">
                    <a href="administrativo1.php"><li><center>Voltar</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Registro de Dados Meteorológicos</h1>  
                <hr>

                <form method="POST" action="inserirDadosMeteorologico.php" enctype="multipart/form-data">
                <label>Arquivo</label>
                <input type="file" name="arquivo"><br><br>
                <input type="submit" name="importar" value="Importar" class="btn">
      
                </form>
				

           </section>
       </div> 
    </body>

</html>