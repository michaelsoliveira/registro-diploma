<?php
require 'classes/conexao.php';
require 'classes/cursos.php';

$conexao = new Conexao();
$conexao->Conectar();

$cursos = new Curso($conexao->conexao);


?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>CONSULTA DIPLOMA</title>
    <style> label {font-family: arial; font-size: 15px} body {font-family: times} </style>
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

   <div class="col-md-3 mx-auto mt-4">
   	   <hr>

   	   <form action="resultado_consulta.php" method="post">
   	   	  <label class="mt-2">NOME: </label>
   	   	  <input type="text" name="c1" class="form-control" required>

   	   	  <label class="mt-2">CURSO: </label>
   	   	  <select name="c2" class="form-control" required>
             <option>SELECIONE UM CURSO</option>
              <?php
                foreach ($cursos->listar() as $value) {
                    echo "<option>{$value['curso']}</option>";
                }

              ?>
          </select>

   	   	  <button type="submit" class="btn btn-success mt-2" name="consultar"><i class="fas fa-search"></i> CONSULTAR</button>
   	   </form>

   	   <?php
           if(isset($_GET['consulta']) AND $_GET['consulta'] == 'notfound') {
   	   ?>

          <div class="alert alert-danger mt-2" role="alert">
              <i class="fas fa-times-circle"></i> NENHUM RESULTADO PARA A CONSULTA!
          </div>

   	   <?php
   	   		}
   	   ?>


   </div>



    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>