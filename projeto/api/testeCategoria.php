<?php
	header('Content-Type: application/json');
//arquivo para testar o metodo read()
	include_once '../config/Conexao.php';
	include_once '../models/Categoria.php';

	$db = new Conexao();
	$conexao = $db->getConexao();

	$cat = new Categoria($conexao);

	$resultado = $cat->read();

	//print_r($resultado);
	echo json_encode($resultado);