<?php
session_start();

if (isset($_SESSION["email"]) && $_SESSION["username"]){
    header("Location: http://localhost:801/login_signup_system");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = htmlspecialchars($_POST["email"]);
    $possiblePassword = htmlspecialchars($_POST["pwd"]);


    try{
        //Connecting to DB
        require_once '../includes/dbhandler.inc.php';

        $query = 'SELECT username, pwd FROM users WHERE email = ?;';

        $statement = $pdo->prepare($query);

        $statement->execute([$email]);

        $result = $statement->fetchAll();

        $query = null;
        $statement = null;

        if (!empty($result)) {
            if (password_verify($possiblePassword, $result[0]['pwd'])){
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $result[0]['username'];
                $_SESSION['isLogged'] = true;
                header("Location: http://localhost:801/login_signup_system");
                exit();
            } else {
                echo "Incorrect password!";
            }
        } else{
            echo "Incorrect Email or Password!";
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/loginStyle.css">
</head>
<body>
    <h2>Login!</h2>

    <form action="login.php" method="post">
        <label for="Email">Email:</label>
        <input type="text" name="email" placeholder="example@gmail.com">
        <br>
        <label for="Password">Password:</label>
        <input type="password" name="pwd" placeholder="Password">
        <br>
        <button>Login</button>
    </form>
</body>
</html>