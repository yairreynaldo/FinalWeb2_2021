<?php
class clienteModel {
    private $db;
    // CONSTRUCTOR
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=;charset=utf8', 'root', '');
    }

    function insertarCliente($id, $nombre, $dni, $telefono, $direccion, $ejecutivo){
        $sentencia = $this->db->prepare('INSERT INTO cliente(id,nombre,dni,telefono,direccion,ejecutivo) VALUES(?,?,?,?,?,?)');
        $sentencia->execute(array($id, $nombre, $dni, $telefono, $direccion, $ejecutivo));
    }

    function getClienteDni($dni){
        $sentencia = $this->db->prepare('SELECT * FROM cliente WHERE dni = ?');
        $sentencia->execute(array($dni));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function agregarKm($id){
        $km = 200;
        $sentencia =  $this->db->prepare("UPDATE actividad SET km=$km WHERE id_cliente=?");
        $sentencia->execute(array($id));
    }

    function getEjecutivo($id){
        $sentencia = $this->db->prepare('SELECT * FROM cliente WHERE id = ? AND ejecutivo = true');
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function asociarTarjeta($id, $id_cliente){
        $sentencia =  $this->db->prepare("UPDATE tarjeta SET id_cliente=$id_cliente WHERE id=?");
        $sentencia->execute(array($id, $id_cliente));
    }

}