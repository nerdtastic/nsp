<?php

include_once 'connection.php';

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
if (($handle = fopen("timecard_1_22.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $startDate = strtotime($data[0] . $data[1]);
        $stopDate = strtotime($data[2] . $data[3]);
        $firstName = $data[4];
        $lastName = $data[5];
        if($startDate){
            $sql = "SELECT id from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                if($stopDate){
                    echo "do the thing for row: " . $row . "\n";
                } else {
                    echo "missing stop date on row: " . $row . "\n";
                }
            } else {
                echo $result->num_rows . " rows for " . $lastName . ", " . $firstName;
            }
        } else {
            //echo "skipping row:" . $row . "\n";
        }
        $row++;
    }
    fclose($handle);
}
?>