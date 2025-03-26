<?php
session_start();
if(isset($_SESSION['estado']) AND $_SESSION['estado'] != 'logado') {
   header('Location: index.php');
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


    <title>Painel de Controle</title>
  </head>
  <body>
   
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PAINEL DE CONTROLE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="certificados.php"><i class="fas fa-file-alt"></i> DIPLOMAS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="configuracoes.php"><i class="fas fa-cogs"></i> CONFIGURAÇÕES</a>
          </li>   
          <li class="nav-item">
            <a class="nav-link active" href="importacao.php"><i class="fas fa-cogs"></i> Importar Dados</a>
          </li>    
        </ul>

        <div align="right">
                  <a class="btn" href="logout.php" style="color: white"><i class="fas fa-power-off"></i> SAIR</a>
           </div>
      </div>
    </div>
  </nav>
</header> 

   




    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>