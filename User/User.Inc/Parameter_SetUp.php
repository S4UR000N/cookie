<?php

// Parameter

// $ID = "";

// Query

$GET_ID = "SELECT `ID` FROM `btcore` WHERE TRUE ORDER BY `ID` DESC LIMIT 1";

// Store Data

$Data_ID = mysqli_query($db, $GET_ID);

// Store ID

$Store = mysqli_fetch_array($Data_ID);

// Extract ID

$Set_ID = $Store[0];

// Set Valid ID

$ID = $Set_ID + 1;

// Prevent Overset

if($ID != 0){
  return $ID;
}
else{
  echo "ID IS FUCKED UP!";
}

?>
