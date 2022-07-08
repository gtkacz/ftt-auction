<?php

require_once("../../vendor/autoload.php");
session_start();

if (isset($_SESSION["username"])) {
    session_unset();
    session_destroy();
}
header('location: log-in');
exit;