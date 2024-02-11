<div class="row">

<?php
    
    include('dbconn.php');

    
    $userid = $_SESSION['sess_uid'];
    
    $getaccounts = "SELECT * FROM linked_accounts WHERE u_id = $userid";
    $result = $conn->query($getaccounts);
    //$user = $result -> fetch_assoc();
    

    if ($result->num_rows > 0) {

        while($useracc = $result -> fetch_assoc()){
            
          //  echo " accountid: ". $useracc["account_id"] . "<br>";
          //  echo " bankname: ". $useracc["bank_name"] . "<br>";
          //  echo " acc num: ". $useracc["acc_num"] . "<br><br>";
?>
            
        <!-- CARDS ITSELF -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success text-uppercase mb-2">
                            <?php echo $useracc["bank_name"]; ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">PHP
                            <?php echo number_format($useracc["balance"],2); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
        }
    } else {
?>

 <!-- CARDS ITSELF -->
 <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success text-uppercase mb-2">
                            NOTICE</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                You have no bank accounts registered yet. Please add an account
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<?php
    }
    $conn->close();
    ?>
</div>