<?php
if (!isset($_SESSION)) {
    session_start();
}

$production = false;  

if($production)
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'cashless_database';
}
else 
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'cashless_database';
}

$mysqli = new mysqli($host, $username, $password, $database) or die(mysqli_error($mysqli));

?>