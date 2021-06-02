<?php
    session_start();
    
    require_once "database/config.php";
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
     $query = "SELECT * FROM users WHERE username='".$_SESSION["username"]."'";
     $result = $link->query($query);
     $row = $result->fetch_assoc();
     $_SESSION["email"] = $row["email"];
     $_SESSION["username"] = $row["username"];
    }
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>Feedback</title>
	<link rel="stylesheet" type="text/css" href="./css/home.css">
</head>
<body background="./background.jpg" style="background-position: center; background-repeat: no-repeat; background-size: cover;">
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
	<div class="container" style="margin-top:80px;">
	<form class="form-group my-5 jumbotron" id="feedback" action="database/takeFeedback.php" method="POST">
		<h1 class="mx-auto">Give your Feedback Below</h1>
		<label for="topic">Feedback Topic: </label>
		<input class="form-control" type="text" name="topic" id="topic">
		<label for="txt">Feedback : </label>
		<textarea class="form-control" name="txt" rows="20" id="txt"></textarea><br>
		<input type="checkbox" name="anonym" id="">
		<label for="anonym">Submit as anonymous</label><br>
		<button class="btn btn-lg btn-success" type="submit">Submit</button>
	</form>
	</div>
</body>
</html>