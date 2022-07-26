<?php
session_start();
if (isset($_GET['session'])) {
    logout();
}

function logout(){
    /*
Check if the existing user has a session
if it does
destroy the session and redirect to login page
*/

    $session = $_SESSION['email'];
    if ($session) {
        session_destroy();
        unset($session);
        header('location: ../forms/login.html');  
    }else {
        header('location: ../index.php'); 
    }

}
