<?php

  $code=$_POST["code"];
  $codeInput = $_POST["codeInput"];

  $compilerId = $_POST["compilerId"];
  // print("compid = ".$compilerId);
  switch($compilerId) {
    case '0':$filename_code="main.c";
             $languageId = 4;
             break;
    case '1':$filename_code="main.cpp";
             $languageId = 10;
             break;
    case '2':$filename_code="Main.java";
             $languageId = 26;
             break;
    case '3':$filename_code="main.py";
             $languageId = 34;
             break;
      // $filename_code="main.c";
  }

  $file_code=fopen($filename_code,"w+");
  fwrite($file_code,$code);
  fclose($file_code);

  $file_code=fopen($filename_code,"r");
  $codec = fread($file_code,filesize($filename_code));
  // print($codec);


  $data = array(
  "source_code" => $codec,
  "language_id"=> $languageId,
//   "stdin"=> "world"
  "stdin"=>$codeInput
  );

  $opt = array('http'=> array('method' => 'POST',
                              'header' => 'Content-type: application/json',
                              'content' => json_encode($data)
                        ));
  $context = stream_context_create($opt);
  $result = file_get_contents('https://api.judge0.com/submissions/?base64_encoded=false&wait=false',false, $context);
  // print $result;
  $a = json_decode($result, true);
  // print $a["token"];
  sleep(2);
  $token = (string)$a["token"];
  $_SESSION['token'] = $token;

  // print $token;
  // $url = "https://api.judge0.com/submissions/".$token."?base64_encoded=false&fields=stdout,stderr,status_id,language_id";
  // print $url."abc";
  // $opt2 = array('http'=> array('method' => 'GET',
  //                             'header' => 'Content-type: application/json'
  //                       ));
  // $context2 = stream_context_create($opt2);
  // $result2 = file_get_contents($url,false, $context2);

  // $result2 = file_get_contents('https://api.judge0.com/submissions/57569132-0677-4d2e-8266-906ecc3fe282?base64_encoded=false&fields=stdout,stderr,status_id,language_id',false, $context2);
  // print $result2;

?>
