<?php
//Lock users from editing their polls after submitted once
session_start();
include('connection.php');
mysql_query("UPDATE response SET count = count + 1 WHERE Response = " . $_POST['vote'] )
                        or die (mysql_error());

header( 'Location: http://boilermake.cosmicshades.com/index.php' );
?>