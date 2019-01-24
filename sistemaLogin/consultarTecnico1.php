<?php

include_once("conexao.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";

$sql = "select * from tbtecnicos where nome like '%$filtro%' order by nome";
$consulta = mysqli_query($conn, $sql);
$registros = mysqli_num_rows($consulta); //informa quantas linhas existem no BD

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
                    <a href="consultarTecnico1.php"><li><center>Consultar Técnico</center></li></a>
                    <a href="tecnico.php"><li><center>Voltar</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Consulta aos Dados de Técnico Cadastrado</h1>  
                <hr><br>

                <form method="get" action="">
                    Filtrar por Nome: <input type="text" name="filtro" class="campo" required autofocus>
                    <input type="submit" value="Pesquisar" class="btn">
                </form>

                <?php 

                  if(isset($_GET['pesquisar'])) {
                    print "Resultado da pesquisa com a palavra <strong>$filtro</strong>.<br><br>";

                    print "$registros registros encontrados.";

                    print "<br><br>";

                    //laço de repeticao para buscar cada registro na tabela
                    while ($exibirRegistros = mysqli_fetch_array($consulta)) {

                      $id = $exibirRegistros[0];
                      $nome = $exibirRegistros[1];
                      $email = $exibirRegistros[2];
                      $usuario = $exibirRegistros[3];
                      $senha = $exibirRegistros[4];
                      $dataCriacao = $exibirRegistros[5];

                      print "<article>";

                      print "id: $id<br>";
                      print "Nome: $nome<br>";
                      print "E-mail: $email<br>";
                      print "Usuário: $usuario<br>";
                      print "Senha: $senha<br>";
                      print "Data de Cadastro: $dataCriacao";

                      print "</article>";
                    }

                    mysqli_close($conn);
                } else  {
              
                    print "$registros registros encontrados.";

                    print "<br><br>";

                    //laço de repeticao para buscar cada registro na tabela
                    while ($exibirRegistros = mysqli_fetch_array($consulta)) {

                      $id = $exibirRegistros[0];
                      $nome = $exibirRegistros[1];
                      $email = $exibirRegistros[2];
                      $usuario = $exibirRegistros[3];
                      $senha = $exibirRegistros[4];
                      $dataCriacao = $exibirRegistros[5];

                      print "<article>";

                      print "id: $id<br>";
                      print "Nome: $nome<br>";
                      print "E-mail: $email<br>";
                      print "Usuário: $usuario<br>";
                      print "Senha: $senha<br>";
                      print "Data de Cadastro: $dataCriacao";

                      print "</article>";
                    }

                    mysqli_close($conn);
                }
                 ?>

           </section>
       </div> 
    </body>

</html>