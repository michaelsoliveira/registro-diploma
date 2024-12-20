<?php

class Usuario {

	private $conexao;

	public function __construct($conexao) {
        $this->conexao = $conexao;
	}

	public function listar() {
		$query = "SELECT id, nome, usuario, senha, nivel FROM usuarios ORDER BY nome ASC";
                $stmt = $this->conexao->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function salvar($nome, $usuario, $senha, $nivel) {
                if($this->vDuplicata($nome, $usuario) == true) {
                        $query = "INSERT INTO usuarios(nome, usuario, senha, nivel) VALUES(:nome, :usuario, :senha, :nivel)";
                        $stmt = $this->conexao->prepare($query);
                        $stmt->bindValue(':nome', $nome);
                        $stmt->bindValue(':usuario', $usuario);
                        $stmt->bindValue(':senha', $senha);
                        $stmt->bindValue(':nivel', $nivel);
                        if($stmt->execute()) {
                                return "salvo";
                        } else {
                                return "erro";
                        }
                } else {
                        return "duplicado";
                }
        }


  public function atualizar($id, $nome, $usuario, $senha, $nivel) {
                        $query = "UPDATE usuarios SET nome = :nome, usuario = :usuario, senha = :senha, nivel = :nivel WHERE id = :id";
                        $stmt = $this->conexao->prepare($query);
                        $stmt->bindValue(':nome', $nome);
                        $stmt->bindValue(':usuario', $usuario);
                        $stmt->bindValue(':senha', $senha);
                        $stmt->bindValue(':nivel', $nivel);
                        $stmt->bindValue(':id', $id);
                        if($stmt->execute()) {
                                return "salvo";
                        } else {
                                return "erro";
                        }
        }



        public function vDuplicata($usuario, $nome) {
                $query = "SELECT usuario, nome FROM usuarios WHERE nome = :nome AND usuario = :usuario";
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':usuario', $usuario);
                $stmt->execute();
                $retorno = $stmt->fetch();
                if(empty($retorno)) {
                     return true;
                } else {
                     return false;
                }
        }

        public function excluir($id) {
               $query = "DELETE FROM usuarios WHERE id = :id";
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id', $id);
               if($stmt->execute()) {
                   return true;
               } else {
                   return false;
               }
        }


        public function recuperar($id) {
              $query = "SELECT * FROM usuarios WHERE id = :id";
              $stmt = $this->conexao->prepare($query);
              $stmt->bindValue(':id', $id);
              $stmt->execute();
              return $stmt->fetch();
        }

        public function logar($usuario, $senha) {
              $query = "SELECT nome, usuario, senha, nivel FROM usuarios WHERE usuario = :usuario AND senha = :senha";
              $stmt = $this->conexao->prepare($query);
              $stmt->bindValue(":usuario", $usuario);
              $stmt->bindValue(":senha", $senha);
              $stmt->execute();
              return $stmt->fetch();
        }
}

?>