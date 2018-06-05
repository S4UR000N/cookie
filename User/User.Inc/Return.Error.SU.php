<?php

// Check Form for Errors

if(isset($_POST['SU_btn'])) {
  if(empty($Name)) {
    array_push($Error, "Name is Required");
  }
  if(empty($Email)) {
    array_push($Error, "Email is Required");
  }
  if(empty($Password)) {
    array_push($Error, "Password is Required");
  }
  if($Password != $Confirm_Password) {
    array_push($Error, "Passwords don't match");
  }
}

?>
