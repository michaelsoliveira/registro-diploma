<?php
require 'classes/conexao.php';
require 'classes/certificado.php';

if(isset($_POST['consultar']) AND !empty($_POST['c1']) AND !empty($_POST['c2'])) {
    $conexao = new Conexao();
    $conexao->Conectar();

    $certificado = new Certificado($conexao->conexao);
    $retorno = $certificado->consultar($_POST['c1'], $_POST['c2']);
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

   <div class="alert alert-success mt-2" role="alert">
      REGISTRO ENCONTRADO!
   </div>

   <hr>

   <span id="label">NOME DO ALUNO DIPLOMADO: </span> 
   <span><?php echo $retorno['nome_diplomado'] ?></span> <br>

   <span id="label">CPF: </span>
   <span><?php echo $retorno['cpf_diplomado'] ?></span> <br>

   <span id="label">NOME E CÓDIGO DO E-MEC DO CURSO SUPERIOR: </span> 
   <span><?php echo $retorno['nome_codigo_emec_cs'] ?></span> <br>

   <span id="label">NOME E CÓDIGO E-MEC DA IES EXPEDIDORA DO DIPLOMA: </span>  
   <span><?php echo $retorno['nome_codigo_emec_iep'] ?></span> <br>

   <span id="label">NOME E CÓDIGO E-MEC DA IES REGISTRADORA DO DIPLOMA: </span> 
   <span><?php echo $retorno['nome_codigo_emec_ird'] ?></span> <br>

   <span id="label">DATA DE INGRESSO NO CURSO: </span>  
   <span><?php echo date("d/m/Y", strtotime($retorno['data_ingresso_curso'])) ?></span> <br>

   <span id="label">DATA DE CONCLUSÃO DO CURSO: </span> 
   <span><?php echo date("d/m/Y", strtotime($retorno['data_conclusao_curso'])) ?></span> <br>

   <span id="label">DATA DA EXPEDIÇÃO DO DIPLOMA: </span>  
   <span><?php echo date("d/m/Y", strtotime($retorno['data_expedicao_diploma'])) ?></span> <br>

   <span id="label">DATA DO REGISTRO DO DIPLOMA: </span>  
   <span><?php echo date("d/m/Y", strtotime($retorno['data_registro_diploma'])) ?></span> <br>

   <span id="label">IDENTIFICAÇÃO DO NÚMERO DE EXPEDIÇÃO: </span> 
   <span><?php echo $retorno['identificacao_numero_expedicao']; ?></span> <br>

   <span id="label">IDENTIFICAÇÃO DO NÚMERO DE REGISTRO: </span>  
   <span><?php echo $retorno['identificacao_numero_registro']; ?></span> <br>

   <span id="label">NÚMERO DO PROCESSO: </span>  
   <span><?php echo $retorno['numero_processo'] ?></span> <br>

   <hr>

   <a href="index.php" class="btn btn-primary">VOLTAR E REALIZAR OUTRA CONSULTA</a><br><br>

   </div>



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>