<?php error_reporting(0); ?>
<?php
// Start Session
session_start();

$My_Name = $_SESSION['Name'];
$My_Password = $_SESSION['Password'];
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

<!-- file_Style.Inc -->
<link rel="stylesheet" href="Header/header_style.css">

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


<!-- FAQ -->

<div class="container-fluid d-flex flex-column">
 <div id="shell_1" class="shell d-flex flex-row justify-content-around"></div>
 <div id="shell_2" class="shell d-flex flex-row justify-content-around"></div>
 <div id="shell_3" class="shell d-flex flex-row justify-content-around"></div>
</div>

<!-- Style -->
<style>
.shell { margin: 5% 0 0 0; }
.q { text-align: center; height: 74px; }
.a { text-align: center; height: 74px; font-size: 18px; pointer-events: none; }
 body { background-color: #b3ffb3; }
</style>

<!-- Script -->
<script>
/* OOP FAQ.set */

var FAQ = {
 FAQ : function(question, answer, where_to_place) {
  // reference
	var me = this;

  // question
  this.question = question;

  var q = document.createElement("button");
  q.innerHTML = this.question;

	// answer
  this.answer = answer;
  var a = document.createElement("button");
  a.innerHTML = this.answer;

	// where
	me.where = where_to_place;
	var where = document.getElementById(me.where);

	// create shell & append data
	var shell = document.createElement("span");
	shell.appendChild(q);
	shell.appendChild(a);

	where.appendChild(shell);

  // BS 4 Style
  q.className = "bg-dark text-warning border-0 rounded-top";
  a.className = "bg-info text-white border border-top-0 border-info rounded-bottom";
	shell.className = "d-flex flex-column col-md-3";

	// elements.pre_aim
	q.className += " q";
	a.className += " a";

	// hide answer
	$(a).hide();
  }
 };


/* OOP FAQ.get */

var q_a_00 = FAQ.FAQ("What do you do?", "We sell imaginary items", "shell_1");
var q_a_01 = FAQ.FAQ("What is your goal?", "To get internship", "shell_1");
var q_a_02 = FAQ.FAQ("What are Terms of use?", "None", "shell_1");

var q_a_10 = FAQ.FAQ("Why I can't add payment method?", "Because you can \"buy\" everything for free here", "shell_2");
var q_a_11 = FAQ.FAQ("Why are your stuff free?", "We love to share everything", "shell_2");
var q_a_12 = FAQ.FAQ("How your business survives without revenue?", "It's running at 127.0.0.1", "shell_2");

var q_a_20 = FAQ.FAQ("How to receive items?", "Just enter your real email during the Sign Up", "shell_3");
var q_a_21 = FAQ.FAQ("How many items can I order at a time?", "There is no limit", "shell_3");
var q_a_22 = FAQ.FAQ("Where & when will my order arrive?", "You will receive items instantly via email", "shell_3");



// elemnts.aim
var n_q = document.getElementsByClassName("q");
var n_a = document.getElementsByClassName("a");

// hardCode handler
var i = 0;
function hardCode_handler(i) {
 $(n_q[i]).click(function() {
  $(n_a[i]).toggle("slow");});
 }

// hardCode elements.click
for(var i = 0; i < n_q.length; i++) {
 hardCode_handler(i);
 }
</script>
