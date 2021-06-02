<?php
  session_start();
  require_once "config.php";
  echo "here";
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      $filename = $_POST["filename"];
      $code = $_POST["code"];
      $username = $_SESSION["username"];
      $compilerId = $_POST["compilerId"];
      
    switch($compilerId) {
        case '0':$language="c";
                 break;
        case '1':$language="cpp";
                 break;
        case '2':$language="java";
                 break;
        case '3':$language="python";
                 break;
    }
      
      
      echo "hi\n";
      echo $filename;
      echo $code;
      echo $username;
      echo $language;

      $sql = "INSERT INTO files (Name, Content, language, username) VALUES ('".$filename."','".$code."','".$language."','".$username."')";
      
      echo $sql;
      
      $isSame = "SELECT * FROM files WHERE Name=".$filename;
      
      
      if($link->query($isSame)) {
          echo "hmmmm";
      } else {
          if ($link->query($sql) === TRUE) {
        // //     //header("../myfiles.html");
            // echo "true";
          }
      }


  }
?>
