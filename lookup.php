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
            $sql = "SELECT id, firstname, lastname from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";
            $result = $conn->query($sql);
            $queryRow = $result->fetch_assoc();
            echo "looking for: " . $queryRow["lastname"] . ", " . $queryRow["firstname"] . "\n";

            // $sql = "SELECT * FROM shift where person = " . $queryRow["id"];
            // $result = $conn->query($sql);

            // while($row = mysqli_fetch_array($result)) {
            //     echo print_r($row);       // Print the entire row data
            // }

            $row++;
        }
        fclose($handle);
    }
}

?>