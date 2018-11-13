<?php 

header("Access-Control-Allow-Origin: *");

try {
	$pdo = require 'conexao.php';
    $md = $pdo->prepare("SELECT sum(peso) as total FROM usina.material;");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);       
    echo json_encode((float)$response[0]['total']);
} catch(Exception $er) {
	echo "ERRO: " . $er->getMessage();
}