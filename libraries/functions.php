<?php
/**
 * Devuelve el nombre completo del Sensei dependiendo del handler provisto
 * @param string $sensei handler del sensei provisto por el formulario
 * @return string Nombre completo de la persona o un string bacio si no encuentra coinsidencias
 */
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