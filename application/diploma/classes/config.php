<?php

class Config {
	 public function __construct($conexao) {
           $this->conexao = $conexao;
	 }

	 public function getConfigs() {
	 	  $query = "SELECT * FROM config WHERE id = 1";
	 	  $stmt = $this->conexao->prepare($query);
	 	  $stmt->execute();
	 	  return $stmt->fetch();
	 }

	 public function atualizar($disponivel, $indisponivel, $retirado, $link) {
          $query = "UPDATE config SET disponivel = :disponivel, indisponivel = :indisponivel, retirado = :retirado, link = :link WHERE id = 1";
          $stmt= $this->conexao->prepare($query);
          $stmt->bindValue(':disponivel', $disponivel);
          $stmt->bindValue(':indisponivel', $indisponivel);
          $stmt->bindValue(':retirado', $retirado);
          $stmt->bindValue(':link', $link);
          if($stmt->execute()){
          	  return true;
          } else {
          	  return false;
          }
	 }
}

?>