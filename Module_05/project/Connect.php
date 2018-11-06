<?php

$name = $_POST['name'];
$petType = $_POST['petType'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phoneCode'];
$phone = $_POST['phone'];

if (!empty($name) || !empty($petType) || !empty($gender) || !empty($email) || !empty($phoneCode) || !empty($phone))
{
    $servername = "localhost:3306";
    $username = "TestUser";
    $password = "User123";
    $dbname = "petsrus";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if (mysqli_connect_error())
    {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email FROM appointment WHERE email = ? LIMIT 1";
     $INSERT = "INSERT INTO appointment (name, petType, gender, email, phoneCode, phone) VALUES(?, ?, ?, ?, ?, ?)";

     //Prepare statement
     $stmt = $conn-> prepare($SELECT);
     $stmt-> bind_param("s", $email);
     $stmt-> execute();
     $stmt-> bind_result($email);
     $stmt-> store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0)
     {
      $stmt-> close();
      $stmt = $conn-> prepare($INSERT);
      $stmt-> bind_param("ssssii", $name, $petType, $gender, $email, $phoneCode, $phone);
      $stmt-> execute();
      echo "Your appointment has been scheduled sucessfully.";
     }
     else
     {
      echo "There's already an appointment scheduled under this email.";
     }
     $stmt-> close();
     $conn-> close();
    }
}
else
{
 echo "All fields are required";
 die();
}
?>
