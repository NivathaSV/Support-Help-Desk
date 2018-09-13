<?php
include("includes.php");
if($_SESSION['user'] != NULL){
  $sql = "SELECT * FROM requests WHERE created_by = '".$_SESSION['user']."'";
  $res = $conn->query($sql);
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
		  <h3>My Requests</h3>
		  <div class="callout">
            <table>
			  <thead>
				<tr>
				  <th>Type</th>
				  <th>Assigned To</th>
				  <th>Priority</th>
				  <th>Comment</th>
				  <th>Status</th>
				  <th>Created On</th>
                </tr>
              </thead>
              <tbody>
			    <?php
				  while($row = mysqli_fetch_array($res)){					
					echo "<tr>";
					echo "<td>" . $row['type'] . "</td>";
					echo "<td>" . $row['assigned_to'] . "</td>";
					echo "<td>" . $row['priority'] . "</td>";
					echo "<td>" . $row['comment'] . "</td>";
					echo "<td>" . $row['status'] . "</td>";
					echo "<td>" . $row['created_on'] . "</td>";
					echo "</tr>";
				  }
				?>  
			  </tbody>
            </table>
           </div>
   	    </form>
	  </div>
	</div> 
  </body>
</html>
    