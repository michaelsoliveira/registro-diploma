<?php

class Config {

	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	public function atualizar($usuario, $senha) {
		$query = "UPDATE config SET usuario = :usuario, senha = :senha WHERE id_config = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':usuario', $usuario);
		$stmt->bindValue(':senha', $senha);
		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function recuperar() {
		$query = "SELECT * FROM config WHERE id_config = 1";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function verificar($usuario, $senha) {
		$query = "SELECT * FROM config WHERE usuario = :usuario AND senha = :senha";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':usuario', $usuario);
		$stmt->bindValue(':senha', $senha);
		$stmt->execute();
		if(!empty($stmt->fetch())) {
             return true;
		} else {
			return false;
		}
	}
}


?>