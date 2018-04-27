<?php

include_once 'libs/censorWords/censorWords.php';

trait filterWords{
    
    public function matchedWords(String $string)
    {
        $filter = (new CensorWords())->censorString($string);
        return (count($filter['matched']) > 0) ? false : true ;
    }
 
}
?>