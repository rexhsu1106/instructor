<?php
  require('session.php');
  
  if($_SESSION['member']['type'] == "admin")
  {
    Header('Location: manageEvaluation.php');
  }
  else
  {
  	Header('Location: login.php');
  }
?>