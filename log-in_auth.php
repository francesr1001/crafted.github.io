<?php
    
    session_start ();

    include('dbconn.php');

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    
    $finduser = "SELECT b.* FROM credentials a INNER JOIN user_info b ON a.u_id = b.u_ID AND (a.email = '$email' AND a.password = '$password')";
    $result = $conn->query($finduser);
    //$user = $result -> fetch_assoc();
    
    
    
    if ($result->num_rows > 0) {

        $theuser = $result -> fetch_assoc();
        echo " userid: ". $theuser["u_ID"] . "<br>";
        echo " first name: ". $theuser["first_name"];

        $_SESSION["sess_uid"] = $theuser["u_ID"];
        $_SESSION["sess_fname"] = $theuser["first_name"];

        header("location:home.php");

    } else {
        
        header("location:log-in.html");

    }
    $conn->close();
?>