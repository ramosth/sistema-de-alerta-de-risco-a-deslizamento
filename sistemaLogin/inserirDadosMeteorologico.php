<?php
session_start();

//Incluir a conexao com BD
include_once("conexao.php");

  //Receber os dados do formulário
  $arquivo = $_FILES['arquivo'];
  //var_dump($arquivo);
  $arquivo_tmp = $_FILES['arquivo']['tmp_name']; //'arquivo' será o nome dado na pagina index.php, no botão type='file'; tmp_name': informa o enddereço do arquivo temporário 

  //ler todo o arquivo para um array
  $dados = file($arquivo_tmp);
  //var_dump($dados);

  foreach($dados as $linha){
    $linha = trim($linha); //trim: retira os espaços do inicio e fim de cada linha
    $valor = explode(',', $linha); //explode: especifica qual o simbolo que separa cada dado de uma linha, neste caso é ',' mas poderia ser um outro separador.
    //var_dump($valor); //imprime o que está no arquivo
    
    $data = $valor[1];
    $hora = $valor[2];
    $chuva = $valor[19];
    //$datahora = $valor[4];
    
    $result_usuario = "INSERT INTO tbmeteorologia (data, hora, chuva, datahora) VALUES ('$data', '$hora', '$chuva', NOW())";
    
    $resultado_usuario = mysqli_query($conn, $result_usuario);  
  }
  
  header("Location: meteorologia_index.php");

mysqli_close($conn);
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
                </ul>
           </nav>
           <section>
                <h1>Confirmação de Dados</h1>  
                <hr><br><br>
                <?php 
                  
                ?>
           </section>
       </div> 
    </body>

</html>