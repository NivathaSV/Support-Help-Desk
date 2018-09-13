<?php
include("includes.php");
if($_SESSION['user'] != NULL){
  $sql = "SELECT * FROM users WHERE role='admin'";
  $res = $conn->query($sql);
  while($row = $res->fetch_assoc()){
    $name[] = $row;
  }
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $req['type'] = $_POST['type'];
	$req['assigned_to'] = $_POST['assignee'];
	$req['priority'] = $_POST['priority'];
	$req['comment'] = $_POST['comment'];
	$req['status'] = 'active';
	$req['created_by'] = $_SESSION['user'];
	$req['created_on'] = date("Y-m-d");
	$sql1 = "INSERT INTO requests
			(type, assigned_to, created_by, priority, comment, status, created_on)
			VALUES ('".$req['type']."','". $req['assigned_to']."', '".$req['created_by'] ."', '".$req['priority']."', '".$req['comment']."', '".$req['status']."', '".$req['created_on']."')";
	if ($conn->query($sql1) === TRUE) {
      echo "New record created successfully";
	  header("location: myrequests.php");
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
        <form action="createrequest.php" method="post">
		  <h3>Create Request</h3>
		  <div class="callout">
            <div class="large-6 medium-6 cell">
              <label>Priority</label>
              <select name="priority">
                <option value="high">High</option>
				<option value="medium">Medium</option>
				<option value="low">Low</option>
              </select>
            </div>
			  <div class="large-6 medium-6 cell">
                <label>Assign To</label>
                <select name="assignee">
                  <?php foreach($name as $n){
                    echo "<option value='" . $n['name'] ."' >" . $n['name'] ."</option>";
                  } ?>
                </select>
              </div>
			  <div class="large-6 medium-6 cell">
                <label>Query Type</label>
                <select name="type">
                  <option value="incident">Incident</option>
				  <option value="service">Service</option>
                </select>
              </div>
			  <div class="large-6 cell">
                <label>Comments</label>
                <textarea placeholder="Add comment" name="comment" required="true"></textarea>
              </div>
			  <div class="large-6 cell">
                <button class="button">Submit</button>
              </div>
           </div>
   	    </form>
	  </div>
	</div> 
  </body>
</html>
    