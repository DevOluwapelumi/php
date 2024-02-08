<?php
require 'database_con.php';
session_start();
if(isset($_POST['submit'])){
    //print_r($_POST); // Comment out or remove this line for production

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    // Check if any of the required fields are empty
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($age) || empty($address)){
        $_SESSION['message'] = 'Please fill in all fields';
       header('Location: signup.php');
        exit(); // Stop the script from running further
    }

    $query = "SELECT * FROM students WHERE email = '$email'";
    $connection = $database_con->query($query);

    if($connection->num_rows > 0){
        $_SESSION['message'] = 'Email already exists';
        header('Location: signup.php');
    } else {
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        //echo $hashedpassword; // Comment out or remove this line for production
        $runquery = "INSERT INTO students(`firstname`, `lastname`, `email`, `password`, `age`, `address`) VALUES('$firstname', '$lastname', '$email', '$hashedpassword', '$age', '$address')";
        $querycon = $database_con->query($runquery);

        if($querycon){
            header('Location: signin.php');
        } else {
            $_SESSION['message'] = 'Unsuccessful Registration';
            header('Location: signup.php');
        }
    }
} else {
    header('Location: signup.php');
}
?>
