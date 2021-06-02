<?php
    session_start();
    
    require_once "database/config.php";
    
     $query = "SELECT * FROM users WHERE username='".$_SESSION["username"]."'";
     $result = $link->query($query);
     $row = $result->fetch_assoc();
     $_SESSION["email"] = $row["email"];
     $_SESSION["username"] = $row["username"];
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>My Profile</title>
	 <link rel="stylesheet" type="text/css" href="./css/home.css">
</head>
<body background="./images/background2.jpg" style="background-repeat: no-repeat; background-size: cover;">
	<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-success fixed-top" style="opacity: 0.9;">
		<nav class="navbar navbar-expand-sm navbar-dark bg-success fixed-top" style="opacity: 0.9;">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="./index.php">Home</a>
	      </li>
	      <li class="nav-item dropdown active">
	        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	          Languages
	        </a>
	        <div class="dropdown-menu bg-success">
            <a class="dropdown-item" href="ccompiler.php" >C</a>
            <a class="dropdown-item" href="cppcompiler.php" >C++</a>
            <a class="dropdown-item" href="javacompiler.php" >Java</a>
            <a class="dropdown-item" href="pythoncompiler.php" >Python</a>
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
	<div class="container" style="margin-top:80px">
    <form class="form-group jumbotron" id="signup" action="database/profilechange.php" method="POST">
      <h1 class="d-flex h1 mb-3 font-weight-normal justify-content-center">My Profile</h1>

    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    ?>
      <label for="email">Email:</label>
      <input class="form-control" id="lname" type="email" name="email" value="<?php
      echo $_SESSION["email"];
      ?>
      " readonly>
      <input type="button" value="Edit" class="btn btn-primary my-2" onclick="changeLname()"><br><br>
      <label for="uname">Username:</label>
      <input class="form-control" id="uname" type="text" name="username" value="<?php
      echo $_SESSION["username"];
      ?>" readonly>
      <input type="button" value="Edit" class="btn btn-primary my-2" onclick="changeUname()"><br><br>
      <label for="pword">Password:</label>
      <input class="form-control" id="pword" type="password" name="password" value="PAssword" readonly>
      <div id="show" style="display: none;">
	      <label for="cpword">Confirm Password:</label>
	      <input class="form-control" id="cpword" type="password" name="confirm_password" value="PAssword">
  	  </div>
      <input type="button" value="Edit" class="btn btn-primary my-2" onclick="changePword()"><br><br>
      <br>
      <button class="btn btn-lg btn-success my-2" type="submit">Submit</button>
    <?php
    } else {
    ?>
        <p class="d-flex h3 mb-3 font-weight-normal justify-content-center">
     <?php echo "You must be logged in to use this";?>
        </p>
    <?php
    }
    $link->close();
    ?>
    
      <script type="text/javascript">
    	function changeFname() {
    		var d = document.getElementById("fname");
    		d.removeAttribute("readonly");
    	}

    	function changeLname() {
    		var d = document.getElementById("lname");
    		d.removeAttribute("readonly");
    	}

    	function changeUname() {
    		var d = document.getElementById("uname");
    		d.removeAttribute("readonly");
    	}

    	function changePword() {
    		var d = document.getElementById("pword");
    		d.removeAttribute("readonly");
    		document.getElementById("show").style.display = "initial";
    	}
    </script>
    </form>
</body>
</html>