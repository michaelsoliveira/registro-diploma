<?php

class Conexao {

	public $conexao;
	private $servidor = "localhost";
	private $banco = "registro";
	private $usuario = "postgres";
	private $senha = "";
	private $porta = "5432";

	public function Conectar() {
		try {

			$this->conexao = new PDO(
			"pgsql:host=$this->servidor;port=$this->porta;dbname=$this->banco",
			"$this->usuario",
			"$this->senha",
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);

		} catch (PDOException $e) {
             print $e->getMessage();
		}
	}
}

?>