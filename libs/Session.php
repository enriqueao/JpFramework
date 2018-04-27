<?php

Class Session{
    
    static function init(){
        @session_start();
    }
    
    static function destroy(){
        session_destroy();
    }
    
    static function getValue($var){
        return (isset($_SESSION[ID_SESSION][$var])) ? $_SESSION[ID_SESSION][$var] : null ;
    }
    
    //Crear una variable de session con un valor
    static function setValue($var, $val){
        $_SESSION[ID_SESSION][$var] = $val;
    }
    
    static function unsetValue($var){
        if(isset($_SESSION[ID_SESSION][$var])){
            unset($_SESSION[ID_SESSION][$var]);
        }
    }
    
    static function exist(){
        return (isset($_SESSION[ID_SESSION])) ? true : false ;
    }
    
    static function existVar($var){
        return (isset($_SESSION[ID_SESSION][$var])) ? true : false;
    }

}
?>