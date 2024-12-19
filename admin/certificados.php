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
if(isset($_GET['excluir_certificado'])) {
   $status_excluir = $certificado->excluir($_GET['excluir_certificado']);
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

    <title>TODOS OS DIPLOMAS</title>
  </head>
  <body>
   
   <div class="col-md-11 mx-auto" style="margin-top: 40px; margin-left: 10px">

      <a href="home.php" class="btn btn-primary mb-2">Voltar</a>

        <h3>TODOS OS DIPLOMAS CADASTRADOS</h3>

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

        <a href="novo_certificado.php" class="btn btn-success btn-sm mt-4 mb-2"><i class="fas fa-plus-circle"></i> ADICIONAR NOVO</a>

        <div class="table-responsive">
          <table id="tabela" class="table table-hover" style="margin-top: 10px; font-size: 14px; font-family: 'arial'; width: 200%">
            <thead>
              <tr>
                <th scope="col">#AÇÕES</th>
                <th scope="col">NOME DO ALUNO DIPLOMADO</th>
                <th scope="col">CPF</th>
                <th scope="col">NOME E CÓDIGO DO E-MEC DO CURSO SUPERIOR</th>
                <th scope="col">NOME E CÓDIGO E-MEC DA IES EXPEDIDORA DO DIPLOMA</th>
                <th scope="col">NOME E CÓDIGO E-MEC DA IES REGISTRADORA DO DIPLOMA</th>
                <th scope="col">DATA DE INGRESSO NO CURSO</th>
                <th scope="col">DATA DE CONCLUSÃO DO CURSO</th>
                <th scope="col">DATA DA EXPEDIÇÃO DO DIPLOMA</th>
                <th scope="col">DATA DO REGISTRO DO DIPLOMA</th>
                <th scope="col">IDENTIFICAÇÃO DO NÚMERO DE EXPEDIÇÃO</th>
                <th scope="col">IDENTIFICAÇÃO DO NÚMERO DE REGISTRO</th>
                <th scope="col">DATA DE PUBLICAÇÃO DAS INFORMAÇÕES DO REGISTRO DO DIPLOMA NO DOU</th>
              </tr>
            </thead>
            <tbody>

              <?php

                foreach ($certificado->listar() as $dados) {
                  
                
              ?>
              <tr>
                <td>
                  <a class="btn btn-warning btn-sm" href="editar_certificado.php?id_editar=<?php echo $dados['id_certificado'] ?>"> <i class="fas fa-edit"></i></a>
                  <a class="btn btn-danger btn-sm" href="certificados.php?excluir_certificado=<?php echo $dados['id_certificado'] ?>"> <i class="fas fa-trash-alt"></i></a>
                </td>
                <td><?php echo $dados['nome_diplomado']; ?></td>
                <td><?php echo $dados['cpf_diplomado']; ?></td>
                <td><?php echo $dados['nome_codigo_emec_cs']; ?></td>
                <td><?php echo $dados['nome_codigo_emec_iep']; ?></td>
                <td><?php echo $dados['nome_codigo_emec_ird']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($dados['data_ingresso_curso'])); ?></td>
                <td><?php echo date("d/m/Y", strtotime($dados['data_conclusao_curso'])); ?></td>
                <td><?php echo date("d/m/Y", strtotime($dados['data_expedicao_diploma'])); ?></td>
                <td><?php echo date("d/m/Y", strtotime($dados['data_registro_diploma'])); ?></td>
                <td><?php echo $dados['identificacao_numero_expedicao']; ?></td>
                <td><?php echo $dados['identificacao_numero_registro']; ?></td>
                <td><?php echo $dados['data_publicacao_dou']; ?></td>
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