<?php
$config['base_url'] = 'http://localhost/inventori/public/';

$username = "root";
$password = "";
$database = "inventori";
$hostname = "localhost";
$con = mysqli_connect($hostname, $username, $password, $database) or die("Connection Corrupt");
