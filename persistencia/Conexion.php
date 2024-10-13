<?php

class Conexion {
    private $mysqlConexion;
    private $resultado;

    public function abrirConexion() {
        $this->mysqlConexion = new mysqli("localhost", "root", "", "mydb");

        // Verificar si hay errores de conexión
        if ($this->mysqlConexion->connect_error) {
            die("Error de conexión: " . $this->mysqlConexion->connect_error);
        }
    }

    public function ejecutarConsulta($sentenciaSQL) {
        // Ejecutar la consulta y manejar posibles errores
        $this->resultado = $this->mysqlConexion->query($sentenciaSQL);
        
        if (!$this->resultado) {
            die("Error en la consulta: " . $this->mysqlConexion->error . " | Consulta: " . $sentenciaSQL);
        }
    }

    public function siguienteRegistro() {
        // Devuelve el siguiente registro, o null si no hay más registros
        return $this->resultado ? $this->resultado->fetch_row() : null;
    }

    public function obtenerLlaveAutonumerica() {
        return $this->mysqlConexion->insert_id;
    }

    public function cerrarConexion() {
        $this->mysqlConexion->close();
    }

    public function numeroFilas() {
        return $this->resultado ? $this->resultado->num_rows : 0;
    }
}
?>
