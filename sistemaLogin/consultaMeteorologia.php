<?php

include_once("conexao.php");

$filtro = isset($_GET['filtro'])?$_GET['filtro']:"";

$sql = "select * from tbmeteorologia where data like '%$filtro%' order by id";
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
                  <a href="ConsultaMeteorologia.php"><li><center>Dados Meteorológico</center></li></a>
                    <a href="administrativo1.php"><li><center>Voltar</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Dados Meteorológico</h1>  
                <hr><br>

                <form method="get" action="">
                    Filtrar por Data: <input type="text" name="filtro" class="campo" required autofocus>
                    <input type="submit" name="pesquisar" value="Pesquisar" class="btn">
                </form>

                <?php 
            

              if(isset($_GET['pesquisar'])) { //se o tecnico clica no botao "Pesquisar", aparece a mensagem sobre qual o dado pesquisado, caso contrario vá para o else, que não mostra essa parte
                  print "Resultado da pesquisa com a data <strong>$filtro</strong>.<br><br>";
                  print "$registros registros encontrados.";

                  print "<br><br>";

                  echo "<table border=\"1\">";

                  echo "<tr>
                      <th><b>DATA</b></th>
                      <th><b>HORA</b></th>
                      <th><b>CHUVA (mm)</b></th>
                      <th><b>DATA/HORA (inserção BD)</b></th>
                    </tr>";

                  //laço de repeticao para buscar cada registro na tabela
                  while ($exibirRegistros = mysqli_fetch_array($consulta)) {

                    echo "<tr>";
                    //echo "<td>" . $id = $exibirRegistros[0] . "</td>";
                    echo "<td>" . $data = $exibirRegistros[1] . "</td>";
                    echo "<td>" . $hora = $exibirRegistros[2] . "</td>";
                    echo "<td>" . $chuva = $exibirRegistros[3] . "</td>";
                    echo "<td>" . $dataHora = $exibirRegistros[4] . "</td>";
                    echo "</tr>";
                  }

                  echo "</table>";

                  mysqli_close($conn);
              }
              else{
                 /* print "$registros registros encontrados.";

                  print "<br><br>";

                  echo "<table border=\"1\">";

                  echo "<tr>
                      <th><b>DATA</b></th>
                      <th><b>HORA</b></th>
                      <th><b>CHUVA (mm)</b></th>
                      <th><b>DATA/HORA (inserção BD)</b></th>
                    </tr>";

                  //laço de repeticao para buscar cada registro na tabela
                  while ($exibirRegistros = mysqli_fetch_array($consulta)) {

                    echo "<tr>";
                    //echo "<td>" . $id = $exibirRegistros[0] . "</td>";
                    echo "<td>" . $data = $exibirRegistros[1] . "</td>";
                    echo "<td>" . $hora = $exibirRegistros[2] . "</td>";
                    echo "<td>" . $chuva = $exibirRegistros[3] . "</td>";
                    echo "<td>" . $dataHora = $exibirRegistros[4] . "</td>";
                    echo "</tr>";
                  }
                  echo "</table>";

                  mysqli_close($conn); */
              }
                 ?>

           </section>
       </div> 
    </body>

</html>