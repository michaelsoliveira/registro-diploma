<?php

class Curso {

	private $conexao;

	public function __construct($conexao) {
        $this->conexao = $conexao;
	}

	public function listar() {
		$query = "SELECT id, curso FROM cursos ORDER BY curso ASC";
                $stmt = $this->conexao->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function salvar($curso) {
                if($this->vDuplicata($curso) == true) {
                        $query = "INSERT INTO cursos(curso) VALUES(:curso)";
                        $stmt = $this->conexao->prepare($query);
                        $stmt->bindValue(':curso', $curso);
                        if($stmt->execute()) {
                                return "salvo";
                        } else {
                                return "erro";
                        }
                } else {
                        return "duplicado";
                }
        }


  public function atualizar($id, $curso) {
                        $query = "UPDATE cursos SET curso = :curso WHERE id = :id";
                        $stmt = $this->conexao->prepare($query);
                        $stmt->bindValue(':curso', $curso);
                        $stmt->bindValue(':id', $id);
                        if($stmt->execute()) {
                                return "salvo";
                        } else {
                                return "erro";
                        }
        }



        public function vDuplicata($curso) {
                $query = "SELECT curso FROM cursos WHERE curso = :curso";
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':curso', $curso);
                $stmt->execute();
                $retorno = $stmt->fetch();
                if(empty($retorno)) {
                     return true;
                } else {
                     return false;
                }
        }

        public function excluir($id) {
               $query = "DELETE FROM cursos WHERE id = :id";
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':id', $id);
               if($stmt->execute()) {
                   return true;
               } else {
                   return false;
               }
        }


        public function recuperar($id) {
              $query = "SELECT * FROM cursos WHERE id = :id";
              $stmt = $this->conexao->prepare($query);
              $stmt->bindValue(':id', $id);
              $stmt->execute();
              return $stmt->fetch();
        }

}

?>