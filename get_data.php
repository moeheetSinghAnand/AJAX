<?php
//include "dbconfig.php";

    // // INSERT data
    // if (isset($_POST['save'])) {
    //     $name = $_POST['name'];
    //     $grade = $_POST['grade'];
    //     $gender = $_POST['gender'];
    //     $dob = $_POST['dob'];
    //     $hobby = $_POST['dob'];
    //     $email = $_POST['email'];
    //     $hobbies = implode(",", $hobby); 
    //     $filename = '';
    //     if(isset($_FILES["picture"]["name"])) {
    //         $filename = $_FILES["picture"]["name"];
    //         $tempname = $_FILES["picture"]["tmp_name"];
    //         $folder = "assets/images/" . $filename;
    //     }
    //     $date = date('Y-m-d H:i:s');
    //     $insert = "INSERT INTO `students` (`name`, `grade`, `gender`, `dob`, `email`, `hobby`, `student_picture`, `created_at`) VALUES ('{$_POST['name']}', '{$_POST['grade']}', '{$_POST['gender']}', '{$_POST['dob']}', '{$_POST['email']}', '{$_POST['hobby']}', '{$_FILES['picture']['name']}', '$date')";

    //     $result = mysqli_query($conn, $insert);
    //     if ($result === TRUE) {
    //         echo " Record inserted successfully";
    //         if($filename !== ""){
    //             move_uploaded_file($tempname, $folder); 
    //         }
    //     } 
    //     else {
    //         echo "Error:" . $insert . "<br>" . $conn->error;
    //     }
    // }

    // fetch record
    // if (isset($_POST['fetch_row'])) {
    //     $id = $_POST['id'];
    //     $sql = "SELECT * FROM students WHERE id = '$id'";
    //     $query = mysqli_query($conn, $sql);
    //     $result = mysqli_fetch_assoc($query);
    //     echo json_encode($result);
    // }

    // update record
    // if (isset($_POST['update'])) {
    //     $id = $_POST['id'];
    //     $name = $_POST['name'];
    //     $grade = $_POST['grade'];
    //     $gender = $_POST['gender'];
    //     $dob = $_POST['dob'];
    //     $hobby = implode(",", $_POST['hobbies']);
    //     $email = $_POST['email'];
    //     $filename = $_FILES['picture']['name'];        
    //     $tempname = $_FILES['picture']['tmp_name'];    
    //     $folder = "assets/images/" . $filename;
    //     $update = "UPDATE `students` SET `name` = '$name', `gender` = '$gender', `hobby` = '$hobby', `grade` = '$grade', `dob` = '$dob', `email` = '$email' WHERE `id`= '$id'";
    //     $result = mysqli_query($conn, $update);
    //     if(isset($_FILES["picture"]["name"])) {
    //         $filename = $_FILES["picture"]["name"];
    //         $tempname = $_FILES["picture"]["tmp_name"];
    //         $folder = "assets/images/" . $filename;
    //      }

    //     if ($result === true) {
    //         if($filename != ""){
    //             $update_filename = "UPDATE `students` SET `student_picture` = '$filename' WHERE `id`= '$id'";
    //             if(mysqli_query($conn,$update_filename)){
    //                 move_uploaded_file($tempname, $folder);
    //             }
    //         }
    //         echo "Record Updated Succesfully";
    //     } 
    //     else {
    //         echo "failed to insert";
    //     }
    // }

    // // delete function
    // if (isset($_POST['delete'])) {
    //     $id = $_POST['id'];
    //     $delete = "DELETE FROM `students` where `id` = '$id'";
    //     $result = mysqli_query($conn, $delete);
    //     if ($result === true){
    //         echo "Record Deleted Successfully";
    //     }    
    //     else {
    //         echo "failed to delete";
    //     }
    // }

// get => not secure , it is visible on url
// post => secure 

        class Student {
            private $servername = "localhost";
            private $username = "root";
            private $password = "";
            private $dbname = "studentsdb";
            private static $instance = null;
            public $result;
            public $conn;
            public $date;
            public $folder;
            public $filename;
            public $foldername = './assets/images/';
            public $tempname;

            public static function getInstance() {
                if (self::$instance === null) {
                    self::$instance = new self();
                }
                return self::$instance;
            }

            private function __construct(){
                $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
                $this->date = date("Y-m-d H:i:s");
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
        

            // public function clean_data($data) {    
            //     $data = htmlspecialchars(trim($data));
            //     return $data;
            // }

            public function check_picture_input(){
                if(isset($_FILES["picture"]["name"])) {
                    $this->filename = $_FILES["picture"]["name"];
                    $this->tempname = $_FILES["picture"]["tmp_name"];
                    $this->folder = $this->foldername. $this->filename;
                } 
                else {
                    $this->filename = $this->tempname = $this->folder = "";
                }
            }
            public function check_success(){
                if ($this->result === TRUE) {
                    echo " Record inserted successfully";
                    if($this->filename !== ""){
                        move_uploaded_file($this->tempname, $this->folder); 
                    }
                } 
                else {
                    echo "Error:". $this->conn->error;
                }
            }
            public function insert(){
                echo("Check1");
                $hobby = implode(",", (array)$_POST['hobbies']);
                $this->check_picture_input();
                $picture = $this->filename !== "" ? $this->filename : null;
                $insert = "INSERT INTO `students` (`name`, `grade`, `gender`, `dob`, `email`, `hobby`, `student_picture`, `created_at`) VALUES ('{$_POST['name']}', '{$_POST['grade']}', '{$_POST['gender']}', '{$_POST['dob']}', '{$_POST['email']}', '$hobby', '$picture', '$this->date')";
                $this->result = mysqli_query($this->conn, $insert);
                $this->check_success();
            }
            public function update($id){
                $hobby = implode(",", (array)$_POST['hobbies']);
                $this->check_picture_input();
                $update = "UPDATE `students` SET `name` = '{$_POST['name']}', `gender` = '{$_POST['gender']}', `hobby` = '$hobby', `grade` = '{$_POST['grade']}', `dob` = '{$_POST['dob']}', `email` = '{$_POST['email']}', `student_picture` = '{$_FILES['picture']['name']}' WHERE `id`= '{$_POST['id']}'";
                var_dump($_FILES['picture']['name']);
                var_dump($_POST['gender']);
                $this->result = mysqli_query($this->conn, $update);
                $this->check_success();
            }
            public function delete($id){
                $delete = "DELETE FROM `students` where `id` = '$id'";
                $this->result = mysqli_query($this->conn, $delete);
                $this->check_success();
            }
            public function fetch_row($id){
                $fetch = "SELECT * FROM students WHERE id = '$id'";
                $query = mysqli_query($this->conn, $fetch);
                $this->result = mysqli_fetch_assoc($query);
                echo json_encode($this->result);
            }
            public function view(){
                $select = "SELECT * FROM students";
                $query = mysqli_query($this->conn, $select);
                return $query;
            }
        }

        $students = Student::getInstance();

        if (isset($_POST["save"])){
            $students->insert();       
        }
        if (isset($_POST["update"])){
            $students->update($_POST['id']);
        }      
        if (isset($_POST["delete"])) {
            $students->delete($_POST['id']);
        }
        if (isset($_POST["fetch_row"])){
            $students->fetch_row($_POST['id']);
        }
?>