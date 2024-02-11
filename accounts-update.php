<?php
    
    session_start();
    
    include('dbconn.php');

    $userid = $_SESSION['sess_uid'];

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $contact_num = $_REQUEST['contact_num'];
    $bdate = strtotime($_REQUEST["birthday"]);
    $bdate = date('Y-m-d H:i:s', $bdate);

    $sql = "UPDATE user_info SET first_name = '$first_name', last_name = '$last_name', birthdate = '$bdate', email = '$email', contact_num = '$contact_num' WHERE u_ID = $userid";
    
    if ($conn->query($sql) === TRUE) {

        
        $_SESSION['sess_fname'] = $first_name;

        // UPDATE THE NEW USER'S EMAIL AND PASSWORD INTO THE CREDENTIALS TABLE
        $intoCredentialsTbl = "UPDATE credentials SET email = '$email' WHERE u_id =  $userid";
        if ($conn->query($intoCredentialsTbl) === TRUE) {
            
            header("location:accounts-edit.php?updat=1");
        } else {
            
            echo "[ERROR] " . $sql . "<br>" . $conn->error;
        }

    } else {
        
        echo "[ERROR] " . $sql . "<br>" . $conn->error;

    }
    $conn->close();
?>