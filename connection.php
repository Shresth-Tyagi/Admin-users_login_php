<?php

$servername ="localhost";
$username ="root";
$password = "";
$dbname ="tasks_eoxys";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
  die("connection not successful: " . $conn->connect_error);
} 

else{
    echo "connection successful<br>";
}



?>