<?php
  include("includes.php");
  session_destroy();
  header("location: login.php");  
?>