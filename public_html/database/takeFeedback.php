<?php
session_start();
header("location: ../feedback.php");

require_once "config.php";

$presentUser = $_SESSION["username"];

$topic = $_POST["topic"];
$feedback = $_POST["txt"];

$nouserSql = "INSERT INTO feedback (topic , feedbacktext, username) VALUES ('".$topic."', '".$feedback."', 'anonymous')";
$userSql = "INSERT INTO feedback (topic , feedbacktext, username) VALUES ('".$topic."', '".$feedback."', '".$presentUser."')";

if(isset($_POST["anonym"])) {
    $user = $_POST["anonym"];
    $link->query($nouserSql);
    // echo $nouserSql;
} else {
    // echo $userSql;
    $link->query($userSql);
}

?>


