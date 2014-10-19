<?php

// set cookie for a day
if (isset($_GET['user_long'])){
    $_SESSION['user_long'] = $_GET['user_long'];
    $_SESSION['user_lat'] = $_GET['user_lat'];
}
else if (!isset($_SESSION['user_long'])){
    $_SESSION['user_long'] = 0;
    $_SESSION['user_lat'] = 0;
}
echo $_SESSION['user_long'] . $_SESSION['user_lat']; ?>