<?php

function buscaSensei(string $sensei) :string {

    $senseiArray = [
        "@chikaradojo" => "Ruben Dario Vega",
        "@danketsushindojo" => "Javier Alberdi",
        "@suishinshobukandojo" => "Jorge Ruis",
        "@eltemplodojo" => "Horacio Machado"
    ];
    foreach($senseiArray as $k => $v) {
        if ($k == $sensei) {
            return $v;
        }
    }
    return "";
}