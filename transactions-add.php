<?php
    
    session_start();
    
    include('dbconn.php');

    $acc_num = $_REQUEST['bankacct'];
    $transamnt = $_REQUEST['Amount'];
    $transtype = $_REQUEST['category'];
    $transwhen = strtotime($_REQUEST["Date"]);
    $transwhen = date('Y-m-d H:i:s', $transwhen);

    $userid = $_SESSION['sess_uid'];
    //$now = date("Y-m-d H:i:s");
    
    
    $sql = "INSERT INTO transactions (u_ID, amount, date, type, acc_num) VALUES ($userid,$transamnt,'$transwhen','$transtype',$acc_num)";
    
    if ($conn->query($sql) === TRUE) {

        // GET THE NEW AUTO INCREMENTED TRANSACTION
        $resultGetLTID = $conn->query("SELECT MAX(transaction_ID) AS newTID FROM transactions WHERE u_ID = $userid");
        $rowLTID = $resultGetLTID -> fetch_assoc();
        $newtid = $rowLTID["newTID"];

        // GET THE CURRENT BALANCE FROM linked_accounts THAT HAS $acc_num
        $resultGetBalance = $conn->query("SELECT balance FROM linked_accounts WHERE u_id = $userid AND acc_num = $acc_num");
        $rowB = $resultGetBalance -> fetch_assoc();
        $currbalance = $rowB["balance"];

        // SUBTRACT OR ADD THE TRANSACTION AMOUNT FROM/TO CURRBALANCE
        if($transtype=="income"){
            $newbalance = $currbalance + $transamnt;
        }else{
            $newbalance = $currbalance - $transamnt;
        }

        // INSERT NEW TRANSACTION AND BALANCE IN USER_DATA
        $sql2 = "INSERT INTO user_data (u_ID, transaction_id, balance, account_ID) VALUES ($userid,$newtid,$newbalance,$acc_num)";
        if ($conn->query($sql2) === TRUE) {
        }else{
            echo "[ERROR] " . $sql2 . "<br>" . $conn->error;
        }


        // UPDATE LINKED_ACCOUNTS WITH NEW BALANCE
        $sql3 = "UPDATE linked_accounts SET balance = $newbalance WHERE u_id = $userid AND acc_num = $acc_num";
        if ($conn->query($sql3) === TRUE) {
        }else{
            echo "[ERROR] " . $sql3 . "<br>" . $conn->error;
        }

        header("location:transactions.php?transadd=1");

    } else {
        
        echo "[ERROR] " . $sql . "<br>" . $conn->error;
       
        

    }
    $conn->close();
?>