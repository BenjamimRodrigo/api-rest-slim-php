<?php

require 'models/Model.php';

class Aluno extends Model {
	
	public function lista(){
		try {
			global $app;
			$sth = $this->PDO->prepare("SELECT * FROM tb_aluno ORDER BY nome_completo ASC LIMIT 100");
			$sth->execute();
			$result = $sth->fetchAll(\PDO::FETCH_ASSOC);

			if(!$result){
				echo json_encode(["status" => true, "alunos" => []]);
			} else {
				echo json_encode(["status" => true, "alunos"=>$result]);
			}
			
		} catch(PDOException $e){
			echo json_encode(["status" => false, "erro"=>$e->errorInfo[2]]);
		}
	}

	public function get($id){
		try {
			global $app;
			$sth = $this->PDO->prepare("SELECT * FROM tb_aluno WHERE codigo = :id");
			$sth ->bindValue(':id', $id);
			$sth->execute();
			$result = $sth->fetch(\PDO::FETCH_ASSOC);
			if(!$result){
				echo json_encode(["status" => true, "aluno" => null]);
			} else {
				echo json_encode(["status" => true, "aluno" => $result]);
			}
		} catch(PDOException $e){
			echo json_encode(["status" => false, "erro" => $e->errorInfo[2]]);
		}
	}

	public function inserir(){
		try {
			global $app;
			$dados = json_decode($app->request->getBody(), true);
			$dados = (sizeof($dados) == 0) ? $_POST : $dados;
			$keys = array_keys($dados);
			
			if (!array_key_exists('nome_completo', $dados)) {
				echo json_encode(["status" => false, "erro" => 'O nome completo do aluno (nome_completo) é obrigatório!']);
			} else {

				$sth = $this->PDO->prepare("INSERT INTO tb_aluno (".implode(',', $keys).") VALUES (:".implode(",:", $keys).")");
				foreach ($dados as $key => $value) {
					$sth ->bindValue(':'.$key, $value);
				}
				$sth->execute();

				// Retorna todos os dados inseridos
				$this->get($this->PDO->lastInsertId());

			}
		} catch(PDOException $e){
			echo json_encode(["status" => false, "erro"=>$e->errorInfo[2]]);
		}
	}

	public function alterar($id){
		try {
			global $app;
			$dados = json_decode($app->request->getBody(), true);
			$dados = (sizeof($dados) == 0) ? $_POST : $dados;
			$keys = array_keys($dados);
			

			if(count($keys) > 0){

				$sqlSET = " SET ";
				foreach ($keys as $key) {
					$sqlSET .= "$key = :$key, ";
				}

				$sql = "UPDATE tb_aluno $sqlSET WHERE codigo = :id";

				$sql = str_replace(',  WHERE', ' WHERE', $sql);

				$sth = $this->PDO->prepare($sql);
				foreach ($dados as $key => $value) {
					$sth ->bindValue(':'.$key, $value);
				}
				$sth ->bindValue(':id', $id);
				$sth->execute();

				// Retorna o aluno alterado
				$this->get($id);
			} else {
				echo json_encode(["status" => false, "erro" => "Nenhum dado foi passado para a alteração."]);
			}
		} catch(PDOException $e){
			echo json_encode(["status" => false, "erro"=>$e->errorInfo[2]]);
		}
	}

	public function deletar($id){
		try {
			global $app;
			$sth = $this->PDO->prepare("DELETE FROM tb_aluno WHERE codigo = :id");
			$sth ->bindValue(':id', $id);
			$sth->execute();
			echo json_encode(["status" => true]);
		} catch(PDOException $e){
			echo json_encode(["status" => false, "erro" => $e->errorInfo[2]]);
		}
	}
	
}
