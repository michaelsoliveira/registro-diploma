<?php

class Registro {

	private $conexao;

	public function __construct($conexao) {
        $this->conexao = $conexao;
	}

	public function listar() {
        $query = "SELECT * FROM registros ORDER BY nome";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function salvar($nome, $curso, $data_disponibilidade, $usuario_cadastro, $status, $data_retirada = '', $retirada_informada = '') {
		$query = "
		INSERT INTO 
		registros
		(nome, curso, data_disponibilidade, usuario_cadastro, status, usuario_retirada, data_retirada) 
		VALUES
		(:nome, :curso, :data_disponibilidade, :usuario_cadastro, :status, :usuario_retirada, :data_retirada)";

		if($status == "2") {
             $data_retirada = date("d/m/Y");
             $retirada_informada = $_SESSION['nome'];
		}

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', ucwords($nome));
		$stmt->bindValue(':curso', ucwords($curso));
		$stmt->bindValue(':data_disponibilidade', $data_disponibilidade);
		$stmt->bindValue(':usuario_cadastro', $usuario_cadastro);
		$stmt->bindValue(':status', $status);
		$stmt->bindValue(':data_retirada', $data_retirada);
		$stmt->bindValue(':usuario_retirada', $retirada_informada);
		if($stmt->execute()) {
               return true;
		} else {
			   return false;
		}
	}


	public function atualizar($id, $nome, $curso, $data_disponibilidade, $usuario_cadastro, $status, $data_retirada = '', $retirada_informada = '') {
		$query = "
		UPDATE 
		registros SET
		nome = :nome, curso = :curso, data_disponibilidade = :data_disponibilidade, usuario_cadastro = :usuario_cadastro, status = :status, usuario_retirada = :usuario_retirada, data_retirada = :data_retirada
		WHERE id = :id
		";

		if($status == "2") {
             $data_retirada = date("d/m/Y");
             $retirada_informada = $_SESSION['nome'];
		}

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', ucwords($nome));
		$stmt->bindValue(':curso', ucwords($curso));
		$stmt->bindValue(':data_disponibilidade', $data_disponibilidade);
		$stmt->bindValue(':usuario_cadastro', $usuario_cadastro);
		$stmt->bindValue(':status', $status);
		$stmt->bindValue(':data_retirada', $data_retirada);
		$stmt->bindValue(':usuario_retirada', $retirada_informada);
		$stmt->bindValue(':id', $id);
		if($stmt->execute()) {
               return true;
		} else {
			   return false;
		}
	}

	


	public function excluir($id) {
		$query = "DELETE FROM registros WHERE id = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $id);
		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function recuperar($id) {
        $query = "SELECT * FROM registros WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
	}

	public function consultar($c1, $c2) {
		$c1 = trim($c1);
		$c2 = trim($c2);
		$query = "SELECT * FROM registros WHERE nome = :c1 AND curso = :c2";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':c1', $c1);
		$stmt->bindValue(':c2', $c2);
		$stmt->execute();
		$retorno = $stmt->fetch();
		if(!empty($retorno)) {
              return $retorno;
		} else {
			  return false;
		}

	}
}

?>