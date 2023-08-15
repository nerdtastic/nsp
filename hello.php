<?php

include_once 'connection.php';

$row = 1;

$sql = "SELECT id, firstname, lastname from person";
$result = $conn->query($sql);

echo $result->num_rows . "\n";


if (($handle = fopen("timecard_1_22.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        $startDate = strtotime($data[0] . $data[1]);
        if($startDate){
            //echo date('d/M/Y h:i:s', $startDate) . "\n";
        }
        
        for ($c=0; $c < $num; $c++) {
            
            // echo $data[$c] . "\n";
        }
    }
    fclose($handle);
}
?>