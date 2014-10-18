<?php
/**
* replace things with { } curly brackets with the appropriate information
* including the curly brackets! don't leave those in there...
**/

//connect to the server
mysql_connect("localhost", "cosmics_bm", "5ron;[6IKmM.")
     or die ('cannot connect to database because ' . mysql_error());

//select the database you're going to use
mysql_select_db ("cosmics_bm")
     or die ('cannot select this database because ' .  mysql_error());

?>