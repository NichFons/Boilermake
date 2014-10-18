<?php

// set cookie for a day
if (isset($_GET['long'])){
    $_SESSION['user_long'] = $_GET['user_long'];
    $_SESSION['user_lat'] = $_GET['user_lat'];
}
else{
    $_SESSION['user_long'] = 0;
    $_SESSION['user_lat'] = 0;
}
?>