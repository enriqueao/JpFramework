<?php

Class View{
    
    public function render($controller, $view, $estrict = false){
    	if($estrict == false){
    		$controller = get_class($controller);
    	}
        require_once ('./views/'.$controller.'/'.$view.'.php');
    }
}