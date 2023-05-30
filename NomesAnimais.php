<?php

include 'ApiChatgpt/conexaoApiChatgpt.php';
include 'JsonRequest.php';

class NomesAnimais extends JsonRequest
{
    private static $jsonArray;
    private static $prompt;

    public function __construct($json){
        self::$jsonArray = json_decode(json_encode($this->validarJson($json)), true);
    }

    public function construirPrompt(){
        $animal = self::$jsonArray['animal'];
        $qtd = self::$jsonArray['quantidade'];
        self::$prompt =  "Give me ".$qtd." ".$animal." names";
    }

    public function capturarNomes(){
        $connChatgpt = new ConexaoApi();
        $connChatgpt->conectar(self::$prompt);
        $reposta = $connChatgpt->getResposta();
        return $reposta;
    }
}