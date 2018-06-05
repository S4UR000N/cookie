<?php
// include PHPMailer
include_once "PHPMailer/PHPMailer.php";
include_once "PHPMailer/Exception.php";
include_once "PHPMailer/SMTP.php";

// select what to use
use PHPMailer\PHPMailer\PHPMailer;


// Set Parameters for DB Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "core";

// Store Connection
$db = mysqli_connect($host, $username, $password, $database);

// Start Session
session_start();

$My_ID = $_SESSION['ID'];
$My_Name = $_SESSION['Name'];
$My_Password = $_SESSION['Password'];

// Query for user's Mail
$Query_Email = "SELECT `Email` FROM `btcore` WHERE
              `ID` = '$My_ID' AND `Name`= '$My_Name' AND `Password` = '$My_Password';";

// Get Mail
$Query_for_Email = mysqli_query($db, $Query_Email);
$raw_Email = mysqli_fetch_assoc($Query_for_Email);

$My_Email = $raw_Email['Email'];
$_SESSION['Email'] = $My_Email;

// product data
$product_img_data = array(
 // hats
 array("Build/cookie_man/cookie_man_golden_hat.png",
       "Build/cookie_man/cookie_man_classic_cap.png"),
 // gloves
 array("Build/cookie_man/cookie_man_pinky_gloves.png",
       "Build/cookie_man/cookie_man_orange_gloves.png"),
 // mix _._
 array("Build/cookie_man/cookie_man_scarf.png",
       "Build/cookie_man/cookie_man_shoes.png"),
 // mix _._
 array("Build/cookie_man/cookie_man_winter_hat.png",
       "Build/cookie_man/cookie_man_red_gloves.png"),
 // mix _._
 array("Build/cookie_man/cookie_man_round_glasses.png",
	     "Build/cookie_man/cookie_man_diamond_shoes.png")
 );

$product_price_data = array(
 // hats
 array(9000, 50),
 // gloves
 array(800, 20),
 // mix _._
 array(1300, 110),
 // mix _._
 array(2200, 700),
 // mix _._
 array(7000, 4000000)
 );


// auto-mailer
$cart_item = json_decode($_POST['ci']);
$cart_in_item = json_decode($_POST['cii']);


// dev purposes
echo "ID: " . $My_ID . "<br />";
echo "Name: " . $My_Name . "<br />";
echo "Email: " . $My_Email . "<br />";
echo "Password: " .$My_Password . "<br />";

// mail
$mail = new PHPMailer(true);                           // Passing `true` enables exceptions

//Server settings
$mail->SMTPDebug = 2;                                  // Enable verbose debug output
$mail->isSMTP();                                       // Set mailer to use SMTP
$mail->SMTPOptions = array(
 'ssl' => array(
  'verify_peer' => false,
  'verify_peer_name' => false,
  'allow_self_signed' => true
  )
 );
$mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                // Enable SMTP authentication
$mail->Username = 'cookie.44man@gmail.com';            // SMTP username
$mail->Password = 'cookie4man';                        // SMTP password
$mail->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                     // TCP port to connect to

//Recipients
$mail->setFrom('cookie.44man@gmail.com');
$mail->addAddress($My_Email);                          // Add a recipient // Name is optional

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Purchase';
$mail->Body    = 'Dear customer, thanks for your purchase!<br /> <b>Check your items: </b>';
$mail->AltBody = 'Dear customer, thanks for your purchase! Check your items: ';

//Attachments
for($i = 0; $i < count($cart_item); $i++) {
 $mail->addAttachment($product_img_data[$cart_item[$i]][$cart_in_item[$i]]);
 }

// Send mail && Report
if(!$mail->send()) { echo "Fail!"; } else { echo "Success"; }
