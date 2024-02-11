<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="img/flow-white.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Future Flow | Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

     <!--FLOW STYLES-->
     <link href="css/flow-style.css" rel="stylesheet">

</head>

<body class="body-landing">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
        
                  <div class="phpcontainer">
                  
                    <?php
                        error_reporting(E_ERROR | E_PARSE);
                        include('dbconn.php');

                        $first_name = $_REQUEST['first_name'];
                        $last_name = $_REQUEST['last_name'];
                        $email = $_REQUEST['email'];
                        $password = $_REQUEST['password'];
                        $contact_num = $_REQUEST['contact_num'];

                        $bdate = strtotime($_REQUEST["birthdate"]);
                        $bdate = date('Y-m-d H:i:s', $bdate);

                        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                            echo"[ERROR] EMAIL FORMAT NOT ELLIGIBLE, TRY AGAIN
                                 <form><button formaction='register.html' class='btn btn-primary btn-user btn-block' value='Sign Up'>Sign Up </button></form>";  


                        }else{
                            $sql = "INSERT INTO user_info (first_name, last_name, birthdate, email, contact_num) VALUES ('$first_name', '$last_name', '$bdate', '$email', '$contact_num')";
                            if ($conn->query($sql) === TRUE) {
                                
                               

                            // GET THE NEW AUTO INCREMENTED U_ID AND INSERT INTO CREDENTIALS WITH EMAIL AND PASSWORD
                            $resultGetLUID = $conn->query("SELECT MAX(u_ID) AS newUID FROM user_info");
                            $rowLUID = $resultGetLUID -> fetch_assoc();
                            $newuid = $rowLUID["newUID"];
                            
                            // INSERT THE NEW USER'S EMAIL AND PASSWORD INTO THE CREDENTIALS TABLE
                            $intoCredentialsTbl = "INSERT INTO credentials (u_id, email, password) VALUES ($newuid, '$email','$password')";
                            if ($conn->query($intoCredentialsTbl) === TRUE) {
                                                        
                                echo "<h5>CONGRATULATIONS! ".$first_name." ".$last_name."</h5><br>";
                                echo "<h5>You are now registered.</h5><b";
                                echo "<p>Start tracking your financial journey with Flow</p><br>";
                                echo "
                                        <form><button formaction='Index.html' class='btn btn-primary btn-user btn-block' value='log in'>Log in </button></form>";
                                

                            } else {
                                echo "[ERROR] here is the problem" . $sql . "<br>" . $conn->error;
                            }
                        } else {
                            echo "[ERROR] Account with that email or number is already registered";
                        }
                        $conn->close();
                        }

                    ?>
                </div>
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

</body>

</html>