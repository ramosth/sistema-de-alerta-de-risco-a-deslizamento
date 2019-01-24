<?php

	//referencia ao arquivo que faz a conexao do mysql(banco de dados) e servidor local
	include ("conexao.php");

	//declaracao dos parametros que serao passados pela requisicao get
	$sensor1 = $_GET['sensor1'];
	$sensor2 = $_GET['sensor2'];
	$sensor3 = $_GET['sensor3'];

	//definicao da tabela e dos valores que serão passados para o mesma
	$sql = "INSERT INTO tbdadossensores (sensor1, sensor2, sensor3, data_hora) VALUES ('$sensor1', '$sensor2', '$sensor3', NOW())";
	$enviar = mysqli_query($conn, $sql);

  	/*$linhas = mysqli_affected_rows($conn); //informa quantas linhas foram afetadas

	if($linhas == 1){
        print "<center><h1><p style='color:green;'>Cadastro efetuado com sucesso! </p></h1></center>";
    }
    else{
        print "<center><h1><p style='color:red;'>Cadastro NÃO efetuado.</p></h1></center>";
    }*/

	mysqli_close($conn);
?>