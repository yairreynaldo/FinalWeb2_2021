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

}
?>