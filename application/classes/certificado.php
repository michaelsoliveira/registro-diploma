<?php

class Certificado {

	private $conexao;

	public function __construct($conexao) {
        $this->conexao = $conexao;
	}

	public function listar() {
        $query = "SELECT * FROM certificados ORDER BY nome_diplomado";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function salvar($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12) {
		$query = "
		INSERT INTO 
		certificados
		(nome_diplomado, cpf_diplomado, nome_codigo_emec_cs, nome_codigo_emec_iep, nome_codigo_emec_ird, data_ingresso_curso, data_conclusao_curso, data_expedicao_diploma, data_registro_diploma, identificacao_numero_expedicao, identificacao_numero_registro, data_publicacao_dou) 
		VALUES(:c1, :c2, :c3, :c4, :c5, :c6, :c7, :c8, :c9, :c10, :c11, :c12)";

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':c1', $c1);
		$stmt->bindValue(':c2', $c2);
		$stmt->bindValue(':c3', $c3);
		$stmt->bindValue(':c4', $c4);
		$stmt->bindValue(':c5', $c5);
		$stmt->bindValue(':c6', $c6);
		$stmt->bindValue(':c7', $c7);
		$stmt->bindValue(':c8', $c8);
		$stmt->bindValue(':c9', $c9);
		$stmt->bindValue(':c10', $c10);
		$stmt->bindValue(':c11', $c11);
		$stmt->bindValue(':c12', $c12);
		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function atualizar($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $id) {
		$query = "
		UPDATE  
		certificados
		SET
		nome_diplomado = :c1, cpf_diplomado = :c2, nome_codigo_emec_cs = :c3, nome_codigo_emec_iep = :c4, nome_codigo_emec_ird = :c5, data_ingresso_curso = :c6, data_conclusao_curso = :c7, data_expedicao_diploma = :c8, data_registro_diploma = :c9, identificacao_numero_expedicao = :c10, identificacao_numero_registro = :c11, data_publicacao_dou = :c12 
		WHERE id_certificado = :id";

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':c1', $c1);
		$stmt->bindValue(':c2', $c2);
		$stmt->bindValue(':c3', $c3);
		$stmt->bindValue(':c4', $c4);
		$stmt->bindValue(':c5', $c5);
		$stmt->bindValue(':c6', $c6);
		$stmt->bindValue(':c7', $c7);
		$stmt->bindValue(':c8', $c8);
		$stmt->bindValue(':c9', $c9);
		$stmt->bindValue(':c10', $c10);
		$stmt->bindValue(':c11', $c11);
		$stmt->bindValue(':c12', $c12);
		$stmt->bindValue(':id', $id);
		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}


	public function excluir($id) {
		$query = "DELETE FROM certificados WHERE id_certificado = :id";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $id);
		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function recuperar($id) {
        $query = "SELECT * FROM certificados WHERE id_certificado = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
	}

	public function consultar($c1, $c2) {
		$query = "SELECT * FROM certificados WHERE data_registro_diploma = :c1 AND identificacao_numero_registro = :c2";
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