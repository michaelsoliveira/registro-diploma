<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado' OR $_SESSION['nivel'] == "2") {
   header('Location: index.php');
}

require '../classes/conexao.php';
require '../classes/config.php';

$conexao = new Conexao();
$conexao->Conectar();

$configs = new Config($conexao->conexao);
if(isset($_POST['salvar'])) {
    $dados = $_POST;
    $status_salvar = $configs->atualizar($dados['disponivel'], $dados['indisponivel'], $dados['retirado'], $dados['link']);
}

$dados = $configs->getConfigs();

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
        if(isset($status_salvar) AND $status_salvar == TRUE) {
    ?>

          <div class="alert alert-success" role="alert">
              Atualizado com sucesso!
          </div>
           
    <?php
        } else if(isset($status_salvar) AND $status_salvar == FALSE) {
    ?>

          <div class="alert alert-danger" role="alert">
            Erro ao atualizar!
          </div>

    <?php
        } 
    ?>


         
  
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
       <label>MENSAGEM DE DISPONÍVEL PARA RETIRADA: </label>
       <textarea class="form-control" name="disponivel"><?php echo $dados['disponivel'] ?></textarea>

       <label>MENSAGEM DE INDISPONÍVEL PARA RETIRADA: </label>
       <textarea class="form-control" name="indisponivel"><?php echo $dados['indisponivel'] ?></textarea>

         <label>DIPLOMA RETIRADO: </label>
       <textarea class="form-control" name="retirado"><?php echo $dados['retirado'] ?></textarea>

       <label>LINK DE AGENDAMENTO PARA RETIRADA: </label>
       <textarea class="form-control" name="link"><?php echo $dados['link'] ?></textarea>

       <button class="btn btn-success mt-2 mb-4" name="salvar">Salvar</button>
      </form>
   </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>