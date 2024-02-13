<?php
require 'database_con.php';
// session_start();
print_r($_POST);

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query="SELECT * FROM students WHERE email = '$email'";
    $connect=$database_con->query($query);

    if($connect->num_rows>0){
        $user = $connect->fetch_assoc();
        if($password === $user['password']){
            echo 'Login successful';
            header('Location: dashboard.php');
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'Email does not exist';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
/>
    <title>Student Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            width: 400px;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 15px;
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
            /* Container styling */
        .message-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        /* Message styling */
        .session-message {
            padding: 10px 20px;
            background-color: #ffdddd; /* Light red background */
            border: 1px solid #ffcccc; /* Slightly darker red border */
            color: #d8000c; /* Dark red text */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
            font-size: 16px; /* Adjust as needed */
            width: auto; /* Adjust based on your design */
            max-width: 80%; /* Ensures it doesn't stretch too wide */
            text-align: center; /* Center the text */
            transition: opacity 0.5s ease-in-out;
        }

        /* Optional: Animation for the appearance of the message */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .session-message {
            animation: fadeIn 0.5s ease-in-out;
        }

    </style>
    
</head>
<body>

<div class="container border shadow-lg">
    <h2 class="text-center">Student Signin Form</h2><hr>
    <div class="message-container">
    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<div class="session-message text-center text-danger">' . $_SESSION['message'] . '</div>';
    }
    session_unset();
    ?>
</div>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" >

        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" > <hr>

        <button type="submit" class="btn btn-dark" name="submit">Signin</button>
    </form>
</div>

</body>
</html>
