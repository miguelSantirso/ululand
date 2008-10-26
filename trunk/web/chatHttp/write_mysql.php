<?php
error_reporting(E_ERROR);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include_once ('config.inc.php');
// ---------------------
// get variables
// sent by flash
// ---------------------
$uniqid = $_GET['uniqid'];
$message = $_GET['message'];
// get data
$date = getmicrotime();
if(empty($message) || empty($uniqid))
{
   die();
}
// ---------------------
// Write data on mysql
// ---------------------
$query = "INSERT INTO $table (user_id, chat_data, chat_message) VALUES ('$uniqid', '$date', '$message')";
$sql = mysql_query($query,$link);
?>