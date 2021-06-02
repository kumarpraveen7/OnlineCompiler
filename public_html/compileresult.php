<?php
include 'backc.php';
$tokenout = $_SESSION['token'];
// print $tokenout;
$url = "https://api.judge0.com/submissions/".$tokenout."?base64_encoded=false&fields=stdout,stderr,status_id,language_id,status";
// print $url;
$opt2 = array('http'=> array('method' => 'GET',
                            'header' => 'Content-type: application/json'
                      ));
$context2 = stream_context_create($opt2);
$result2 = file_get_contents($url,false, $context2);
// print $result2;
// $status = json_decode($result2["status"],true);
$result2 = json_decode($result2, true);
// print $status;
  if($result2["status_id"] == 3) {
    print $result2["stdout"];
  } else{
    while($result2["status_id"] == 2 || $result2["status_id"] == 1) {
      sleep(0.5);
      // print "inside while ";
      $result2 = file_get_contents($url,false, $context2);
      $result2 = json_decode($result2, true);
    }
    if($result2["status_id"] == 3) {
      print $result2["stdout"];
    } else {
      print(" \n ".$result2["status"]["description"]." \n" );
      // $status = json_decode($result2["status"], true);
      // print((string)json_decode($result2["status"],true));
      // print $status;
    }
  }
// print $result2["stdout"];
 ?>
