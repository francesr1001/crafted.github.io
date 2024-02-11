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
             <li class="nav-item active">
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
            <li class="nav-item">
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
                        <h1 class="h3 mb-0 text-gray-800">Transaction History</h1>
                    </div>              
   
        <div class="row"> 
            
            <!-- BALANCE CARDS -->
            <?php include 'transactions-recent.php'; ?>

                <!--input accounts-->
                <div class="col-lg-5 mb-4">

                  
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add a Transaction</h6>
                        </div>

                        <div class="card-body">
                            <form action="transactions-add.php" method="post">


                                <select class="form-control bg-light border-0 small space-form" id="bankacct" name="bankacct" ariplaceholder="Category" required>
                                    <option value="" disabled selected>Select a bank</option>
                                    <?php 
                                        include("dbconn.php");
                                        $userid = $_SESSION['sess_uid'];
                                        $query = "SELECT acc_num, bank_name FROM linked_accounts WHERE u_id = $userid";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            while($optionData=$result->fetch_assoc()){
                                            $option = $optionData['bank_name'];
                                            $id = $optionData['acc_num'];
                                    ?>
                                        <option value="<?php echo $id; ?>" ><?php echo $option; ?></option>
                                    <?php
                                        }}
                                    ?>
                                </select>
                                <input class="form-control bg-light border-0 small space-form" type="text" name="Amount" placeholder="Amount" required>
                                <input class="form-control bg-light border-0 small space-form" type="date" id="Date" name="Date" placeholder="2022-12-12" required>
                                <select class="form-control bg-light border-0 small space-form" id="Category"  name="category" ariplaceholder="Category" required>
                                    <option value="" disabled selected >Select Category</option>
                                    <option value="expense">Expense</option>
                                    <option value="income">Income</option>
                                    <option value="housing">Housing</option>
                                    <option value="transportation">Transportation</option>
                                    <option value="food">Food & Drinks</option>
                                    <option value="leisure">Leisure</option>
                                </select>
                                
                                
                                <input class="btn btn-add " type="submit" value="ADD TRANSACTION">
                            </form>
                            <div>
                                <?php
                                    if (isset($_GET['transadd'])) {
                                        if ($_GET['transadd']==1){
                                            echo "Transaction successully added.";
    
                                        }else{
                                            echo "Failed to add the transaction.";
                                        }
                                    }
                                ?>
                            </div>
                        
                        </div>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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