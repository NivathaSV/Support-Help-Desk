<?php
  include("includes.php");     
  if($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $username = $_POST['name'];
    $password = $_POST['password'];      
    $sql = "SELECT * FROM users WHERE name = '".$username."' AND password = '".$password."'";
    $result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	  $role = $row['role'];
	}
	 
    $count = mysqli_num_rows($result);
				
    if($count == 1) {
	  $_SESSION['user'] = $username;
	  $_SESSION['role'] = $role;
	  $error = 'Success';
	  header("location: myrequests.php");
    }else {
	  $error = "Invalid User Name or Password";
	}
  }
?>
<html class="no-js" lang="en" dir="ltr">
  <body>
    <div class="grid-container">
      <div class="grid-x grid-padding-x">
	    <div class="large-12 cell">
          <h1>Log In</h1>
        </div>
      </div>
	  <form action="login.php" method="post">
		<div class="grid-x grid-padding-x">
		  <div class="large-6 cell">
			<label>User Name</label>
			<input type="text" placeholder="Username or Email" name="name" required="true"/>
		  </div>
		</div>
		
		<div class="grid-x grid-padding-x">
		  <div class="large-6 cell">
			<label>Password</label>
			<input type="password" placeholder="Password" name="password" required="true"/>
		  </div>
		</div>
		
		<div class="grid-x grid-padding-x">
		  &nbsp&nbsp&nbsp&nbsp  <button class="button">Login</button>
		</div>
		<div style = "font-size:20px; color:red; margin-top:10px"><?php if(isset($error)){ print_r($error);}?></div>
      </form>
    </div>
  </body>
</html>
