<?php

require 'connection.php';

$row = 1;
// $result = $conn->query($sql);

// echo $result->num_rows . "\n";

/*
0: startDate
1: startTime
2: stopDate
3: stopTime
4: firstName
5: lastName
*/
$directory = "timecards/22_23/";

$files = array_diff(scandir($directory), array('.','..'));
foreach($files as $file){
    if (($handle = fopen($directory . $file, "r")) !== FALSE) {
        echo "--------------------" . $file . "\n";
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $startDate = strtotime($data[0] . $data[1]);
            $stopDate = strtotime($data[2] . $data[3]);
            $firstName = mysqli_real_escape_string($conn, $data[4]);
            $lastName = mysqli_real_escape_string($conn, $data[5]);
            if($startDate){
                $sql = "SELECT id from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    if($stopDate){
                        //echo "do the thing for row: " . $row . "\n";
                    } else {
                        echo "missing stop date on row: " . $row . ":" . $file . "\n";
                    }
                } else {
                    echo $result->num_rows . " rows for " . $lastName . ", " . $firstName . ". File: " . $file . "\n";
                }
            } else {
                //echo "skipping row:" . $row . "\n";
            }
            $row++;
        }
        fclose($handle);
    }
}

?>