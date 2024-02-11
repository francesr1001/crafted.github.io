<?php
    
    session_start();
    
    include('dbconn.php');

    $acc_num = $_REQUEST['Acc_num'];
    $bank_name = $_REQUEST['Bank_name'];
    $userid = $_SESSION['sess_uid'];
    $pagefrom = $_REQUEST['pagefrom'];
    
    $sql = "INSERT INTO linked_accounts (bank_name, acc_num, u_id) VALUES ('$bank_name', $acc_num, $userid)";
    
    if ($conn->query($sql) === TRUE) {

        header("location:".$pagefrom.".php?accadd=1");

    } else {
        
        //header("location:".$pagefrom.".php?accadd=0");
        echo "[ERROR] " . $sql . "<br>" . $conn->error;

    }
    $conn->close();
?>