<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado') {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/certificado.php';

$conexao = new Conexao();
$conexao->Conectar();

$certificado = new Certificado($conexao->conexao);
if(isset($_POST['salvar'])) {
    $status_salvar = $certificado->salvar($_POST['c1'], $_POST['c2'], $_POST['c3'], $_POST['c4'], $_POST['c5'], $_POST['c6'], $_POST['c7'], $_POST['c8'], $_POST['c9'], $_POST['c10'], $_POST['c11'], $_POST['c12']);
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>NOVO DIPLOMA</title>
  </head>
  <body>
   
   <div class="col-md-4 mx-auto" style="margin-top: 20px">

      <a href="certificados.php" class="btn btn-primary mt-2 mb-2">Voltar</a>

    <?php
        if(isset($status_salvar) AND $status_salvar == true) {
    ?>

          <div class="alert alert-success" role="alert">
              Salvo com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == false) {
    ?>

          <div class="alert alert-success" role="alert">
            Erro ao salvar!
          </div>

    <?php
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label class="mt-2">NOME DO ALUNO DIPLOMADO</label>
       <input type="text" name="c1" class="form-control">

       <label class="mt-2">CPF</label>
       <input type="text" name="c2" class="form-control">

       <label class="mt-2">NOME E CÓDIGO DO E-MEC DO CURSO SUPERIOR</label>
       <input type="text" name="c3" class="form-control">

       <label class="mt-2">NOME E CÓDIGO E-MEC DA IES EXPEDIDORA DO DIPLOMA</label>
       <input type="text" name="c4" class="form-control">

       <label class="mt-2">NOME E CÓDIGO E-MEC DA IES REGISTRADORA DO DIPLOMA</label>
       <input type="text" name="c5" class="form-control">

       <label class="mt-2">DATA DE INGRESSO NO CURSO</label>
       <input type="date" name="c6" class="form-control">

       <label class="mt-2">DATA DE CONCLUSÃO DO CURSO</label>
       <input type="date" name="c7" class="form-control">

       <label class="mt-2">DATA DA EXPEDIÇÃO DO DIPLOMA</label>
       <input type="date" name="c8" class="form-control">

       <label class="mt-2">DATA DO REGISTRO DO DIPLOMA</label>
       <input type="date" name="c9" class="form-control">

       <label class="mt-2">IDENTIFICAÇÃO DO NÚMERO DE EXPEDIÇÃO</label>
       <input type="text" name="c10" class="form-control">

       <label class="mt-2">IDENTIFICAÇÃO DO NÚMERO DE REGISTRO</label>
       <input type="text" name="c11" class="form-control">

       <label class="mt-2">NÚMERO DO PROCESSO</label>
       <input type="text" name="c12" class="form-control">

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>