<?php

class Conexao {

	public $conexao;

	public function Conectar() {
		try {

			$this->conexao = new PDO(
			getenv('DATABASE_URL'),
			getenv('POSTGRES_USER'),
			getenv('POSTGRES_PASSWORD'),
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);

		} catch (PDOException $e) {
             print $e->getMessage();
		}
	}
}

?>