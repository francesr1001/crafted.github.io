<?php

    $con = mysqli_connect("localhost","root","flow-revised");
    if (mysqli_connect_errorno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errorno();
    }

?>