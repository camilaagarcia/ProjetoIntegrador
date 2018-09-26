<?php 

try {
	$pdo = require 'conexao.php';
	$dados = file_get_contents('php://input');
	$dados = json_decode($dados);

	$md = $pdo->prepare("INSERT INTO material(id, peso, data_hora) VALUES (:id, :peso, :data_hora)");
	$md->execute([
		'id' => $dados->id,
		'peso' => $dados->peso,
		'data_hora' => $dados->data_hora
	]);

	echo "OK!";
} catch(Exception $er) {
	echo "ERRO: " . $er->getMessage();
}