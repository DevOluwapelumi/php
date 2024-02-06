<?php
require 'database_con.php';

if(isset($_POST['submit'])){
     print_r($_POST);

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $age=$_POST['age'];
    $address=$_POST['address'];

    $hashedpassword= password_hash($password, PASSWORD_DEFAULT);
    echo $hashedpassword;
    $runquery="INSERT INTO students(`firstname`, `lastname`, `email`, `password`, `age`, `address`) VALUES('$firstname', '$lastname', '$email', '$hashedpassword', '$age', '$address')";
    $querycon=$database_con->query($runquery);
    if($querycon){
        echo $querycon;
    } else {
        echo 'query not ran';
    }
} else {
    header('location:signup.html');
}
?>