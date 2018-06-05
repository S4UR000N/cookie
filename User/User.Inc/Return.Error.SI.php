<?php

// Check Form for Errors

if(isset($_POST['SI_btn'])) {
  if(empty($Name)) {
    array_push($Error, "Name is Required");
  }
  if(empty($Password)) {
    array_push($Error, "Password is Required");
  }
}
