<?php

require 'connection.php';


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
$sql = "SELECT * from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";



$files = array_diff(scandir($directory), array('.','..'));
foreach($files as $file){
    if (($handle = fopen($directory . $file, "r")) !== FALSE) {
        echo "--------------------" . $file . "\n";
        $row = 1;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $startDate = strtotime($data[0] . $data[1]);
            $stopDate = strtotime($data[2] . $data[3]);
            $firstName = mysqli_real_escape_string($conn, $data[4]);
            $lastName = mysqli_real_escape_string($conn, $data[5]);
            if($startDate){
                $sql = "SELECT id from person where lower(firstname) = lower('" . $firstName . "') and lower(lastname) = lower('" . $lastName . "')";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $queryRow = $result->fetch_assoc();
                    if($stopDate){
                        $sql = "INSERT INTO shift (start, end, person ) values ( FROM_UNIXTIME(" . $startDate . "), FROM_UNIXTIME(" . $stopDate . ")," . $queryRow["id"] . ")";
                        echo $sql. "\n";
                        $conn->query($sql);
                    } else {
                        echo "missing stop date on row: " . $row . ":" . $file . "\n";
                    }
                } else if ($result->num_rows == 0){
                    //echo $lastName . ", " . $firstName . ". Not Found" . "\n";
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