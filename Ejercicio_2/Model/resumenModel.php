<?php
class clienteModel {
    private $db;
    // CONSTRUCTOR
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=;charset=utf8', 'root', '');
    }


    function getCliente($id){
        $sentencia = $this->db->prepare('SELECT nombre, dni FROM cliente WHERE id = ?');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }


    function getSaldoActual($id_cliente){
        $sentencia = $this->db->prepare('SELECT COUNT(km) as cant_km FROM actividad WHERE id_cliente = ?');
        $sentencia->execute(array($id_cliente));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function getOperaciones($id_cliente){
        $sentencia = $this->db->prepare('SELECT tipo_operacion, km, fecha FROM actividad WHERE id_cliente = ?');
        $sentencia->execute(array($id_cliente));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function getTarjetas($id_cliente){
        $sentencia = $this->db->prepare('SELECT nro_tarjeta, fecha_vencimiento FROM tarjeta WHERE id_cliente = ?');
        $sentencia->execute(array($id_cliente));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

}