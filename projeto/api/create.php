<?php

	header('Conrent-Type: application/json');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once '../../config/Conexao.php';
		require_once '../../models/Categoria.php';
		$db = new Conexao();
		$conexao = $db->getConexao();
		$cat = new Categoria($conexao);
		$dados = json_decode($dados);
		var_dump($dados);
		$cat->nome = $dados->nome;
		$cat->descricao = $dados->descricao;

		if($cat->create()){
			$res = array('mensagem', 'Erro na criação da categoria');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem' => 'Método não suportado']);
	}
