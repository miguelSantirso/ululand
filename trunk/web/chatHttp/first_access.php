<?php
error_reporting(E_ERROR);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include_once ('config.inc.php');
// -----------------------
// First check how many
// active users are online
// -----------------------
$time_start = getmicrotime();
$query = "SELECT user_name FROM $user WHERE ($time_start - user_date) < $active";
$sql = mysql_query($query,$link) or die("output=false");
$total_users = mysql_num_rows($sql);
if($total_users >= $max_users)
{
   die("output=false"); // access denied
}
// ---------------------
// FIRST ACCESS
// return its unique id
// ---------------------
if(isset($_GET['submit']) && isset($_GET['username']))
{
   $uid = md5(uniqid(microtime(), 1)) . getmypid();
   $username = $_GET['username'];
   $query = "INSERT INTO $user (user_id, user_name, user_date) VALUES ('$uid', '$username', '$time_start')";
   if($sql = mysql_query($query,$link))
   {
      echo "uniqid=$uid";
   } else {
      echo "output=false";
   }
}

mysql_close($link);
?>
