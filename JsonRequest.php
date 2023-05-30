<?php

class JsonRequest{
    
    private static $campos = ['animal', 'quantidade'];

    public function validarJson($json){
    
        $jsonArray = json_decode($json);

        if(empty($json)){
            throw new \Exception("Json não enviado!");
        }

        $camposJson = array_keys(get_object_vars($jsonArray));

        if(!(self::$campos == $camposJson)){
            throw new \Exception("Campos do Json invalidos. Verifique se os campos estão corretos: ".implode(",", self::$campos));
        }

        return $jsonArray;
    }
}