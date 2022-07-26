<?php
include_once './register.php';
//get csv file
$csv = '../storage/users.csv';
if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $newpassword = $_POST['password'];

    resetPassword($csv, $email, $newpassword);
}

function resetPassword($csv, $email, $newpassword){
    //open file and check if the username exist inside
    //if it does, replace the password
    $auth_email = findEmail($csv, $email);
    if ($auth_email === true) {
        $new_line = $email.','.$newpassword;
        $lines = file($csv);
        $data = str_replace(';','',$lines);
        $counter = count($data);
        for($i=0;$i<$counter; $i++) {
            $t_array = explode(",", $data[$i]);
            if($t_array[2] == $email) { 
                $lines[$i] = $new_line; 
                print_r($lines[$i]);
            }
            $new_data = $new_data . $data[$i];
        } 
        $handle = fopen($csv, 'w');
    //formatter($handle, $delimeter);
    fwrite($handle, $new_data);
    fclose($handle);   
        
    }else {
        echo "error";
    }
    // print_r($lines);

}



