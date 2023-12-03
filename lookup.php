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
            echo "Looking for " . $lastName . ", " . $firstName . "\n";
            $sql = "SELECT id, firstname, lastname from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";
            $result = $conn->query($sql);
            $personRow = $result->fetch_assoc();
            if($result->num_rows == 1){
                echo "Found: " . $personRow["lastname"] . ", " . $personRow["firstname"] . "\n";
                $sql = "SELECT * FROM shift where person = " . $personRow["id"];
                $result = $conn->query($sql);
                while($shiftRow = mysqli_fetch_array($result)) {
                    echo "Start Date: " . $shiftRow["start"] . "  End Date: " . $shiftRow["end"] . "\n"; 
                    //echo print_r($shiftRow);       // Print the entire row data
                }
            } else {
                echo "not found" . "\n";
            }
            $row++;
        }
        fclose($handle);
    }
}

?>