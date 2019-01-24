<?php

include_once("conexao.php");

//$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";

//$sql = "select * from tbusuarios where nome like '%$filtro%' order by nome";
$sql = "select * from tbusuarios";
$consulta = mysqli_query($conn, $sql);
//$registros = mysqli_num_rows($consulta); //informa quantas linhas existem no BD

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
                  <a href="consultas.php"><li><center>Consultar Usuário</center></li></a>
                    <a href="administrativo1.php"><li><center>Voltar</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Consulta aos Dados de Usuários Cadastrados</h1>  
                <hr><br>

                <!-- <form method="get" action="">
                    Filtrar por Nome: <input type="text" name="filtro" class="campo" required autofocus>
                    <input type="submit" value="Pesquisar" class="btn">
                </form> -->

                <?php 

                  //print "Resultado da pesquisa com a palavra <strong>$filtro</strong>.<br><br>";
                  //print "$registros registros encontrados.";
                  //print "<br><br>";

                  //laço de repeticao para buscar cada registro na tabela
                  while ($exibirRegistros = mysqli_fetch_array($consulta)) {

                    //$id = $exibirRegistros[0];
                    //$nome = $exibirRegistros[1];
                    $email = $exibirRegistros[2];
                    //$dataCriacao = $exibirRegistros[3];

                    print "<article>";

                    //print "$id<br>";
                    print "$email<br>";
                    //print "<center>$email</center><br>";
                    //print "$dataCriacao";

                    print "</article>";
                  }

                  mysqli_close($conn);
                 ?>

           </section>
       </div> 
    </body>

</html>