<?php

    






    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = date('')
    $contact_num = $_POST['contact_num'];

   //Connection to Database
   
   $conn = new mysqli('localhost','root','','','futureflow_sql');
   if($conn ->connect_error){
    die('Connection Failed : '$conn->connect_error);
   }else{
    $smt = $conn->prepare("inserting into databse
    (first_name, last_name, email, password, birthdate, contact_num)
    values(?, ? ,?, ?, ?, ?)
    ");
   }
?>