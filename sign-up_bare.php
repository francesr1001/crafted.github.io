<?php
    
    include('dbconn.php');

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $contact_num = $_REQUEST['contact_num'];

    $bdate = strtotime($_REQUEST["birthdate"]);
    $bdate = date('Y-m-d H:i:s', $bdate);

    $sql = "INSERT INTO user_info (first_name, last_name, birthdate, email, password, contact_num) VALUES ('$first_name', '$last_name', '$bdate', '$email','$password','$contact_num')";
    
    if ($conn->query($sql) === TRUE) {

        // GET THE NEW AUTO INCREMENTED U_ID AND INSERT INTO CREDENTIALS WITH EMAIL AND PASSWORD
        $resultGetLUID = $conn->query("SELECT MAX(u_ID) AS newUID FROM user_info");
        $rowLUID = $resultGetLUID -> fetch_assoc();
        $newuid = $rowLUID["newUID"];
        
        // INSERT THE NEW USER'S EMAIL AND PASSWORD INTO THE CREDENTIALS TABLE
        $intoCredentialsTbl = "INSERT INTO credentials (u_id, email, password) VALUES ($newuid, '$email','$password')";
        if ($conn->query($intoCredentialsTbl) === TRUE) {
            echo "data stored in a database successfully with uid: ". $newuid;
        } else {
            echo "[ERROR] " . $sql . "<br>" . $conn->error;
        }

    } else {
        
        echo "[ERROR] " . $sql . "<br>" . $conn->error;

    }
    $conn->close();
?>