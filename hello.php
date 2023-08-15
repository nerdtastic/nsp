<?php
$row = 1;
if (($handle = fopen("timecard_1_22.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        $startDate = strtotime($data[0] . $data[1]);
        echo "raw:" . $data[0];
        echo date('d/M/Y h:i:s', $startDate) . "\n";
        for ($c=0; $c < $num; $c++) {
            
            // echo $data[$c] . "\n";
        }
    }
    fclose($handle);
}
?>