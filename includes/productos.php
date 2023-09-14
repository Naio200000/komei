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

/**
 * Devuelve un array con todos los items que coinsidan con el dato de la categoria ingresada
 * @param string Categoria que quiero buscar dentro de todos los productos
 * @return array Devuelve array con todos los elementos coinsidientes o un array vacio.
 */
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

/**
 * Devuelve el producto dependiendo en un ID especifico
 * @param int ID del producto que desea buscar
 * @return mixed devuelde el array con los datos del producto considiente con la ID o null
 */
function productoID (int $IDproducto):mixed {
	$productos = catalogoCompleto();
	foreach ($productos as $i) {
		if ($i['id'] == $IDproducto) {
			return $i;
		}
	}

	return null;
}

?>
