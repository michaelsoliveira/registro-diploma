<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado') {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/config.php';

$conexao = new Conexao();
$conexao->Conectar();

$config = new Config($conexao->conexao);
if(isset($_POST['atualizar'])) {
    $status_atualizar = $config->atualizar($_POST['usuario'], $_POST['senha']);
}



$dados = $config->recuperar();

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>CONFIGURAÇÕES</title>
  </head>
  <body>
   
   <div class="col-md-4 mx-auto" style="margin-top: 20px">

      <a href="home.php" class="btn btn-primary mt-2 mb-2">Voltar</a>

    <?php
        if(isset($status_atualizar) AND $status_atualizar == true) {
    ?>

          <div class="alert alert-success" role="alert">
              Configurações salvas com sucesso!
          </div>
           
    <?php
        } else if(isset($status_atualizar) AND $status_atualizar == false) {
    ?>

          <div class="alert alert-success" role="alert">
            Erro ao salvar configurações!
          </div>

    <?php
        }
    ?>

    <h4>CONTROLE DE ACESSO AO SISTEMA</h4>
    <hr>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

       <label class="mt-2">NOME DE USUÁRIO: </label>
       <input type="text" name="usuario" class="form-control" value='<?php echo $dados['usuario']; ?>'>

       <label class="mt-2">SENHA DE ACESSO: </label>
       <input type="text" name="senha" class="form-control" value='<?php echo $dados['senha']; ?>'>

       <button class="btn btn-success mt-2 mb-4" name="atualizar">Atualizar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>