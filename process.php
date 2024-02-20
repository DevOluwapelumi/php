<?php
session_start();
require 'database_con.php';


if(isset($_POST['submit'])){
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

    $name=$_FILES['profile_pic']['name'];
    $temp=$_FILES['profile_pic']['tmp_name'];
    $newname=time().$name;
    
    $move_image=move_uploaded_file($temp, 'images/'.$newname);
    if($move_image){
            echo 'Uploaded Succesfully';
             $updateprofile = "UPDATE `students` SET `profile_pic` = '$newname' WHERE id = $userid";
            $setprofile = $database_con->query($updateprofile);
            if($setprofile){
                header('location:dashboard.php');
        } else {
            echo 'failed';
        }
    } else {
        echo 'failed';
    }
    }
    }
?>

