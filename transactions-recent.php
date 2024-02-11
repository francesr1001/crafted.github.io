<div class="col mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Transactions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Account</th>
                                            <th>Bank</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    
                                        include("dbconn.php");

                                        $userid = $_SESSION['sess_uid'];
                                        
                                        $gettrans = "SELECT a.*, b.bank_name FROM transactions a INNER JOIN linked_accounts b ON a.acc_num = b.acc_num AND a.u_ID = $userid order by transaction_ID desc";
                                        $result = $conn->query($gettrans);
                                        //$user = $result -> fetch_assoc();
                                        

                                        if ($result->num_rows > 0) {

                                            while($usertrans = $result -> fetch_assoc()){
                                                
                                            //  echo " accountid: ". $useracc["account_id"] . "<br>";
                                            //  echo " bankname: ". $useracc["bank_name"] . "<br>";
                                            //  echo " acc num: ". $useracc["acc_num"] . "<br><br>";
                                        ?>



                                            <tr >
                                                <td ><?php echo $usertrans['acc_num'] ?></td>
                                                <td ><?php echo $usertrans['bank_name'] ?></td>
                                                <td ><?php echo $usertrans['type'] ?></td>
                                                <td >
                                                    <?php 
                                                        $tdat = date_create($usertrans['date'])->format('F d, Y');
                                                        echo $tdat;
                                                    ?>
                                                </td>
                                                <td>
                                                    PHP <?php echo number_format($usertrans["amount"],2); ?>
                                                </td>

                                                <td class="delete-form">
                                                    <form action="transactions-delete.php" method="post">
                                                        <input type="hidden" name="transaction_id" value="<?php echo $usertrans['transaction_ID'] ?>">
                                                        <input type="hidden" name="pagefrom" value="<?php echo basename($_SERVER["REQUEST_URI"], ".php") ?>"><br>
                                                        <input class="btn btn-add delete-form" type="submit" name="delete" value="delete">
                                                    </form>
                                                </td>     
                                            </tr>                                   

                                        <?php

                                            }
                                        }  else {
                                            $currentPage = basename($_SERVER["REQUEST_URI"], ".php");
                                        ?> 
                                        
                                            <tr  style="background-color: #ffffff">
                                                <td colspan="6">No transactions have been recorded yet. You may start adding transactions 
                                                <?php if ($currentPage!="transactions"){echo "<a href='transactions.php'>here</a>";}; ?>.
                                                </td>
                                            </tr>  


                                        <?php
                                            }
                                            $conn->close();
                                        ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>