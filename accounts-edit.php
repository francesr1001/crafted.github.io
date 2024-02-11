<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Future Flow | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    <!--CSS FROM FLOW-->
    <link href="css/flow-style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css"/>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <img class="icon" src="img/flow-white.png">
                <div class="sidebar-brand-text icon-text">Future Flow</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


             <!-- Nav Item - Transaction History -->
             <li class="nav-item">
                <a class="nav-link" href="transactions.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Transaction History</span></a>
            </li>

            <!-- Nav Item - Statistcs -->
            <li class="nav-item">
                <a class="nav-link" href="statistics.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Statistics</span></a>
            </li>

           
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                SETTINGS
            </div>
            
            <!-- Nav Item - Accounts -->
            <li class="nav-item active">
                <a class="nav-link" href="accounts.php">
                    <i class="bi bi-person-circle"></i>
                    <span>Account </span></a>
            </li>
   
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <!--sidebar button-->
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                <!--theme-->
                <button class="rounded-circle border-0 button-bg">
                    <i class="bi bi-brightness-high"></i>
                </button>
            
            </div>
        </ul>
<!-- End of Sidebar -->


<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

        <!-- Topbar -->
        <?php include 'header-date-user.php';?>
        <!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

        <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">My Account</h1>
                    </div>

        
                <!--input accounts-->
                <div class="col-lg-5 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">EDIT MY ACCOUNT</h6>
                        </div>

                        <div class="card-body">
                            <form action="accounts-update.php" method="post">
                                
                                <?php 
                                    include('dbconn.php');
                                    $userid = $_SESSION['sess_uid'];
                                    // GET USER INFORMATION
                                    $resultGetUser = $conn->query("SELECT * FROM user_info WHERE u_id = $userid");
                                    $tu = $resultGetUser -> fetch_assoc();
                                    //$currbalance = $tu["balance"];
                                ?>

                                <table class="acc-table">
                                    <tr>
                                        <td class="acc-head"> first name</td>
                                        <td><input type="text" name="first_name" class="form-control bg-light border-0 small" value="<?php echo $tu["first_name"];?>" required></td>
                                    </tr>
                                    <tr>
                                        <td class="acc-head">last name</td>
                                        <td><input type="text" name="last_name" class="form-control bg-light border-0 small" value="<?php echo $tu["last_name"];?>" required></td>
                                    </tr>
                                    <tr>
                                        <td class="acc-head">birthdate</td>
                                        <td><input type=date min=1923-01-01 max=2009-12-31 name="birthday" class="form-control form-control-user"
                                    id="birthdate"  required placeholder="birthdate" value="<?php echo $tu["birthdate"];?>" required></td>
                                    </tr>
                                    <tr>
                                        <td class="acc-head"> email address</td>
                                        <td> <input type="email" name="email" placeholder="Loremipsum@dolorsita.met" class="form-control bg-light border-0 small" value="<?php echo $tu["email"];?>" required></td>
                                    </tr>
                                    <tr>
                                        <td class="acc-head">phone number</td>
                                        <td><input type="tel" pattern="[0]{1}[9]{1}[0-9]{9}" placeholder="Contact Number"  class="form-control form-control-user"
                                           id="contact_num" name="contact_num" required value=" <?php echo $tu["contact_num"];?>" ></td>
                                    </tr>
                                   
                
                                </table>
                    
                                    <!--button-->
                                    <input type="submit" value="SAVE CHANGES" class="btn btn-add">
                                    <?php
                                        $conn->close();
                                    ?>
                                    
                    
                            </form> 
                            <?php
                            if (isset($_GET['updat'])) {
                                if ($_GET['updat']==1){
                                    echo "Account successully Edited.";

                                }else{
                                    echo "Failed to edit the account.";
                                }
                            }
                        ?>
                        
                        </div>
                        

    

                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">MY BANK ACCOUNTS</h6>
                        </div>

                        <div class="card-body">
                            <table class="transaction">

                            <?php
                                if (isset($_GET['updat'])) {
                                    if ($_GET['updat']==1){
                                        echo "Account successully Edited.";

                                    }else{
                                        echo "Failed to edit the account.";
                                    }
                                }
                            ?>
                                <thead class="transc-head">
                                    <tr>
                                        <td>ACCOUNT NUMBER</td>
                                        <td>BANK NAME</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody class="bg-light border-0">

                                <?php
    
                    include("dbconn.php");
                    
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
                
                    
                        <tr class="data-row">
                            <td class="td-desc"><?php echo $useracc["acc_num"]?></td>
                            <td class="td-highlight"><?php echo $useracc["bank_name"]?></td>

                            <td class="transc-delete">
                                <form action="accounts-delete.php" method="post">
                                    <input type="hidden" name="acc2del" value="<?php echo $useracc["account_id"]?>">
                                    <input class="btn btn-add" type="submit" name="delete" value="delete">
                                </form>
                            </td>     

                        </tr>
                                <?php

                                        }
                                    } else {
                                ?>
                                        <tr class="data-row">
                                            <td class="td-desc">-na-</td>
                                            <td class="td-highlight">-na-</td>

                                            <td class="transc-delete">
                                                
                                            </td>     

                                        </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </table>
                        
                        </div>
                    </div>

                </div>

           

                

          

</div>
<!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Future Flow 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="Index.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>