<?php

/**
 * Clase para generar nuestras conexiones a la BD
 */
class Conexion {
    private const DB_HOST = 'localhost';
    private const DB_USER = 'root';
    private const DB_PASS = '';
    private const DB_NAME = 'pii_komei';
    private const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';

    private PDO $db;

    /**
     * Genera una un objeto PDO con los datos de conexion a la bd
     */
    public function __construct() {
        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
        } catch (Exception $e) {
            die('Error al conectar con la Base de datos.');
        }
    }

    /**
     * Devuelve una conexión PDO
     * @return PDO
     */
    public function getConexion(): PDO {
        return $this->db;
    }
}
