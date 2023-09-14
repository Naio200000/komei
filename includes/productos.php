<?php

/**
 * Devuelve un array con el catalogo completo
 * @return array Array del catalogo completo
 */
function catalogoCompleto () :array {

	$productosJSON = file_get_contents('datos/productos.json');
	$productos = json_decode($productosJSON, true);
	return $productos;
}

function catalogoCategoria (string $categoria) :array {

	$resultado = [];
	$productos = catalogoCompleto();
	foreach ($productos as $C) {
		if ($C['categoria'] == $categoria) {
			$resultado[] = $C;
		}
	}
	return $resultado;

}

?>
