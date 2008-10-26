<?php
error_reporting(E_ERROR);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

if(!isset($_GET['uniqid']))
{
   die("output=false");
}
// ---------------------
// include the
// configuration file
// ---------------------
include_once ('config.inc.php');
$a = 0;
$uniqid = $_GET['uniqid']; // recognize chat user
// ------------------------
// GET MY LAST UPDATE
// ------------------------
$query = "SELECT user_date FROM $user WHERE user_id = '$uniqid' LIMIT 1";
$sql = mysql_query($query, $link);
$row = mysql_fetch_assoc($sql);
$last_time = $row['user_date'];
mysql_free_result($sql);
// ------------------------
// UPDATE whos_online TABLE
// ------------------------
$time_start = getmicrotime();
$query = "UPDATE $user SET user_date = '$time_start' WHERE user_id = '$uniqid' LIMIT 1";
@$sql = mysql_query($query,$link);
?>

<?
// -----------------------
// if is the first query
// return history
// -----------------------
if(isset($_GET['first_run']))
{
   $limit = "LIMIT $first_run";
   $clause = "WHERE chat.user_id = user.user_id";
} else {
   // -----------------------------
   // else return only new messages
   // -----------------------------
   $limit = "";
   $clause = "WHERE chat.user_id != '$uniqid' AND chat.user_id = user.user_id
   AND $last_time < chat.chat_data";
}
// ---------------------
// QUERY FROM TABLE
// ---------------------
print "nada=jarl";
$query = "SELECT chat.chat_data, chat.chat_message, user.user_name
FROM $table as chat, $user as user $clause ORDER by chat.chat_data DESC $limit";
if(@$sql = mysql_query($query,$link))
{
   $_totalmsg = mysql_num_rows($sql);
   while($row = mysql_fetch_assoc($sql))
   {
      $a++;
      $data = urlencode($row['chat_data']);
      $username = urlencode($row['user_name']);
      $message = urlencode(htmlspecialchars($row['chat_message']));
      print "&__date$a=$data&__user$a=$username&__message$a=$message";
   }
}
print "&__total=$_totalmsg";
// -----------------------
// Tell flash how many
// items in the array
// -----------------------
if(isset($_GET['first_run']))
{
   print "&__array_length=$first_run";
}
// -----------------------
// NOW RETURN ONLINE
// USERS
// -----------------------
$query = "SELECT user_name FROM $user
WHERE ($time_start - user_date) < $active ORDER BY user_name ASC";
if(@$sql = mysql_query($query,$link))
{
   $a = 0;
   while($row = mysql_fetch_assoc($sql))
   {
      $a++;
      print "&__online$a=$row[user_name]";
   }
}
mysql_free_result($sql);
?>