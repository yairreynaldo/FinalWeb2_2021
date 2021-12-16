<?php
require_once './Model/clienteModel.php';
require_once './controller/autenticationControllerModel.php';

class clienteController{
    private $clienteModel; 
    private $loggeado;
    private $clienteView;  

    public function __construct(){
        $this->clienteModel = new clienteModel();
        $autentication = new AutenticacionController();
        $this->loggeado = $autentication->checkLoggedIn();
        $this->admin = $autentication->isAdmin();
        $this->clienteView = new clienteView();
    }

    function insertarCliente($params=null){

        if($this->$loggeado && $this->$admin){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $ejecutivo = $_POST['ejecutivo'];
            if(!empty($id) && !empty($nombre) && !empty($dni) && !empty($telefono) && !empty($direccion) && !empty($ejecutivo)){
                $exsisteCliente = $this->$clienteModel->getClienteDni($dni);
                if($exsisteCliente){
                    $error = "ya existe un cliente con este dni";
                    $this->$clienteView->ShowError($error);
                }
                else{
                    $this->$clienteModel->insertarCliente($id, $nombre, $dni, $telefono, $direccion, $ejecutivo);
                    $this->$clienteModel->agregarKM($id);
                    $existeEjecutivo = $this->$clienteModel->getEjecutivo($id);
                    if($existeEjecutivo){
                        $tarjeta = $this->$cardHelprer->getBussinesCard();
                        $this->$clienteModel->asociarTarjeta($tarjeta->id, $id);
                    }
                }
            }
            else{
                $error = "faltan completar campos"
                $this->$clienteView->ShowError($error);
            }
        }
        else{
            $error = "no se logeo el usuario"
            $this->$clienteView->ShowError($error);
        }
    }