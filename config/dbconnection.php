<?php
 # connect to the database
 $con = mysqli_connect("localhost","root","","pizza_data");
 if(!$con)
 {
     echo "error". mysqli_connect_error();
 }

?>