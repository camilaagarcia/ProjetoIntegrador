<?php
header('Content-type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'PUT'){

	require_once '../../config/Conexao.php';
	require_once '../../models/Categoria.php';

	$dados = json_decode(file_get_contents('php://input'));

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Categoria($conexao);

	$cat->id = $dados->nome;
	$cat->nome = $dados->nome;
	$cat->descricao = $dados->descricao; 

	if($cat->update()){
		$dados = ['mensagem' => 'Categoria alterada'];
	}else{
		$dados = ['mensagem' => 'Categoria não criada'.$e->getMesage()];
	}
	echo json_encode($dados);
}else{
	echo json_encode(['mensagem' => 'Método não suportado']);
}