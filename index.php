<?php
    session_start();
    if (!isset($_SESSION["email"])){
        $_SESSION['email'] = null;
    }
    if (!isset($_SESSION['username'])){
        $_SESSION['username'] = null;
    }

    if (!isset($_SESSION['isLogged'])){
        $_SESSION['isLogged'] = null;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['email'] = null;
        $_SESSION['username'] = null;
        $_SESSION['isLogged'] = null;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/indexStyle.css">
</head>

<body>

<header>
    <h1>My Website</h1>
    
    <?php if ($_SESSION['isLogged']) : ?>
        <h2>Welcome, <?php echo $_SESSION['username'] . "!"?></h2>
    <?php endif; ?>
</header>

<main>
    <?php if ($_SESSION['isLogged']) : ?>
        <section class="welcome-section">
            <h2>You're Logged In!</h2>
            <p>Welcome to the members' area. Here you can explore exclusive content and features available only to registered users.</p>

            <form action="index.php" method="post">
                <button class="btnLogout">Logout</button>
            </form>
        </section>
    <?php else : ?>
        <section class="intro-section">
            <h2>Hello! What do you want to do?</h2>
            <p>Please sign up or log in to access our exclusive content and features.</p>

            <div class="btnDiv">   
                <form action="pages/signUp.php">
                    <button class="btnSignUp">SignUp</button>
                </form>

                <form action="pages/login.php">
                    <button class="btnLogin">Login</button>
                </form>
            </div>
        </section>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2024 My Website. All rights reserved.</p>
</footer>

</body>
</html>
