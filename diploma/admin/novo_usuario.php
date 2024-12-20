<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado' OR $_SESSION['nivel'] == "2") {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/usuario.php';

$conexao = new Conexao();
$conexao->Conectar();

$usuario = new Usuario($conexao->conexao);
if(isset($_POST['salvar'])) {
    $dados = $_POST;
    $status_salvar = $usuario->salvar($dados['nome'], $dados['usuario'], $dados['senha'], $dados['nivel']);
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>NOVO USUÁRIO</title>
  </head>
  <body>
   
   <div class="col-md-4 mx-auto" style="margin-top: 20px">

      <a href="usuarios.php" class="btn btn-primary mt-2 mb-2">Voltar</a>

    <?php
        if(isset($status_salvar) AND $status_salvar == "salvo") {
    ?>

          <div class="alert alert-success" role="alert">
              Salvo com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == "erro") {
    ?>

          <div class="alert alert-danger" role="alert">
            Erro ao salvar!
          </div>

    <?php
        } else if(isset($status_salvar) AND $status_salvar == "duplicado") {
    ?>

          <div class="alert alert-danger" role="alert">
            Já existe um usuário com esses dados!
          </div>

    <?php
         }
    ?>

         
  
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label>NOME: </label>
       <input type="text" name="nome" maxlength="50" class="form-control">

       <label>NOME DE USUÁRIO: </label>
       <input type="text" name="usuario" maxlength="50" class="form-control">

       <label>SENHA: </label>
       <input type="text" name="senha" maxlength="50" class="form-control">

       <label>NÍVEL: </label>
       <select name="nivel" class="form-control">
           <option value="1">ADMIN</option>
           <option value="2">PADRÃO</option>
       </select>

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>