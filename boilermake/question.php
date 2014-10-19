<?php
//Lock users from editing their polls after submitted once
session_start();
$sessionid = session_id();
include('connection.php');
mysql_query("insert into Poll (Question, PollDate, latitude, longitude) values ('" . mysql_real_escape_string($_POST['question']) . "', now()," . replace_null($_SESSION['user_lat'], '0') . ", " . replace_null($_SESSION['user_long'], '0') . ")")
                        or die (mysql_error());
mysql_query("insert into Response (PollID, Number, Response) values (LAST_INSERT_ID(), 1, '" . mysql_real_escape_string($_POST['response1']) . "')")
                        or die (mysql_error());

mysql_query("insert into Response (PollID, Number, Response) values (LAST_INSERT_ID(), 2, '" . mysql_real_escape_string($_POST['response2']) . "')")
                        or die (mysql_error());
if ($_POST['response3']!=null){
    mysql_query("insert into Response (PollID, Number, Response) values (LAST_INSERT_ID(), 3, '" . mysql_real_escape_string($_POST['response3']) . "')")
                        or die (mysql_error());
}
mysql_query("insert User_Stroll (pollid, sessionid) values (LAST_INSERT_ID() , '$sessionid')")
                        or die (mysql_error());
header( 'Location: http://boilermake.cosmicshades.com' );
?>