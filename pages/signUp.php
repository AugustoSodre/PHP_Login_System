<?php
    session_start();
    //Preparing SQL
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Getting the parameters from POST method
        $username =  htmlspecialchars($_POST['username']) ;
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['pwd']);

        if ($username == ""){
            echo "You must have a Username!";
        } else if ($email == ""){
            echo "You must insert an Email!";
        } else if ($pwd == ""){
            echo "You must insert a Password!";
        } else if (substr_compare($pwd, $username,0, strlen($pwd)) == 0){
            echo "The Username and Password have to be different!";
        } else if (substr_compare($pwd, $email,0, strlen($pwd)) == 0){
            echo "The Email and Password have to be different!";
        } 
        else{
            $pwd = password_hash($pwd, PASSWORD_BCRYPT);

            try {
                //Connecting to the DB
                require_once ("../includes/dbhandler.inc.php");

                //SQL Query
                $query = "INSERT INTO users(email, pwd, username) VALUE(?, ?, ?);";

                //Preparing to launch it to the DB safely
                $statement = $pdo->prepare($query);

                //Putting the treated variables into the placeholders
                $statement->execute([$email, $pwd, $username]);

                $query = null;
                $statement = null;

                header("Location: http://localhost:801/login_signup_system/");

                exit();

            } catch (Exception $e) {
                echo "Querry failed:" . $e->getMessage();
            }
        }

        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="../style/signUpStyle.css">
</head>
<body>
    <h2>Let's Sign Up!</h2>
    <form action="signUp.php" method="post">
        <label for="Username:">Username:</label>
        <input type="text" name="username" placeholder="Username">
        <br>
        <label for="Email:">Email:</label>
        <input type="text" name="email" placeholder="example@gmail.com">
        <br>
        <label for="Password:">Password:</label>
        <input type="password" name="pwd" placeholder="Password">
        <br>
        <button>Sign Up!</button>
    </form>
</body>
</html>


    