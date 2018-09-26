<?php

/**
 * 
 */
class Categoria
{
	//atributos correspondentes aos da tabela categoria
	public $id;
	public $nome;
	public $descricao;
	//variável para a conexão
	private $conexao;

	//sempre que um objeto é instanciado, já recebe a conexão
	public function __construct($con)
	{
		$this->conexao = $con;
	}

	//faz uma consulta e retorna o resultado
	public function read($id=null){

		if(isset($id)){ //id tem valor
			$query = "select id, nome, descricao from categoria where id=:id";
			//prepara a execução
			$stmt = $this->conexao->prepare($query);
			$stmt->bindParam('id', $id);
		}else{ //id não tem valor
			$query = "select id, nome, descricao from categoria order by nome";
			//prepara a execução
			$stmt = $this->conexao->prepare($query);
		}
		
		//executa a consulta
		$stmt->execute();
		//transforma o resultado em um Array
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//retorna o resultado
		return $resultado;
	}

	public function create(){
	$query = 'insert into categoria (nome, descricao) value (:nome, :descricao)';
	$stmt = $this->conexao->prepare($query);
	$stmt->bindParam('nome', $this->nome);
	$stmt->bindParam('descricao', $this->descricao);
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}

	public function update(){
		$query = 'update categoria set (nome = :nome, descricao = :descricao) WHERE id=id';
		$stmt= $this->conexao->prepare($query);
		$stmt->bindParam('id', $this->id);
		$stmt->bindParam('nome', $this->nome);
		$stmt->bindParam('descricao', $this->descricao);
		if($stmt->execute()){
			return true;
		}else{
		return false;
		}
	}

	public function delete(){
		$query = 'delete categoria WHERE id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam('id', $this->id);
		id($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}