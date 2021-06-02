<?php 
    session_start();
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>My Files</title>
	<link rel="stylesheet" type="text/css" href="./css/home.css">
</head>
<body background="./images/background2.jpg" style=" background-repeat: no-repeat; background-size: cover;">
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
	<div class="container" style="margin-top: 80px">
		<div class="jumbotron">
			<form class="form-group" action="#" method="POST">
				<label for="lang">Select Language</label>
				<select class="" id="lang" name="language">
					<option value="c">C</option>
					<option value="cpp">C++</option>
					<option value="java">Java</option>
					<option value="python">Python</option>
				</select>
				<button class="btn btn-sm btn-success" type="submit">Show Files</button>
			</form>
			<?php 
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                
                    require_once "database/config.php";
                    
                    $language = "c";
                    if(!isset($_POST["language"])) {
                        $language = "c";
                    } else {
                        if($_POST["language"]){
                            $language = $_POST["language"];
                        }
                    }
                    
                    
                    
                    $query = "SELECT * FROM files WHERE username='".$_SESSION["username"]."' AND language = '".$language."'";
    
                    $result = $link->query($query);
                    if ($result->num_rows > 0) {
                    // output data of each row
                        $id=0;
                        echo "Showing results for ".$language."<br>";
                        while($row = $result->fetch_assoc()) {
                            echo ($id+1).": <a href=".$language."compiler.php?id=".$id."'>".$row["Name"]."</a> <br>";
                            $id++;
                        }
                    } else {
                        echo "0 results";
                    }
                    $link->close();
                    // $result = mysqli_query($link, $query);
                    // echo $result;
                } else {
                    echo "You must be logged in to use this";
                }
            ?>
		</div>
	</div>
</body>
</html>
