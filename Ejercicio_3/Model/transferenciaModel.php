<?php
class transferenciaModel {
    private $db;
    // CONSTRUCTOR
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=;charset=utf8', 'root', '');
    }


    function tieneFondos($id, $transferencia){
        $sentencia = $this->db->prepare('SELECT * FROM cliente WHERE id_cliente = ? AND km >= $transferencia');
        $sentencia->execute(array($id, $transferencia));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function getIdDni($dni){
        $sentencia = $this->db->prepare('SELECT id FROM cliente WHERE dni = ?');
        $sentencia->execute(array($dni));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    function transferencia($id, $transferencia){
        $sentencia =  $this->db->prepare("UPDATE actividad SET km=$transferencia WHERE id_cliente=?");
        $sentencia->execute(array($id, $transferencia));
    }

}