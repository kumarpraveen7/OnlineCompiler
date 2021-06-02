<?php
    session_start();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

        <link rel="stylesheet" type="text/css" href="./css/home.css">

        <style media="screen" type="text/css">
      
  footer{
      /*background-color: green;*/
      /*width:100%;*/
      /*height:28%;*/
      opacity:0.9
    }
    body {

    }
    /*.about{*/
    /*  color:white;*/
    /*  font-size: 150%;*/
    /*  margin:15px;*/
    /*  margin-left: 60px;*/
    /*  margin-right: 400px;*/
    /*}*/


    /*.feedback{*/
    /*  color:white;*/
    /*  font-size: 150%;*/
    /*  text-align:center;*/
    /*  margin-top:100px;*/
    /*  margin-left: 70px;*/



    /*}*/
    /*.contact{*/
    /*  color:white;*/
    /*  margin-left: 300px;*/
    /*  font-size:150%;*/
    /*}*/
    /*.about2{*/
    /*  color:white;*/
    /*  padding-left:50px;*/

    /*}*/
    /*.feedback2{*/
    /*  color:white;*/
    /*  padding-left:50px;*/

    /*  margin-right:500px;*/
    /*}*/

    /*.contact2{*/
    /*  margin-left:90px;*/
    /*  padding-left: 280px;*/
    /*  color:white;*/
    /*}*/
        .blink {
          -webkit-animation: blink 1.75s linear infinite;
          -moz-animation: blink 1.75s linear infinite;
          -ms-animation: blink 1.75s linear infinite;
          -o-animation: blink 1.75s linear infinite;
           animation: blink 1.75s linear infinite;
        }
        @-webkit-keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 1; }
          50.01% { opacity: 0; }
          100% { opacity: 0; }
        }
        @-moz-keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 1; }
          50.01% { opacity: 0; }
          100% { opacity: 0; }
        }
        @-ms-keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 1; }
          50.01% { opacity: 0; }
          100% { opacity: 0; }
        }
        @-o-keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 1; }
          50.01% { opacity: 0; }
          100% { opacity: 0; }
        }
        @keyframes blink {
          0% { opacity: 1; }
          50% { opacity: 1; }
          50.01% { opacity: 0; }
          100% { opacity: 0; }
        }
        </style>



  </head>

  <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-success fixed-top" style="opacity: 0.9;">
    	<a href=""></a>
    <ul class="navbar-nav">
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
        
    <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    ?>
      <!--<li class="nav-item active">-->
      <!--  <a class="nav-link" href="./feedback.php">Feedback</a>-->
      <!--</li>-->
    <?php 
        }
    ?>
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


  <div class="container-fluid" style="margin-top: 80px;">
  	<div class="jumbotron py-3">
  		<h1>Welcome to Online Compiler</h1>
  		<p>In this website you can code, compile and save files.</p>
  		<?php
  		    if(!isset($_SESSION["loggedin"])){
  		?>
      		<p>Login or Signup to get started.</p>
      		<form action="./login.html">
      			<button type="submit" class= "btn btn-lg btn-success">Login</button>
      		</form>
      		<h5 class= "mx-1 px-4 align-self-center">or</h5>
      		<form action="./signup.html">
      			<button type="submit" class= "btn btn-lg btn-primary">Signup</button>
      		</form>
      	<?php
  		    }
  		?>
  		<h1 class="text-danger my-1 blink">HAPPY CODING!!!</h1>
  	</div>
  </div>


    <!-- <div id="CodeList">
      <h1>Select The Compiler</h1>
      <a href="ccompiler.php"><button type="button" name="button" class="btn btn-danger CodeButton">C</button><br></a>
      <a href="cppcompiler.php"><button type="button" name="button" class="btn btn-danger CodeButton">C++</button><br></a>
      <a href="javacompiler.php"><button type="button" name="button" class="btn btn-danger CodeButton">Java</button><br></a>
      <a href="pythoncompiler.php"><button type="button" name="button" class="btn btn-danger CodeButton">Python</button><br></a>
    </div> -->


    <script type="text/javascript" src="home.js"></script>
    <br>
     <br>
      <br>
       <br>
        <br>
         <br>
  </body>
  
  <div class="fixed-bottom" >
      <footer>
            <table class="table table-dark bg-success my-0">
                <th>
                  <h2 class = "about">About Us</h2>
                </th>
                <th>
                  <h2 class="feedback">Feedback</h2>
                </th>
                <th>
                  <h2 class = "contact">Have a Question?</h2>
                </th>
                <tr>
                  <td class = "about2">
                <br />
                  This site was started by three students,<br />
                  as a web tech project under the<br />
                  guidance of Mrs.Spurthi Anjan.
            
                  </td>
                  <td class = "feedback2">
                    <br />
                  Your feedback is the Most important<br />
                 priority for us,So that we can improve<br />
                 our website and keep the free service<br />
                 available to all.<br />
                 You can give your feedback <a style="color;'#020159'" href = "feedback.php">here</a>
            
                  </td>
                  <td class = "contact2">
                    <br />
                      &#9742;<br />
                      Praveen Kumar -+91 9424746474 <br />
                      &#9742;<br />
                      Apoorv Kashyap -+91 73494 96782 <br />
                      &#9742;<br />
                      Aneesh Bhat -+91 96115 08816 <br />
                  </td>
                </tr>
              </table>
      </footer>
</div>
</html>
