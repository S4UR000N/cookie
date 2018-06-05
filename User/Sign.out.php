<?php

// Start Session
session_start();

// Get Session Data
$My_Name = $_SESSION['Name'];
$My_Password = $_SESSION['Password'];

// Unset Session
session_unset($MyName);
session_unset($MyPassword);

// Destroy Session
session_destroy();

// Pre_Set for Redirect
$DfS = array($My_Name, $My_Password);

// Redirect
if(count($DfS[0] && $DfS[1]) != 2) {
	header('Location: http://localhost/cookie/cookie.php');
  }
else{
	echo "Error: 617" . "<br />" . "Sign Out Failed Refresh The Site";
  }




?>
