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
    $status_salvar = $registros->atualizar($_SESSION['id_editar'], $dados['nome'], $dados['curso'], $dados['data_disponibilidade'], $dados['usuario_cadastro'], $dados['status']);
}

if(isset($_GET['id_editar'])) {
    $_SESSION['id_editar'] = $_GET['id_editar'];
}

$dados = $registros->recuperar($_SESSION['id_editar']);

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
              Atualizado com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == false) {
    ?>

          <div class="alert alert-danger" role="alert">
            Erro ao atualizar!
          </div>

    <?php
        }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label class="mt-2">NOME</label>
       <input type="text" name="nome" class="form-control" maxlength="50" value='<?php echo $dados['nome'] ?>'>

       <label class="mt-2">CURSO</label>
       <select name="curso" class="form-control">
           <option selected="1"><?php echo $dados['curso']; ?></option>
           <?php
                  foreach ($cursos->listar() as $value) {
                     echo "<option>{$value['curso']}</option>";
                  }
           ?>
       </select>

       <label class="mt-2">DATA DISPONIBILIDADE</label>
       <input type="text" name="data_disponibilidade" class="form-control" maxlength="100" value='<?php echo $dados['data_disponibilidade'] ?>' readonly>

       <label class="mt-2">USUÁRIO QUE CADASTROU</label>
       <input value="<?php echo $dados['usuario_cadastro']; ?>" type="text" name="usuario_cadastro" class="form-control" maxlength="100" readonly>

       <label class="mt-2">STATUS</label>
       <select name="status" class="form-control">
           <option <?php if($dados['status'] == "1") {echo "selected=1";} ?> value="1">PENDENTE DE RETIRADA</option>
           <option <?php if($dados['status'] == "2") {echo "selected=2";} ?> value="2">RETIRADO</option>
       </select>

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>