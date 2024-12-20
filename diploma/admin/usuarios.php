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
if(isset($_GET['excluir_usuario'])) {
   $status_excluir = $usuario->excluir($_GET['excluir_usuario']);
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

    <title>TODOS OS USUÁRIOS</title>
  </head>
  <body>
   
   <div class="col-md-11 mx-auto" style="margin-top: 40px; margin-left: 10px">

      <a href="home.php" class="btn btn-primary mb-2">Voltar</a>

        <h3>TODOS OS USUÁRIOS CADASTRADOS</h3>

        <?php
            if(isset($status_excluir) AND $status_excluir == true) {
        ?>

         <div class="alert alert-success mt-2 mb-2" role="alert">
              Deletado com sucesso!
          </div>

        <?php
           } else if(isset($status_excluir) AND $status_excluir == false) {
        ?>

        <div class="alert alert-danger mt-2 mb-2" role="alert">
              Erro ao tentar excluir!
          </div>

        <?php
           } 
        ?>

        <a href="novo_usuario.php" class="btn btn-success btn-sm mt-4 mb-2"><i class="fas fa-plus-circle"></i> ADICIONAR NOVO</a>

        <div class="table-responsive">
          <table id="tabela" class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#AÇÕES</th>
                <th scope="col">NOME</th>
                <th scope="col">NOME DE USUÁRIO</th>
                <th scope="col">SENHA</th>
                <th scope="col">NÍVEL</th>
              </tr>
            </thead>
            <tbody>

              <?php

                foreach ($usuario->listar() as $dados) {
                  
                
              ?>
              <tr>
                <td>
                  <a class="btn btn-warning btn-sm" href="editar_usuario.php?id_editar=<?php echo $dados['id'] ?>"> <i class="fas fa-edit"></i></a>
                  <a class="btn btn-danger btn-sm" href="usuarios.php?excluir_usuario=<?php echo $dados['id'] ?>"> <i class="fas fa-trash-alt"></i></a>
                </td>
                <td><?php echo $dados['nome']; ?></td>
                <td><?php echo $dados['usuario']; ?></td>
                <td><?php echo $dados['senha']; ?></td>
                <td><?php if($dados['nivel'] == "1") {echo "ADMIN";} else if($dados['nivel'] == "2") {echo "PADRÃO";} ?></td>
              </tr>

              <?php

                  }

              ?>
            </tbody>
          </table>

      </div>
   </div>

   
<script>
          $(document).ready( function () {
            $('#tabela').DataTable({
                 "language": {
                  "lengthMenu": "REGISTROS _MENU_ POR PÁGINA",
                  "zeroRecords": "NENHUM REGISTRO FOI ENCONTRADO!",
                  "info": "MOSTRANDO PÁGINA _PAGE_ de _PAGES_",
                  "infoEmpty": "SEM DADOS!",
                  "infoFiltered": "(filtered from _MAX_ total records)",
                  "search": "PESQUISAR: "
              }
            });
        } );
</script>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    
  </body>
</html>