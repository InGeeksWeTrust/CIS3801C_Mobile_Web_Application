<?php 

//Allow Headers 
header('Access-Control-Allow-Origin: *');

//$servername = "localhost:3306"; 
$servername = "localhost:3306";
$username = "Learner"; 
$password = "Rasmussen"; 
$dbname = "demo";

// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection 
 if ($conn->connect_error) 
     echo "Error: Unexpected connection error. Please retry the operation."; 
 else 
  { 
     $result = $conn->query("SELECT * FROM test");
     if (($result != 0) && ($result->num_rows > 0)) 
       { 
          $row = $result->fetch_assoc();
          $A = $row['A']; 
          $B = $row['B']; 
          $C = $row['C']; 
          $D = $row['D'];
          echo $A; 
          echo $B; 
          echo $C; 
          echo $D; 
       } 
     $conn->close(); 
} 
?>