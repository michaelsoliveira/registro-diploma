<?php

class Conexao {

	public $conexao;
	private $servidor = "132.255.99.40";
	//private $banco = "diploma";
	//private $usuario = "certificado";
	//private $senha = "cert@2021unifap";
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
