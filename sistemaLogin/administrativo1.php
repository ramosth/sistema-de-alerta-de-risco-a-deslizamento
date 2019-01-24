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
                    <a href="tecnico.php"><li><center>Configuração de Técnicos</center></li></a>
                    <a href="consultas.php"><li><center>Consulta sobre Usuários</center></li></a>
                    <a href="dadosArduino.php"><li><center>Dados Arduino</center></li></a>
                    <a href="meteorologia_index.php"><li><center>Inserir Dados Meteorológico</center></li></a>
                    <a href="ConsultaMeteorologia.php"><li><center>Consultar Dados Meteorológico</center></li></a>
                    <a href="index.php"><li><center>Sair</center></li></a>
                </ul>
           </nav>
           <section>
                <h1>Área Reservada</h1>  
                <hr>

				<?php //AO PASSAR O ENDEREÇO É POSSIVEL ENTRAR NA AREA ADMINISTRATIVA !!! NÃO É O CORRETO! CORRIJA!!!
	                if(!empty($_SESSION['id'])){
						print "<center><h1><p style='color:green;'>Olá, ".$_SESSION['nome'].", Bem Vindo! </p></h1></center> <br><br>";
					}
					else{
						header("Location: index.php");
						exit;
					}	
                ?>

           </section>
       </div> 
    </body>

</html>