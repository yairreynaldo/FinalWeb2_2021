<?php
/*Supongo que tenngo implementado el ApiView, y un APIcontroller donde estaria a¡el constructor que luego se extenderia la clase a esta misma
supongo tambien que tengo el model creado con las funciones. */
class clienteAPIController{

    private $clienteModel;

     private $view;



     function __construct(){

        $this->clienteModel = new clienteModel();

        $this->view = new ViewApi();

    }

    public function getTarjetas($params = null){
        id_cliente = $params[":ID"];
        $tarjetas = this->modelcliente->geTtarjetas($id_cliente);
        if($resenas){
            $this->view-> response($tarjetas, 200);
        }
        else{
            $this->view-> response("no hay tarjetas", 404);
        }
    }

}