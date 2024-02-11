<?php
    
    session_start();

    include('dbconn.php');

    $acc2del = $_REQUEST['acc2del'];
    $userid = $_SESSION['sess_uid'];
    
    
    $sql = "DELETE FROM linked_accounts WHERE account_id = $acc2del";
    
    if ($conn->query($sql) === TRUE) {

        header("location:accounts-edit.php?delsucc=1");

    } else {
        
        header("location:accounts-edit.php?delsucc=0");

    }
    $conn->close();
?>