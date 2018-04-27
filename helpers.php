<?php


function print_array(Array $arreglo)
{
    echo "<pre>";
    print_r($arreglo);
    echo "</pre>";
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function changeJsConfig(bool $opcion)
{
    if($opcion){
        @$file = fopen("public/js/config.js", "w");
        @fwrite($file,
            'var config = {
                url: "'.URL.'",
                img: "'.URL.'public/images/"
            }
            var imported = document.createElement("script");
            imported.src = "'.URL.'public/js/complementos.js";
            document.head.appendChild(imported);' . PHP_EOL);
        @fclose($file);
    }
}

?>