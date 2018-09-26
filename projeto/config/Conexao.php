<?php
/**
 * 
 */
class Conexao
{
	//credenciais de conexão ao BD
	private $host = 'localhost';
	private $dbname = 'camila';
	private $user = 'root';
	private $pass = '';
	//variável que vai armazenar a conexão feita
	private $conexao;

	//método que vai efetuar a conexão e retorná-la 
	public function getConexao(){
		$this->conexao = null; //this.conexao
		try{
			$this->conexao = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->user, $this->pass);
		}catch(PDOException $e){
			echo 'Erro de conexão: '.$e->getMessage();
		}
		//ao final, retorna a conexão efetuada
		return $this->conexao;
	}
}