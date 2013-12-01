<?php
$mysqli = new mysqli("localhost", "root", "root", "project2");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>