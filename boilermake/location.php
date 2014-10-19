<?php
session_start();
if (isset($_GET['user_long'])){
    $_SESSION['user_long'] = $_GET['user_long'];
    $_SESSION['user_lat'] = $_GET['user_lat'];
}
header( 'Location: http://boilermake.cosmicshades.com' ) ;
?>