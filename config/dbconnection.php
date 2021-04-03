<?php
 # connect to the database
 $con = mysqli_connect("localhost","joessir","0666482312","pizza_data");
 if(!$con)
 {
     echo "error". mysqli_connect_error();
 }

?>