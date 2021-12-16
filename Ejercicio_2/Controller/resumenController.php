<?php
require_once './Model/resumenModel.php';

class resumenController{
    private $resumenModel; 
    private $resumenView;  

    public function __construct(){
        $this->resumenModel = new resumenModel();
        $this->resumenView = new resumenView();
    }

    function getResumen($params=null){
        $id = $params[':ID'];
        $cliente = $this->$resumenModel->getCliente($id);
        if($cliente){
            $saldoActual = $this->$resumenModel->getSaldoActual($id);
            $operaciones = $this->$resumenModel->getOperaciones($id);
            if($operaciones){
                $tarjetas = $this->$resumenModel->getTarjetas($id);
                if($tarjetas){
                    $this->$resumenView->showTabla($cliente,$saldoActual,$operaciones,$tarjetas);//Supongo que en el view tengo una funcion que al pasarle los datos me arma la tabla.
                }
                else{
                    $this->$resumenView->showError("no hay tarjetas asociadas");
                }
            }
            else{
                $this->$resumenView->showError("el cliente no tiene operaciones");
            }
        }
        eles{
            $this->$resumenView->showError("El cliente no exixte");
        }
    }