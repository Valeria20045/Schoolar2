<?php

    include('../../config/database.php');

    $f_name  = $_POST['f_name'];
    $l_name  = $_POST['l_name'];
    $e_mail  = $_POST['e_mail'];
    $passwd =  $_POST['passw' ];

    //$enc_pass = md5($passwd);
    $enc_pass = sha1( $passwd);

    $sql_email_exist = "SELECT COUNT(email) as total  FROM users WHERE email = '$e_mail' LIMIT 1";
    $res = pg_query($conn,$sql_email_exist);

    if($res){
     $row = pg_fetch_assoC($res);
     if($row['total'] > 0){
          echo " Email already exists";
     }else{
          $sql = "INSERT INTO users (firstname, lastname , email, password)
          VALUES('$f_name','$l_name','$e_mail','$enc_pass')
          
     ";
     $res = pg_query($conn,$sql);

     if ($res){
          //echo "User has been created succesfully";
          echo"<script>alert('User has been created . Go to login!')</script>";
          header('Refresh: 0; URL=http://localhost/schoolar2/src/login.php');
     }else{
          echo "Error";
     } 
     }

     }

   

?>
