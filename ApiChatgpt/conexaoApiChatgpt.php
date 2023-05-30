<?php

class ConexaoApi{
    private $apiKey = 'sua secret key da api openAi';
    private $url = 'https://api.openai.com/v1/engines/';
    private $resposta;

    public function conectar($input){
        $data = array(
            'prompt' => $input,
            'max_tokens' => 256
        );
        
        $dataJson = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url.'text-davinci-003/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $dataJson,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey
            )
        ));

        $resposta = curl_exec($curl);
        curl_close($curl);
        
        $info = curl_getinfo($curl);
        $statusCode = $info['http_code'];

        if($resposta === false){
            $resultado = curl_error($curl);
            $this->resposta = $resultado;
        }else{
            if($statusCode == 200){
                $resultado = json_decode($resposta, true);     
                $texto = $resultado['choices'][0]['text'];
                $this->resposta = $texto;
            }else{
                $resultado = json_decode($resposta, true); 
                $error = $resultado['error'];
                $messagem = $error['message'];
                $this->resposta = $messagem;
            }
            
        }
    }

    public function getResposta(){
        return $this->resposta;
    }
}
