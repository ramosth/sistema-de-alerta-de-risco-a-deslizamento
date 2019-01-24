<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "bddeslizamento";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("Não foi possível conectar com o Banco de Dados");

?>