<?php
$serverName = "DESKTOP-L8I7S0M";
$connectionInfo = array( "Database"=>"MOENational", "UID"=>"sa", "PWD"=>"sa1234");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true ));
    // echo "<script LANGUAGE='JavaScript'>window.alert('Nope');</script>";
}
else{
    // echo "<script LANGUAGE='JavaScript'>window.alert('Succesfully Connected');</script>";
}

?>