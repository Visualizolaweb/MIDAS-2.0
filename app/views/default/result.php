<?php

$item = $_POST["item"];
$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];
$tamil = $_POST["tamil"];
$english = $_POST["english"];
$computer = $_POST["computer"];
$total = $_POST["total"];

for ($i=0; $i < count($item); $i++) {
  echo $firstname[$i].' '.$lastname[$i].' '.$tamil[$i];
  echo "<br>";
}



?>
