<?php
require_once './Model/transferenciaModel.php';
require_once './controller/autenticationControllerModel.php';

class transferenciaController{
    private $transferenciaModel; 
    private $loggeado;
    private $transferenciaView;  

    public function __construct(){
        $this->transferenciaModel = new transferenciaModel();
        $autentication = new AutenticacionController();
        $this->loggeado = $autentication->checkLoggedIn();
        $this->transferenciaView = new transferenciaView();
    }

    function transferirDni($params=null){

        if($this->$loggeado && $this->$admin){
            $dni = $_POST['dni'];
            $transferencia = $_POST['km'];
            if(!empty($dni) && !empty($transferencia)){
                $exsisteCliente = $this->$clienteModel->getClienteDni($dni);//reutilizo esta funcion del ejercicio 1.
                if($exsisteCliente){
                    $id = $this->$transferenciaModel->getIdDni($dni);
                    $tieneFondos = $this->$transferenciaModel->tieneFondos($id, $transferencia);
                    if($tieneFondos){
                        $this->$transferenciaModel->transferencia($id, $transferencia);
                    }
                    else{
                        $error = "no tiene fondos suficientes"
                        $this->$transferenciaView->ShowError($error);
                    }
                }
                else{
                    $error = "no existe el cliente"
                    $this->$transferenciaView->ShowError($error);
                }
                }
            else{
                $error = "faltan completar campos"
                $this->$transferenciaView->ShowError($error);
            }
        }
        else{
            $error = "no se logeo el usuario"
            $this->$transferenciaView->ShowError($error);
        }
    }