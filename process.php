<?php
session_start();
require 'database_con.php';


echo $_SESSION['userid'];
$userid=$_SESSION['userid'];
if(isset($_POST['submit'])){
    $name=$_FILES['image']['name'];
    $temp=$_FILES['image']['tmp_name'];
    $newname=time().$name;
    $move_image=move_uploaded_file($temp, 'images/'.$newname);
    if($move_image){
        $query="UPDATE students SET profile_pic = '$newname' WHERE id=$id";
        $con=$databae_con->query($query);
        if($con){
            echo 'Uploaded Succesfully';
        } else {
            echo 'failed';
        }
    } else {
        echo 'failed';
    }
} 
?>

