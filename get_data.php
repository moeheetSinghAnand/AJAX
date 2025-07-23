<?php
include "dbconfig.php";
if (isset($_POST['save'])) {
    //$id = $_POST['id'];
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    //$hobby = $_POST['hobbies'];
    $email = $_POST['email'];
    //$hobbies = implode(",", $hobby); 
    
    /*$filename = $_FILES["picture"]["name"];
        $tempname = $_FILES["picture"]["tmp_name"];
        $folder = "./image/" . $filename;
        $date = date('Y-m-d');
    */
    $insert = "INSERT INTO `students` (`name`, `grade`, `gender`, `dob`,`email`)  VALUES ('$name', '$grade', '$gender', '$dob', '$email')";
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
    if (isset($_POST['fetch_row'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM students WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
        // echo json_encode($result);
        echo json_encode($result);
    }

// get => not secure , it is visible on url
// post => secure 

?>