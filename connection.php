<?php

$servername = "suchy.pdx1-mysql-a7-5b.dreamhost.com";
$username = "nerdtastic";
$password = "jL^CT@BCe3TCacpwfhE6NyBY";
$dbname = "cburg";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_errno()){
    die("Connect failed: %s\n" + mysqli_connect_error());
    exit();
}

echo "connected to the thing" . "\n";

?>