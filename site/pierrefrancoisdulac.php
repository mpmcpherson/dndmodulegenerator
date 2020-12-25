<?php
require 'defaultConnector.php';

echo "<div class='logme'>".$_SERVER['HTTP_HOST']."</div>";
echo "<div class='logme'>".$_SERVER['REMOTE_ADDR']."</div>";
echo "<div class='logme'>".$_SERVER['HTTP_USER_AGENT']."</div>";

$ua_string = $_SERVER['HTTP_USER_AGENT'];
$ipAdd = $_SERVER['REMOTE_ADDR'];

$qq = "INSERT INTO logging(`UA_String` , `ipAdd`, `logTime`, `programId`) VALUES ('".$ua_string."','".$ipAdd."','".gmdate('Y-m-d H:i:s')."','".strval(1)."')";//should actually rig up a call-and-response here so each program knows its id

$result = mysqli_query($dbhandle, $qq);

?>

