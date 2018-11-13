<?php 

header("Access-Control-Allow-Origin: *");

try {
	$pdo = require 'conexao.php';

        $repostaFormatada = [
            "geral" => [],
            "plastico" => [],
            "metal" => [],
            "vidro" => []
        ];


        $repostaFormatada['geral'] = 
        $repostaFormatada['plastico'] = 
        $repostaFormatada['metal'] = 
        $repostaFormatada['vidro'] = [
            '1' => 0,
            '2' => 0,
            '3' => 0,
            '4' => 0,
            '5' => 0,
            '6' => 0,
            '7' => 0,
            '8' => 0,
            '9' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0
        ];

        // TOTAL
        $md = $pdo->prepare("SELECT YEAR(data_hora) as ano, MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material WHERE YEAR(data_hora)=:year GROUP BY MONTH(data_hora) ORDER BY data_hora");
        $md->execute(['year'=>$_GET['year']]);    
        $response = $md->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $linha) {
            $repostaFormatada['geral'][ (int)$linha['mes'] ] = (float)$linha['total'];
        }
        
        // PLASTICO
        $md = $pdo->prepare("SELECT YEAR(data_hora) as ano, MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material WHERE tipo = 'plastico' AND YEAR(data_hora) =:year GROUP BY MONTH(data_hora) ORDER BY data_hora");
    	$md->execute(['year'=>$_GET['year']]);    
        $response = $md->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $linha) {
            $repostaFormatada['plastico'][ (int)$linha['mes'] ] = (float)$linha['total'];
        }
        
        // METAL
        $md = $pdo->prepare("SELECT YEAR(data_hora) as ano, MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material WHERE tipo = 'metal' AND YEAR(data_hora) =:year GROUP BY MONTH(data_hora) ORDER BY data_hora");
        $md->execute(['year'=>$_GET['year']]);    
        $response = $md->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $linha) {
            $repostaFormatada['metal'][ (int)$linha['mes'] ] = (float)$linha['total'];
        }
        

        // VIDRO
        $md = $pdo->prepare("SELECT YEAR(data_hora) as ano, MONTH(data_hora) AS mes, SUM(peso) as total FROM usina.material WHERE tipo = 'vidro' AND YEAR(data_hora) =:year GROUP BY MONTH(data_hora) ORDER BY data_hora");
        $md->execute(['year'=>$_GET['year']]);    
        $response = $md->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $linha) {
            $repostaFormatada['vidro'][ (int)$linha['mes'] ] = (float)$linha['total'];
        }

    echo json_encode($repostaFormatada);
    
} catch(Exception $er) {
	echo "ERRO: " . $er->getMessage();
}