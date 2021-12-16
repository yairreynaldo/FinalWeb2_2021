<?php 

class AutenticacionController {

    function checkLoggedIn(){
        session_start();
            if (!isset($_SESSION['user'])) {
                return false;
            }else{
                return true;
            }
    } 

    public function isAdmin(){
        //pregunta si la sesion esta habilitada y si existe
        if (session_status() != PHP_SESSION_ACTIVE)
        session_start();
        if (isset($_SESSION['admin'])) {
            return $_SESSION['admin']==1;
            return true;
        }else{
            return false;
        }
}
?>