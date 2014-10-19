<?php
//Lock users from editing their polls after submitted once
session_start();
include('connection.php');
$session = session_id();
$pollid = $_POST['PollID'];
$vote = mysql_real_escape_string($_POST['vote']);
mysql_query("UPDATE response SET count = count + 1 WHERE Response = '$vote' and PollID = $pollid")
                        or die (mysql_error());
mysql_query("insert user_response (pollid, sessionid) values ($pollid , $sessionid)")
                        or die (mysql_error());
header( 'Location: http://boilermake.cosmicshades.com/index.php' );
?>