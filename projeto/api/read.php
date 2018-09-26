<?php
//arquivo para testar o metodo read()

	//headers
	header('Acces-Control-Allow-Origin: *');
	header('Content-Type: application/jason');

	include_once '../config/Conexao.php';
	include_once '../models/Categoria.php';

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Categoria($conexao);

	$resultado = $cat->read();

	

	if($qtde_cats>0){
		$arr_categorias = array();
		$arr_categorias['data'] = array();

		while ($row = $resultado->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = array(
				'id'=> $id,
				'nome'=> $nome,
				'descricao'=> $descricao
			);
			array_push($arr_categorias['data'], $item);
		}
		echo json_encode($arr_categorias);
	}else{
		echo json_encode(
			array('mensagem'=>'Nenhuma categorua encontrada')
		);
	}

	print_r($resultado);