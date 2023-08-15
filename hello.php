<?php

include_once 'connection.php';

$row = 1;


$result = $conn->query($sql);

echo $result->num_rows . "\n";

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
        $num = count($data);
        $row++;
        $startDate = strtotime($data[0] . $data[1]);
        $stopDate = strtotime($data[2] . $data[3]);
        $firstName = $data[4];
        $lastName = $data[5];
        $sql = "SELECT id, firstname, lastname from person where lower(firstname) = lower('$firstname') and lower(lastname) = lower('$lastname')";
        $result = $conn->query($sql);
        echo $result->num_rows . "\n";
        if(!$startDate){
            //echo "Missing startDate on row:" . $row "\n";
        }
        if(!$stopDate){
            //echo "Missing endDate on row:" . $row "\n";
        }
    }
    fclose($handle);
}
?>