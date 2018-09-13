<?php
include("includes.php");
if($_SESSION['user'] != NULL){
  $rid = $_GET['id'];
  unset($_GET['id']);  
  $sql = "SELECT * FROM requests WHERE rid='".$rid."'";
  $res = $conn->query($sql);
  while($row = $res->fetch_assoc()){
    $data = $row; 
  }	
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $_POST['rid'];
    $sql1 = "UPDATE requests SET status='closed' WHERE rid = '".$id."'";	
	if ($conn->query($sql1) === TRUE) {
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
        <form action="openrequest.php" method="post">
		<h3>Open Request</h3>
		  <div class="callout">
               <div class="large-6 medium-6 cell">
                <div class="large-6 cell">
			      <label>Priority</label>
			      <input type="text" name="priority" value="<?php echo $data['priority']; ?>" readonly>
		        </div>
              </div>
			  <div class="large-6 medium-6 cell">
                <div class="large-6 cell">
			      <label>Query Type</label>
			      <input type="text" name="type" value="<?php echo $data['type']; ?>" readonly>
		        </div>
              </div>
			  <div class="large-6 medium-6 cell">
                <div class="large-6 cell">
			      <label>Created By</label>
			      <input type="text" name="created_by" value="<?php echo $data['created_by']; ?>" readonly>
		        </div>
              </div>
			  <div class="large-6 medium-6 cell">
                <div class="large-6 cell">
			      <label>Created On</label>
			      <input type="text" name="created_on" value="<?php echo $data['created_on']; ?>" readonly>
		        </div>
              </div>
			  <div class="large-6 medium-6 cell">
                <div class="large-6 cell">
			      <input type="hidden" name="rid" value="<?php echo $data['rid']; ?>" >
		        </div>
              </div>
			  <div class="large-6 cell">
                <label>Comments</label>
                <textarea placeholder="Add comment" name="comment" readonly><?php if(isset($data['comment']))echo $data['comment']; ?></textarea>
              </div>
			  <div class="large-6 cell">
                <button class="button">Close Request</button>
              </div>
           </div>
   	    </form>
	  </div>
	</div> 
  </body>
</html>
    