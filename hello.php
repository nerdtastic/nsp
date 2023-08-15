<?php
$servername = "suchy.pdx1-mysql-a7-5b.dreamhost.com";
$username = "nerdtastic";
$password = "jL^CT@BCe3TCacpwfhE6NyBY";
$dbname = "cburg";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_errno()){
    die("Connect failed: %s\n" + mysqli_connect_error());
    exit();
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