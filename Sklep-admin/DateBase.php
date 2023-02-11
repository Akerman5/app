<?php 
class DateBase{
  
function DoSQLCommand($sqlcommand)
{
    $conn = mysqli_connect("localhost", "user", "YES", "sklep");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlquery = $conn->query($sqlcommand);
    $conn->close();
        return $sqlquery;
}

}
?>