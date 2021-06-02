<?php
session_start();
header("location: ../myprofile.php");

require_once "config.php";

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$presentUser = $_SESSION["username"];

$checkPresentUser = "SELECT * from users WHERE username='".$presentUser."'";
$checkUser = "SELECT * from users WHERE username='".$username."'";

if($presentUser == $username) {
    $result = $link->query($checkPresentUser);
    if($result->num_rows == 1) {
        $update = "UPDATE users SET email='".$email."' WHERE username='".$presentUser."'";
        $result = $link->query($update);
        echo $update;
    }
} else {
    $result = $link->query($checkUser);
    if($result->num_rows < 1){
        $update = "UPDATE users SET email='".$email."', username='".$username."' WHERE username='".$presentUser."'";
        $result = $link->query($update);
        $update2 = "UPDATE files SET username='".$username."' WHERE username='".$presentUser."'";
        $result2 = $link->query($update2);
        
        $_SESSION["username"] = $username;
        
    }
} 


if($password != "PAssword"){
    if($password == $confirm_password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE users SET password='".$hashedPassword."' WHERE username='".$presentUser."'";
        $result = $link->query($update);
        echo $update;        
    }
}

// $result = $link->query($query);
// $row = $result->fetch_assoc();
                            

?>