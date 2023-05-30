<?php

include 'NomesAnimais.php';

header('Content-Type: application/json');
$data = file_get_contents('php://input');

try{
    $nomesAnimais = new NomesAnimais($data);
    $nomesAnimais->construirPrompt();
    $resposta = $nomesAnimais->capturarNomes();
    http_response_code(200);
    echo json_encode(['status'=>'success', 'data'=> $resposta ], JSON_INVALID_UTF8_SUBSTITUTE  );
} catch(Exception $e){
    http_response_code(404);
    echo json_encode(['status'=>'error',   'data'=> $e->getMessage()]);
}  
