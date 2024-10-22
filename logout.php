<?php
session_start();
unset($_SESSION);
session_destroy();
Header('Location: login.php'); 
?>
