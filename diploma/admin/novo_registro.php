<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado') {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/registros.php';
require '../classes/cursos.php';

$conexao = new Conexao();
$conexao->Conectar();

$cursos = new Curso($conexao->conexao);

$registros = new Registro($conexao->conexao);
if(isset($_POST['salvar'])) {
    $dados = $_POST;
    $status_salvar = $registros->salvar($dados['nome'], $dados['curso'], $dados['data_disponibilidade'], $dados['usuario_cadastro'], $dados['status']);
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>NOVO REGISTRO</title>
  </head>
  <body>
   
   <div class="col-md-4 mx-auto" style="margin-top: 20px">

      <a href="registros.php" class="btn btn-primary mt-2 mb-2">Voltar</a>

    <?php
        if(isset($status_salvar) AND $status_salvar == true) {
    ?>

          <div class="alert alert-success" role="alert">
              Salvo com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == false) {
    ?>

          <div class="alert alert-danger" role="alert">
            Erro ao salvar!
          </div>

    <?php
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label class="mt-2">NOME</label>
       <input type="text" name="nome" class="form-control" maxlength="50">

       <label class="mt-2">CURSO</label>
       <select name="curso" class="form-control">
           <?php
               foreach ($cursos->listar() as $value) {
                 echo "<option>{$value['curso']}</option>";
               }
           ?>
       </select>

       <label class="mt-2">DATA DISPONIBILIDADE</label>
       <input value='<?php echo date("d/m/Y") ?>' type="text" name="data_disponibilidade" class="form-control" maxlength="100" readonly>

       <label class="mt-2">USUÁRIO QUE CADASTROU</label>
       <input value="<?php echo $_SESSION['nome']; ?>" type="text" name="usuario_cadastro" class="form-control" maxlength="100" readonly>

       <label class="mt-2">STATUS</label>
       <select name="status" class="form-control">
           <option value="1">PENDENTE DE RETIRADA</option>
           <option value="2">RETIRADO</option>
       </select>

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>