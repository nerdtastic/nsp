<?php
$servername = "cburg.dreamhost.com";
$username = "nerdtastic";
$password = "jL^CT@BCe3TCacpwfhE6NyBY";

$conn = new mysqli($servername, $username, $password);
if($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "connected to the thing";

$row = 1;
if (($handle = fopen("timecard_1_22.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        $startDate = strtotime($data[0] . $data[1]);
        if($startDate){
            echo date('d/M/Y h:i:s', $startDate) . "\n";
        }
        
        for ($c=0; $c < $num; $c++) {
            
            // echo $data[$c] . "\n";
        }
    }
    fclose($handle);
}
?>