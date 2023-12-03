<?php

require 'connection.php';


/*
0: firstname
1: lastname
*/
$directory = "files/patrol/2324/";
$files = array_diff(scandir($directory), array('.','..'));
foreach($files as $file){
    if (($handle = fopen($directory . $file, "r")) !== FALSE) {
        $row = 1;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $firstName = mysqli_real_escape_string($conn, $data[0]);
            $lastName = mysqli_real_escape_string($conn, $data[1]);
            echo $firstName;
            $sql = "SELECT * FROM shift where person = ( SELECT id from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "') )";
            $result = $conn->query($sql);

            while($row = mysql_fetch_array($result)) {
                echo print_r($row);       // Print the entire row data
            }

            $row++;
        }
        fclose($handle);
    }
}

?>