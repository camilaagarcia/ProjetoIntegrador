<?php 

header("Access-Control-Allow-Origin: *");

try {
	$pdo = require 'conexao.php';
    $md = $pdo->prepare("SELECT DISTINCT YEAR(data_hora) as ano FROM usina.material");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);       
    echo json_encode($response);
} catch(Exception $er) {
	echo "ERRO: " . $er->getMessage();
}