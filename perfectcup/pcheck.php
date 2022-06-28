<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// open a new connection to the MySql server
$mysqli = new mysqli('localhost', 'root', '', 'perfectcup');

// Output any connection error
if ($mysqli->connect_error){
    die('Error : (' . $mysqli -> connect_errno . ') ' . $mysqli->connect_error);
}

$query = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($num_row >= 1){
    if (password_verify($password,$row['password'])){
        // session variable
        $_SESSION['login'] = $row['id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        echo 'true';
    }
    else{
        // email varification is already exist or of the password verification is failed in both these situation execution is execute this.error code false.
        echo 'false';
    }
}
else{
    echo 'false';
}



?>
