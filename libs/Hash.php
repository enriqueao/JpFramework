<?php

class Hash{
    
    public static function create($algoritmo,$data,$key){
        $context = hash_init($algoritmo,HASH_HMAC,$key);
        hash_update($context, $data);
        return hash_final($context);
    }
}