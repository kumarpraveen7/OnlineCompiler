<?php
    session_start();
?>
<!--language in php, Untitled name in input html ,and compilerId in input html are hardcoded -->
<?php 
        
        require_once "database/config.php";
        
        $foundCode ="";
        $foundFileName = "";
        $language = "c";
        
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ 
        
            $query = "SELECT * FROM files WHERE username='".$_SESSION["username"]."' AND language='".$language."'";
            if(isset($_GET["id"])){
                $getId = $_GET["id"];
                $result = $link->query($query);
                
                if ($result->num_rows > 0) {
                // output data of each row
                    $id=0;
                    while($row = $result->fetch_assoc()) {
                        if($getId == $id) {
                            // echo "Content = ".$row["Content"];
                            $foundCode = $row["Content"];
                            $foundFileName = $row["Name"];
                            break;
                        }
                        $id++;
                    }
                } else {
                    // echo "0 results";
                }
                
            } else {
                $foundCode="";
                $foundFileName = "";
            }
        }
        
        // $result = mysqli_query($link, $query);
        // echo $result;
    ?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style type="text/css">
      /* textarea{
        background-color: black;
        color: white;
        resize: none;
      } */
      .compilerId {
        display: none;
      }
      .popup-form{
        display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
        z-index: 20; /* Sit on top */
        left: 400px;
        top: 200px;
        width: 40%; /* Full width */
        height: 40%; /* Full height */
      }
      textarea{
        background-color: black;
        font-size: 18px;
        font-family: consolas;
        color: white;
        resize: none;
        height: 80%;
        width: 1000px
      }
      h1{
        color: white;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="css/compiler.css">

    <script src="js/modernizr-2.8.3.min.js"></script>
    <script src="js/jquery-1.12.0.min.js"></script>

  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



    <header>
  	<nav class="navbar navbar-expand-sm navbar-dark bg-success fixed-top" style="opacity: 0.9;">
      	<a href=""></a>
      <ul class="nav navbar-nav navbar-left">
        <li class="nav-item active">
          <a class="nav-link" href="./index.php">Home</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Languages
          </a>
          <div class="dropdown-menu bg-success">
            <a class="dropdown-item" href="ccompiler.php">C</a>
            <a class="dropdown-item" href="cppcompiler.php">C++</a>
            <a class="dropdown-item" href="javacompiler.php">Java</a>
            <a class="dropdown-item" href="pythoncompiler.php">Python</a>
          </div>
        </li>


        <li class="nav-item active">
          <a class="nav-link" href="./feedback.php">Feedback</a>
        </li>
      </ul>


      
      <ul class="navbar-nav ml-auto mx-4">

        <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ 
        ?>  
            <li class="nav-item active">
              <a class="nav-link" href="#">Hi <?php echo $_SESSION["username"]; ?></a>
            </li>
        
            <li class="nav-item active">
              <a class="nav-link" href="database/logout.php">Logout</a>
            </li>
            
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Profile
              </a>
              <div class="dropdown-menu bg-success">
                <a class="dropdown-item" href="./myprofile.php">Edit Profile</a>
                <a class="dropdown-item" href="./myfiles.php">My Files</a>
              </div>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item active">
              <a class="nav-link" href="login.html">Login</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="signup.html">SignUp</a>
            </li>
        <?php
        }
        ?>

      </ul>

    </nav>
  </header>



  <div class="jumbotron my-0 py-2 text-white" style="position: fixed; background-color: #17a2b8; opacity: 0.85;">
    <h1>Files List</h1>
      <ul>
        
        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                $fileQuery = "SELECT * FROM files WHERE username='".$_SESSION["username"]."' AND language = '".$language."' ORDER BY ID DESC";
                
                // echo $fileQuery;
                
                $result = $link->query($fileQuery);
                // echo $result->num_rows;
                if ($result->num_rows > 0) {
                // output data of each row
                    $id = $result->num_rows-1;
                    $idlink = $id; 
                    echo $language." files <br>";
                    while($row = $result->fetch_assoc()) {
                        
                        $idnum = $result->num_rows - $id;
                        // echo $idlink;
                        if($idnum>10){
                            break;
                        }
                        
                        echo $idnum." : <a href=".$language."compiler.php?id=".$idlink." style='color:white'>".$row["Name"]."</a> <br>";
                        $id--;
                        $idlink--;
                    }
                } else {
                    echo "No files are saved";
                }
        
        ?>
        </ul>
            
        <?php    
            } else {
                // echo "Login to use this feature";
            }
            $link->close();
        ?>
         
  </div>


  <div class="container" style="margin-top: 80px;">
		<div class="mx-5 my-5">

      <form id="MYFORM" class="" action="compileresult.php" method="post">
        <h1><label for="editor">Editor</label></h1>

  			<div class="my-0 d-flex" style="background-color: #17a2b8; width: 1000px">
  				<div class="flex-grow-1 align-self-center">
  				    <?php
  				        if($foundFileName!="") {
  				            echo $foundFileName;
  				        } else {
  				    ?>
  				          Untitled.c
  				    <?php          
  				        }
  				    ?>
  				    </div>

                <?php
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                ?>
      				<!--<button id="SAVEBTN" class="btn btn-danger mx-1" value="SAVE">Save</button>-->
      				<input id="SAVEBTN" type="submit" class="btn btn-danger mx-1" name="SAVE" value="SAVE" onclick="openForm()">
    
      				 <div class="jumbotron popup-form" id="myForm">
      				  <!--<form class= "form-group">-->
      				    <h1 style="color:black">Save</h1>
      				    <label for="filename"><b>Filename : </b></label>
      				    <input class="form-control" type="text" placeholder="Untitled.c" name="filename" required>
      				        <br>
      				    <button id="SAVEFILE" type="submit" class="btn btn-success" onclick="closeForm()">Save</button>
      				    <button class="btn btn-danger" onclick="closeForm()">Cancel</button>
      				  <!--</form>-->
      				</div>
      				<script type="text/javascript">
      					function openForm() {
      					  document.getElementById("myForm").style.display = "block";
      					}
    
      					function closeForm() {
      					  document.getElementById("myForm").style.display = "none";
      					}
      				</script>
                
                <?php
                    }
                ?>
                

  				<div class="custom-control custom-switch my-2">
  					<input class="custom-control-input" type="checkbox" checked id="mode" onclick="changeMode()">
  					<label class="custom-control-label" for="mode">Dark Mode </label>
  				</div>
  			</div>
  			<textarea name="code" class="overflow-auto" id="editor" autofocus spellcheck="false" placeholder="Enter your code here..." wrap="off"><?php echo $foundCode;?>

  			</textarea>
  			<br>
  			<h1><label for="input">Input</label></h1>
  			<textarea name="codeInput" class="overflow-auto" id="input" spellcheck="false" placeholder="Enter your input case here(Leave this blank if not required)..."></textarea><br>
        <input class="compilerId" type="text" name="compilerId" value="0">
        <br>
        <button id="COMPILE" class="btn btn-lg btn-success mx-1" type="submit">Compile and Run</button>
        <div class="my-5">
        <h1><label for="output">Output</label></h1>
        <textarea rows="10" class="overflow-auto" id="out" spellcheck="false" disabled></textarea><br>
        </div>
      </form>


		<script type="text/javascript">
			function changeMode() {
				var t = document.querySelectorAll("textarea");
				var c = document.getElementById("mode");
				if(c.checked==true) {
					for(var i=0; i< t.length; i++)
					{
						t[i].style.color = "white";
						t[i].style.backgroundColor = "black";
					}
				}
				else {
					for(var i=0; i< t.length; i++)
					{
						t[i].style.color = "black";
						t[i].style.backgroundColor = "white";
					}
				}
			}
		</script>

	</div>
	</div>



    <script>
    //wait for page load to initialize script
    
    function refreshPage() {
        location.reload(true);
    }
    
    $(document).ready(function(){
        
       $("#SAVEBTN").on('click',function(e) {
          e.preventDefault();
          $('form').attr('action','database/savefile.php');
          
          e.preventDefault();
          
            // $.ajax({
            //     type: "POST", //type of submit
            //     cache: false, //important or else you might get wrong data returned to you
            //     url: "database/savefile.php", //destination
            //     datatype: "html", //expected data format from process.php
            //     data: $('form').serialize(), //target your form's data and serialize for a POST
            //     success: function(result) { // data is the var which holds the output of your process.php
            //     }
            // });
       });
       
      $("#SAVEFILE").on('click',function(e) {
          e.preventDefault();
          $('form').attr('action','database/savefile.php');
          e.preventDefault();
        //   $('form').submit();
            $.ajax({
                type: "POST", //type of submit
                cache: false, //important or else you might get wrong data returned to you
                url: "database/savefile.php", //destination
                datatype: "html", //expected data format from process.php
                data: $('form').serialize(), //target your form's data and serialize for a POST
                success: function(result) {// data is the var which holds the output of your process.php
                    // console.log(result);
                    setTimeout('refreshPage()', 100);
                }
            });
      });

        

        //listen for form submission
        $('#COMPILE').on('click', function(e){
          //prevent form from submitting and leaving page
          $('#out').html("Compiling...");
          e.preventDefault();
          
          $('form').attr('action','compileresult.php');
          
          // AJAX
          $.ajax({
                type: "POST", //type of submit
                cache: false, //important or else you might get wrong data returned to you
                url: "compileresult.php", //destination
                datatype: "html", //expected data format from process.php
                data: $('form').serialize(), //target your form's data and serialize for a POST
                success: function(result) { // data is the var which holds the output of your process.php

                    // locate the div with #result and fill it with returned data from process.php
                    $('#out').html(result);
                    // document.write(result);
                }
            });
        });
    });
    </script>

    <script type="text/javascript" src="js/compiler.js"></script>

  </body>
</html>
