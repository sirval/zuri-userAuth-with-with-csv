<?php
session_start();
include_once './register.php';
//get csv file
$csv = '../storage/users.csv';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    loginUser($csv, $email, $password);
}

function loginUser($csv, $email, $password){
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */
    $pass = md5($password);
    $auth_email = findEmail($csv, $email);
    $auth_password = findPassword($csv, $pass);

    if ($auth_email === true && $auth_password === true) {
        $_SESSION['email'] = $email;
        echo 'success' ;
    }else {
        echo 'error';
    }

}

