<?php

//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn = new PDO("sqlsrv:Server= DESKTOP-OESJB7N\SQLEXPRESS;Database=MOENational", "sa", "na1234");


$AppCatID = $_POST["AppCatID"];
$option = null;

// echo "<script>alert('".$AppCat."')</script>";
$sql = "SELECT * FROM CD_AppSubjects WHERE Category = '$AppCatID'";
foreach ($conn->query($sql) as $row) {
    $option .= "<option value=" . $row['ID'] . ">" . $row['SubjectName'] . "</option>";
}

echo json_encode($option);
?>