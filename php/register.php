<?php
//get csv file
$csv = '../storage/users.csv';

if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    registerUser($csv, $username, $email, $password);
}

function registerUser($csv, $username, $email, $password){
    //validate input
    $email = (filter_var($email, FILTER_VALIDATE_EMAIL));
    if (!$email) { $error = 'Invalid Email'; }
    if ($username == '') { $error = 'Username Field is Empty'; }
    if ($password < 5) { $error = 'Password should be at least 4 characeters'; }
    //check if the file is empty else get the max id and increment
    $id = 1;
    $handle = fopen($csv, 'r');
    while(!feof($handle)) {
        $row = fgetcsv($handle);
        if (!empty($row)) {
            $line[] = str_replace(';','',$row[0]);
        }else {
            $line[]=0;
        }
    }
    $id += max($line); 
    fclose($handle);
    //check if email is alreadey registered
    $result = findEmail($csv, $email);
    
    if($result === false){
        $data = [$id.','.$username.','.$email.','.md5($password)];
        $handle = $handle = fopen($csv, 'a+');
        
        if(fputcsv($handle, $data, ',',';')){
            echo 'success';
        }else {
            echo 'error';
        }
        fclose($handle);
    }else {
        echo 'unique_user';
    }
   
}

//cget all users
function getUsers($csv)
{
   $handle = fopen($csv, 'r');
    while (!feof($handle) ) {
        $users[] = fgetcsv($handle, 1000, ',');
    }
    fclose($handle);
    return $users;
}
//find user email
function findEmail($csv, $email)
{
    $handle = fopen($csv, 'r');
    while(!feof($handle)) {
        $row = fgetcsv($handle);
        if (!empty($row)) {
            $findEmail[] = str_replace(';','',$row[2]);
        }else {
            $findEmail[]=0;
        }
    }
    $user_email = in_array($email, $findEmail, strict:true);
    return $user_email;
}
//find user password
function findPassword($csv, $password)
{
    $handle = fopen($csv, 'r');
    while(!feof($handle)) {
        $row = fgetcsv($handle);
        if (!empty($row)) {
            $findPassword[] = str_replace(';','',$row[3]);
        }else {
            $findPassword[]=0;
        }
    }
    $user_password = in_array($password, $findPassword, strict:true);
    return $user_password;
}
// echo "HANDLE THIS PAGE";


