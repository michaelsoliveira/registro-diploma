<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado' OR $_SESSION['nivel'] == "2") {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/cursos.php';

$conexao = new Conexao();
$conexao->Conectar();

$cursos = new Curso($conexao->conexao);
if(isset($_POST['salvar'])) {
    $dados = $_POST;
    $status_salvar = $cursos->atualizar($_SESSION['id_editar'], $dados['curso']);
}

if(isset($_GET['id_editar'])) {
    $_SESSION['id_editar'] = $_GET['id_editar'];
}

$dados = $cursos->recuperar($_SESSION['id_editar']);

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>EDITAR CURSO</title>
  </head>
  <body>
   
   <div class="col-md-4 mx-auto" style="margin-top: 20px">

      <a href="cursos.php" class="btn btn-primary mt-2 mb-2">Voltar</a>

    <?php
        if(isset($status_salvar) AND $status_salvar == "salvo") {
    ?>

          <div class="alert alert-success" role="alert">
              Atualizado com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == "erro") {
    ?>

          <div class="alert alert-danger" role="alert">
            Erro ao atualizar!
          </div>

    <?php
        } 
    ?>

         

         
  
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label>CURSO: </label>
       <input type="text" name="curso" maxlength="50" class="form-control" value='<?php echo $dados['curso'] ?>'>

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>