<?php 

header("Access-Control-Allow-Origin: *");

try {
	$pdo = require 'conexao.php';

	 $repostaFormatada = [
        'geral' => [],
        'plastico' => [],
        'metal' => [],
        'vidro' => [],
    ];

    
    $md = $pdo->prepare("SELECT MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material GROUP BY MONTH(data_hora)");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);
    foreach($response as $linha) {
        $repostaFormatada['geral'][] = (float)$linha['total'];
    }
    
    $md = $pdo->prepare("SELECT MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material where tipo = 'plastico' GROUP BY MONTH(data_hora)");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);
    foreach($response as $linha) {
        $repostaFormatada['plastico'][] = (float)$linha['total'];
    }
    
    $md = $pdo->prepare("SELECT MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material where tipo = 'metal' GROUP BY MONTH(data_hora)");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);
    foreach($response as $linha) {
        $repostaFormatada['metal'][] = (float)$linha['total'];
    }
    
    $md = $pdo->prepare("SELECT MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material where tipo = 'vidro' GROUP BY MONTH(data_hora)");
	$md->execute();    
    $response = $md->fetchAll(PDO::FETCH_ASSOC);
    foreach($response as $linha) {
        $repostaFormatada['vidro'][] = (float)$linha['total'];
    }
    

    
    
    
    
    echo json_encode($repostaFormatada);
    
} catch(Exception $er) {
	echo "ERRO: " . $er->getMessage();
}