<?php 
  session_start();
  //connection to the database
  include ("connection.php");
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $email = $_POST['address'];
    $password = $_POST['pass'];

    //reads from the database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    //if there is an existing email
    if(mysqli_num_rows($query) > 0){
      $userdata = mysqli_fetch_assoc($query);

      if($userdata['password'] == $password){
        //set session variables
        $_SESSION['address'] = $userdata['email'];
        $_SESSION['password'] = $userdata['password'];

      }else{
        echo '<script>alert("Invalid email and/or password.")</script>';
      }
    }else{
    	echo '<script>alert("No existing user.")</script>';
    }

    if(isset($_SESSION['address'])){   //check if session variable address has some variable
      //direct to homepage
      $_SESSION['last_login_timestamp'] = time(); 	//gets the current time of when you logged in
      header("Location: index.php");
    }
  }
  if(!isset($_SESSION['address'])){ //checks if the session variable address has no variable 
    echo '<script>alert("You have logged out.")</script>'; 
  }
?>

<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css"/> 
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<head>
<head> 
	<title>Login Page</title>
</head>
<body>
	<div class="login">
	<form id="login" method="post" action="#">
		<h2 style= "border-bottom-style: groove;">LOGIN</h2>
		<label><b>Email Address:
		</b>
		</label>
		<input type="text" name="address" id="address" placeholder="Email">
		<br><br>

		<label><b>Password:
		</b>
		</label>
		<input type="Password" name="pass" id="pass" placeholder="Password">
		<input type= "checkbox" onclick= togglePass()><label>Show Password<label>   
		<br><br>

		<div style= "text-align: center;">
			<input type="submit" name="log" id="log" value="LOG IN">
		</div>
		<br>
		<br>
		<p style= "border-bottom-style: groove; margin-top: 0px;"></p>
		<span>New User?</span>
		<input type="button" onclick="location.href = 'signup.php'" name="sign" id= "sign" value="SIGN UP">	
	</form>
	</div>
	<script>
		function togglePass(){
			var password = document.getElementById("pass"); //gets the value of id "pass"
			if (password.type == "password"){		
				password.type = "text";
			}else{
				password.type = "password";
			}
		}
	</script>
	
</body>
</html>