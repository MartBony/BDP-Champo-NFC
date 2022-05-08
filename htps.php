<?php
echo $_SERVER['HTTPS'];
echo $_SERVER['SERVER_NAME'];

if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") && $_SERVER['SERVER_NAME'] != "localhost") {
    echo $_SERVER['HTTPS'];
}

?>