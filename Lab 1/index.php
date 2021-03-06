<?php
  session_start();
  if (isset($_SESSION['address'])) {
    if ((time() - $_SESSION['last_login_timestamp']) > 300) { //checks if user has been inactive for over 5 minutes
      ?>
        <script type="text/javascript">
        alert("You have been logged out due to inactivity.");
        window.location = "http://localhost/126/logout.php"; //redirect to logout.php
        </script>
        <?php
  
    }else{
      $_SESSION['last_login_timestamp'] = time(); //checks current time user was active 
    }
  }else{
    header("Location: login.php");
  }

?>

<!DOCTYPE html>
<html lang= "en">
<head> 
    <link rel="stylesheet" type="text/css" href="index.css"> 
    <title>Dashboard</title>
    <meta charset= "UTF-8">
</head>

<body>
  <div class="header"></div>
      <img src= "avatar.png">
      <h1>HELLO</h1>
      <h1 style= "color:tomato; margin-left: -470px; font-size: 35px; margin-top: 55px;"> <?php echo $_SESSION['address'];?> </h1>
      
      <div>
        <input type="button" onclick="location.href = 'logout.php'" name="logout" id= "logout" value="LOG OUT">
      </div>
    </div>
  <div class="wrapper">
    <div class="sidenav">
      <ul>
       <li><a class= "active" href="index.php">Dashboard</a></li>
  	   <li><a href="todo.php">To-Do</a></li>
      </ul>
	  </div> 
    <div class="content">
      <h3> You have <span class= "pendingNum" style= "color:tomato; font-size: 26px"></span> pending tasks for today.</h3>
      <script>
          let getLocalStorage= localStorage.getItem("New Todo"); //getting localstorage
          if(getLocalStorage == null){ //if localStorage is null
          listArr = []; //creating blank array
          }else{
          listArr = JSON.parse(getLocalStorage); //transforming json string into a js object
          }

          const pendingNum = document.querySelector(".pendingNum");
          pendingNum.textContent = listArr.length;  //passing the length value in pendingNum
      </script>

      <h2 style= "text-align:left;float:left;">TODAY</h2>
      <div class= "today">
        <ul>
          <!-- Data comes from local storage -->
        </ul>
      </div>
      <script>
        const todoList = document.querySelector(".today");
        let getData= localStorage.getItem("New Todo"); //getting localstorage
        if(getData == null){ //if localStorage is null
          listArr = []; //creating blank array
        }else{
          listArr = JSON.parse(getData); //transforming json string into a js object
        }
        let newLiTag = '';
        listArr.forEach((element,index) => {
            newLiTag += `<li> ${element} </li>`;
        });
        todoList.innerHTML = newLiTag; //adding new li tag inside ul tag
      </script>
      <p style="text-transform: uppercase; position: relative; top: 35px; left: -90px;"><script> document.write(new Date().toDateString()); </script></p>    
    </div>  
  </div>  
</body>


</html>

