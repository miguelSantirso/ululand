<?php
// -------------------
// configuration file
// insert here
// you MySQL variables
// -------------------
$table = 'chat_message';
$user = 'chat_useronline';
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// make foo the current db
$db = mysql_select_db('sfpfc', $link);
if (!$db) {
    die ('Can\'t use foo : ' . mysql_error());
}

// ---------------
// flash chat vars
// ---------------
// how many old messages the firs time enters
$first_run = 50;
// max users online
$max_users = 10;
// After how much time user is disconnected (in ms)
$active = 20000;


// --------------------
// pass microtime
// --------------------
function getmicrotime()
{
    $time = microtime();
    $time = explode(" ",$time);
    return ($time[1] . substr($time[0],2,3));
}
?>