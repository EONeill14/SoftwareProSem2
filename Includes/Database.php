<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "video_game_shop";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}