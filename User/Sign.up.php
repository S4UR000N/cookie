<?php error_reporting(0); ?>
<?php
// Set Parameters for DB Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "core";

// Store Connection
$db = mysqli_connect($host, $username, $password, $database);

// Start Session
session_start();

$query_bool = 0;
$ID = $_SESSION['ID'];
$My_Name = $_SESSION['Name'];
$My_Password = $_SESSION['Password'];

// Parameter SetUp
$Name = "";
$Email = "";
$Password = "";
$Confirm_Password = "";
$Error = array();
?>

<?php
// form
if(isset($_POST['SU_btn'])) {
  $Name = mysqli_real_escape_string($db, $_POST['SU_Name']);
  $Email = mysqli_real_escape_string($db, $_POST['SU_Email']);
  $Password = mysqli_real_escape_string($db, $_POST['SU_Password']);
  $Confirm_Password = mysqli_real_escape_string($db, $_POST['SU_Confirm_Password']);
  }

// Display Error If Form not Properly filled
require "User.Inc/Return.Error.SU.php";

// set up ID
require "User.Inc/Parameter_SetUp.php";

// Query
$Query_SU_Insert = "INSERT INTO `btcore` (ID, Name, Email, Password) VALUES ('$ID', '$Name', '$Email', '$Password');";

// If no Errors Insert Data
if(isset($_POST['SU_btn']) && count($Error) == 0) {
  mysqli_query($db, $Query_SU_Insert);
  $query_bool = 1;
  }

if(isset($_POST['SU_btn']) && $query_bool == 1) {
  header("location: http://localhost/cookie/User/Sign.in.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<body>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<!-- Inc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- Style.Inc -->
<link href='https://fonts.googleapis.com/css?family=Germania One' rel='stylesheet'>

<!-- file_Style.Inc -->
<link rel="stylesheet" href="../Header/header_style.css">

<?php require "../Header/header.php" ?>

<!-- HTML -->
<div id="tape" class="container-fluid">
 <div id="tape_data" class="d-flex justify-content-end"></div>
</div>

<!-- Return Correct Header -->
<?php
// Data for Switch
$DfS = array($My_Name, $My_Password);

// Set Header Items
$Header_Item = array(
 "1" => "../Header/header.in.php",
 "2" => "../Header/header.out.php");

// Pre Wrap Header
$Header_Pre_Wrap = array();

// Get Correct Item
if(empty($DfS[0]) && empty($DfS[1])){
  array_push($Header_Pre_Wrap, $Header_Item["2"]);
  }
if(!empty($DfS[0]) && !empty($DfS[1])){
  array_push($Header_Pre_Wrap, $Header_Item["1"]);
  }

// Store Correct Item
$Header_Wrap = $Header_Pre_Wrap[0];

// Return Correct Header
require $Header_Wrap;
?>

<!-- Spacing -->
<br />

<!-- form -->
<div class="d-flex justify-content-center">
 <form class="Sign_Up d-flex flex-column" name="Sign_Up" method="post" action="Sign.up.php">
  <h1 class="header bg-dark rounded text-info mx-auto p-3" style="">Sign Up</h1>
   <?php // Display Validation Errors here ?>
   <?php Include ("User.Inc/Return.Errors.php"); ?>

  <div class="label">Name</div>
  <input class="input" type="text" name="SU_Name" value="<?php echo $Name ?>"/>

  <div class="label">Email</div>
  <input class="input" type="email" name="SU_Email" value="<?php echo $Email ?>"/>

  <div class="label">Password</div>
  <input class="input" type="password" name="SU_Password" value=""/>

  <div class="label">Confirm Password</div>
  <input class="input" type="password" name="SU_Confirm_Password" value=""/>

  <button class="btn btn-primary" name="SU_btn">Sign Up</button>
 </form>
</div>

<!-- Style -->
<style>
</style>
