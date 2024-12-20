<?php
require 'classes/conexao.php';
require 'classes/registros.php';
require 'classes/config.php';

if(isset($_POST['consultar']) AND !empty($_POST['c1']) AND !empty($_POST['c2'])) {
    $conexao = new Conexao();
    $conexao->Conectar();

    $config = new Config($conexao->conexao);
    $configuracoes = $config->getConfigs();

    $registros = new Registro($conexao->conexao);
    $retorno = $registros->consultar(ucwords($_POST['c1']), ucwords($_POST['c2']));
    if($retorno == false) {
         header('Location: index.php?consulta=notfound');
    }
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>CONSULTA DIPLOMA</title>
    <style> label {font-family: arial; font-size: 15px} #label {font-weight: bold} body {font-family: times} </style>
  </head>
  <body>
    
   <div class="col-md-6 mx-auto">

   	<div align="center">
   		<img src="imagens/logo.jpg" class="m-2">
   	</div>

   	  <p align="center">
	   	 	UNIVERSIDADE FEDERAL DO AMAPÁ<br>
			PRÓ-REITORIA DE ENSINO DE GRADUAÇÃO<br>
			DEPARTAMENTO DE REGISTRO E CONTROLE ACADÊMICO<br>

	  </p>

   </div>

   <div class="col-md-8 mx-auto mt-4">

  <?php
      if(!empty($retorno) AND empty($retorno['data_retirada'])) {
  ?>

   <div class="alert alert-success mt-2" role="alert">
      <?php echo $configuracoes['disponivel']; ?>
   </div>

   <hr>

   <span id="label">DISPONÍVEL DESDE: </span> 
   <span><?php echo $retorno['data_disponibilidade'] ?></span> <br><br>

   <p>AGENDE A RETIRADA DO SEU DIPLOMA NO LINK ABAIXO: </p>

   <a href='<?php echo trim($configuracoes['link']) ?>' class="btn btn-warning">AGENDAR</a>
 
  <?php
     }
  ?>


  <?php
     if(!empty($retorno) AND !empty($retorno['data_retirada'])) {
  ?>

   <div class="alert alert-success mt-2" role="alert">
      <?php echo $configuracoes['retirado']; ?>
   </div>

   <hr>

   <span id="label">RETIRADO EM: </span> 
   <span><?php echo $retorno['data_retirada'] ?></span> <br>


  <?php
     }
  ?>



  <?php
     if(empty($retorno)) {
  ?>

   <div class="alert alert-danger mt-2" role="alert">
      <?php echo $configuracoes['indisponivel']; ?>
   </div>

   <hr>


  <?php
     }
  ?>
   

   <hr>

   <a href="index.php" class="btn btn-primary">VOLTAR E REALIZAR OUTRA CONSULTA</a><br><br>

   </div>



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>