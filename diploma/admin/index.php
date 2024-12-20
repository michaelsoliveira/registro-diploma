<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] == 'logado') {
   header('Location: home.php');
}
require '../classes/conexao.php';
require '../classes/usuario.php';

if(isset($_POST['logar'])) {
    $conexao = new Conexao();
    $conexao->Conectar();

    $usuario = new Usuario($conexao->conexao);
    $resultado = $usuario->logar($_POST['usuario'], $_POST['senha']);

    if($resultado['usuario'] == $_POST['usuario'] AND $resultado['senha'] == $_POST['senha']) {
         $_SESSION['nome'] = $resultado['nome'];
         $_SESSION['usuario'] = $resultado['usuario'];
         $_SESSION['estado'] = 'logado';
         $_SESSION['nivel'] = $resultado['nivel'];
         header('Location: home.php');
    } else {
         header('Location: index.php?login=erro');
    }
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
     <style> body{ background:  #80dfff; } label{ font-weight: bold; } </style>
    <title>FAZER LOGIN</title>
  </head>
  <body>
   
    <div class="col-md-2 mx-auto" style="margin: 70px;">

      

      <div align="center">
           <img src="../imagens/login.png" width="200" height="200">
      </div>

      <hr>

        <form action="index.php" method="post" class="mt-4">
            <label>Nome de Usuário: </label>
            <input type="text" name="usuario" class="form-control" required>

            <label>Senha: </label>
            <input type="password" name="senha" class="form-control" required>

            <button name="logar" type="submit" class="btn btn-success mt-2 mb-2"><i class="fas fa-sign-in-alt"></i> Logar</button>
        </form>



        <?php
           if(isset($_GET['login']) AND $_GET['login'] == 'erro') {
        ?>

          <div class="alert alert-danger mt-2 mb-3" role="alert">
              Usuário ou senha incorretos!
          </div>

        <?php
            }
        ?>

      

    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>