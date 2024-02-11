<?php
    
    session_start();
    
    include('dbconn.php');

    
    
    $transid = $_REQUEST['transaction_id'];
    $pagefrom = $_REQUEST['pagefrom'];
    
    $userid = $_SESSION['sess_uid'];
    //$now = date("Y-m-d H:i:s");
    
    
    $sql = "SELECT * FROM transactions WHERE transaction_ID = $transid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($transdets = $result -> fetch_assoc()){
            
            $transaccnum = $transdets["acc_num"];
            
            // GET THE CURRENT BALANCE FROM LINKED_ACCOUNT THAT HAS $acc_num
            $resultGetBalance = $conn->query("SELECT balance FROM linked_accounts WHERE u_ID = $userid AND acc_num = $transaccnum");
            $rowB = $resultGetBalance -> fetch_assoc();
            $currbalance = $rowB["balance"];

            // SUBTRACT OR ADD THE TRANSACTION AMOUNT FROM/TO CURRBALANCE
            if($transdets["type"]!="income"){
                $newbalance = $currbalance + $transdets["amount"];
            }else{
                $newbalance = $currbalance - $transdets["amount"];
            }

            // UPDATE LINKED_ACCOUNTS WITH NEW BALANCE
            $sql3 = "UPDATE linked_accounts SET balance = $newbalance WHERE u_id = $userid AND acc_num = $transaccnum";
            if ($conn->query($sql3) === TRUE) {
            }else{
                echo "[ERROR] " . $sql3 . "<br>" . $conn->error;
            }

            // NOW DELETE THE TRANSACTION
            $sql = "DELETE FROM transactions WHERE transaction_ID = $transid";
            if ($conn->query($sql) === TRUE) {

                header("location:".$pagefrom.".php?delsucc=1");

            } else {
                
                echo "[ERROR] " . $sql . "<br>" . $conn->error;

            }
        }
    }

    $conn->close();
?>