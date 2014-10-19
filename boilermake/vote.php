<?php
//Lock users from editing their polls after submitted once
session_start();
include('connection.php');
mysql_query("insert into Poll (Question, PollDate, latitude, longitude) values ('" . mysql_real_escape_string($_POST['question']) . "', now()," . $_SESSION['user_long'] . ", " . $_SESSION['user_lat'] . ");")
                        or die (mysql_error());
//mysql_query()
//insert into Response (PollID, Response, Count) values (16, 'Test me2', 1+1);

header( 'Location: http://boilermake.cosmicshades.com/index.php' );
?>