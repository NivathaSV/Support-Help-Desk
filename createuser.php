<?php
include("includes.php");
if($_SESSION['user'] != NULL){
  if($_SERVER["REQUEST_METHOD"] == "POST") {
   	$user['role'] = $_POST['role'];
	$user['name'] = $_POST['name'];
	$user['password'] =$_POST['password'];
	$sql = "INSERT INTO users	(name, password, role) VALUES ('".$user['name']."','". $user['password']."', '".$user['role'] ."')";
	if ($conn->query($sql) === TRUE) {
	  $msg = "User created Successfully"; 
    }	
  }
}else{
  header("location:login.php");
}
?>
<html class="no-js" lang="en" dir="ltr">
  <body>
  <div class="grid-container">
  <div class="grid-x grid-padding-x">
	  <div class="large-4 medium-4 cell">
          <h5>Menu</h5>
          <ul class="vertical menu">
			<li><a href="myrequests.php">My Requests</a></li>
			<li><a href="createrequest.php">Create Request</a></li>
			<?php if($_SESSION['role'] == 'admin') { ?>
			<li><a href="assignedrequests.php">Requests for me</a></li>
			<?php } ?>
			<?php if($_SESSION['role'] == 'admin') { ?>
		    <li><a href="createuser.php">Create User</a></li>
		    <?php } ?>
			<li><a href="logout.php">Logout</a></li>
		  </ul>
      </div>
	  <div class="large-8 medium-8 cell">
        <form action="createuser.php" method="post">
		  <h3>Create Request</h3>
		  <div class="callout">
            <div class="large-6 medium-6 cell">
              <label>Role</label>
              <select name="role">
                <option value="admin">admin</option>
				<option value="user">user</option>				
              </select>
            </div>
		    <div class="large-6 medium-6 cell">
			  <label>User Name</label>
			  <input type="text" placeholder="Username or Email" name="name" required="true"/>
		    </div>
			<div class="large-6 cell">
              <label>Password</label>
              <input type="text" placeholder="Password" name="password" required="true"/>
            </div>
			<div class="large-6 cell">
              <button class="button">Submit</button>
            </div>
			<div style = "font-size:20px; color:green; margin-top:10px"><?php if(isset($msg)){ print_r($msg);}?></div>
          </div>
   	    </form>
	  </div>
	</div> 
  </body>
</html>
    