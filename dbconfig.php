<?php                                 // For connecting to Databases
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentsdb";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // print_r($conn->connect_error);

?>
