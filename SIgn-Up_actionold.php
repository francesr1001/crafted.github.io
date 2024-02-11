<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="flow-white.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--STYLESHEET-->
    <link rel="stylesheet" href="css/landing-style.css">
    <link rel="stylesheet" href="css/SIgn-Up.css">

    <title>Flow Finance</title>

</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
     crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
    crossorigin="anonymous"></script>

<!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand logo" href="#">F</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a class="nav-link" href="Index.html">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Features.html">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="About-us.html">About Us</a>
            </li>

          </ul>
        </div>
      </nav>

    <!--CONTENT-->
    <div class="sign-up-all">
        <div class="Sign-up-container">
            <div class="Sign-up-content">

            <?php
    
                include('dbconn.php');

                $first_name = $_REQUEST['first_name'];
                $last_name = $_REQUEST['last_name'];
                $email = $_REQUEST['email'];
                $password = $_REQUEST['password'];
                $contact_num = $_REQUEST['contact_num'];

                $bdate = strtotime($_REQUEST["birthdate"]);
                $bdate = date('Y-m-d H:i:s', $bdate);

                $sql = "INSERT INTO user_info (first_name, last_name, birthdate, email, contact_num) VALUES ('$first_name', '$last_name', '$bdate', '$email', '$contact_num')";
                
                if ($conn->query($sql) === TRUE) {

                    // GET THE NEW AUTO INCREMENTED U_ID AND INSERT INTO CREDENTIALS WITH EMAIL AND PASSWORD
                    $resultGetLUID = $conn->query("SELECT MAX(u_ID) AS newUID FROM user_info");
                    $rowLUID = $resultGetLUID -> fetch_assoc();
                    $newuid = $rowLUID["newUID"];
                    
                    // INSERT THE NEW USER'S EMAIL AND PASSWORD INTO THE CREDENTIALS TABLE
                    $intoCredentialsTbl = "INSERT INTO credentials (u_id, email, password) VALUES ($newuid, '$email','$password')";
                    if ($conn->query($intoCredentialsTbl) === TRUE) {
                                                
                        echo "<h5>CONGRATULATIONS! ".$first_name." ".$last_name."</h5><br><br>";
                        echo "<h5>You are now registered.</h5><br>";
                        echo "<p>Start tracking your financial journey with Flow</p><br><br><br>";
                        echo "<form><button formaction='log-in.html' class='add-button outlined' value='log in'>log in </button></form>";

                    } else {
                        echo "[ERROR] " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "[ERROR] Account with that email or number is already registered";
                }
                $conn->close();
            ?>



                
                    
                
            </div>
    

        </div>
    </div>
    </body>
    </html>