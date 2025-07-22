<?php
include "dbconfig.php";
if (isset($_POST['save'])) {
    //$id = $_POST['id'];
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $hobby = $_POST['hobbies'];
    $email = $_POST['email'];
    $hobbies = implode(",", $hobby); 
    
    /*$filename = $_FILES["picture"]["name"];
        $tempname = $_FILES["picture"]["tmp_name"];
        $folder = "./image/" . $filename;
        $date = date('Y-m-d');
    */
    
    echo $insert = "INSERT INTO `students` (`name`, `grade`, `gender`, `dob`, `hobby`, `email`)  VALUES ('$name', '$grade', '$gender', '$dob', '$hobbies', '$email')";
    $result = mysqli_query($conn, $insert); 
    
    if ($result === TRUE){
        echo " Record inserted successfully";
       /* if ($filename != "") {
            move_uploaded_file($tempname, $folder);
        }*/
    } 
    else {
        echo "Error:" . $insert . "<br>" . $conn->error;  
    } 
    
}
// get => not secure , it is visible on url
// post => secure 
?>