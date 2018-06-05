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

$My_Name = $_SESSION['Name'];
$My_Password = $_SESSION['Password'];

// Query for user's ID
$Query_ID = "SELECT `ID` FROM `btcore` WHERE `Name`= '$My_Name' AND `Password` = '$My_Password';";

// Get Correct ID
$Query_for_ID = mysqli_query($db, $Query_ID);
$raw_ID = mysqli_fetch_assoc($Query_for_ID);

$My_ID = $raw_ID['ID'];
$_SESSION['ID'] = $My_ID;
?>

<!DOCTYPE html>
<html lang="en">
<body>
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<!-- Inc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- Style.Inc -->
<link href='https://fonts.googleapis.com/css?family=Germania One' rel='stylesheet'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- file_Style.Inc -->
<link rel="stylesheet" href="Header/header_style.css">
<link rel="stylesheet" href="Build/build_style.css">

<?php require "Header/header.php" ?>

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
 "1" => "Header/header.in.php",
 "2" => "Header/header.out.php");

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

<!-- Return Correct Build -->
<?php
// Data for Switch
$DfS = array($My_Name, $My_Password);

// Set Header Items
$Build_Item = array(
 "1" => "Build/build.in.php",
 "2" => "Build/build.out.php");

// Pre Wrap Header
$Build_Pre_Wrap = array();

// Get Correct Item
if(empty($DfS[0]) && empty($DfS[1])){
  array_push($Build_Pre_Wrap, $Build_Item["2"]);
  }
if(!empty($DfS[0]) && !empty($DfS[1])){
  array_push($Build_Pre_Wrap, $Build_Item["1"]);
  }

// Store Correct Item
$Build_Wrap = $Build_Pre_Wrap[0];

// Return Correct Header
require $Build_Wrap;
?>

<!-- Footer -->
<?php require "Footer/footer.php"; ?>

<!-- Style -->
<style>
</style>
