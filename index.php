<?php 
    require('connection.php'); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginStyles.css">
    <title>User - login and signup</title>
</head>
<body>
    <header>
        <div class="header-content">
            <h6 class="animated-text">SignUp/Login Form</h6>
        </div>
        <center>
        <nav>
            <a href="#" class="neon-btn"><center>Home</center></a>
            <a href="#" class="neon-btn"><center>Blog</center></a>
            <a href="#" class="neon-btn"><center>Contact</center></a>
            <a href="#" class="neon-btn"><center>About</center></a>
        </nav>
        </center>
        <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
            {
                echo "
                <div class='dropdown'>
                    <button class='dropbtn'>$_SESSION[username]</button>
                    <div class='dropdown-content'>
                        <a href='#'>Profile</a>
                        <a href='#'>Settings</a>
                        <a href='logout.php'>Logout</a>
                    </div>
                </div>";
            }
            else{
                echo "
                    <div class='sign-in-up'>
                        <button type='button' onclick=\"popup('login-popup')\">Login</button>
                        <button type='button' onclick=\"popup('register-popup')\">Sign Up</button>
                    </div>
                ";
            }
        ?>
    </header>
    <div class="popup-container" id="login-popup">
        <div class="popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>User Login</span>
                    <button type="reset" onclick="popup('login-popup')">x</button>
                </h2>
                <input type="text" placeholder="E-mail or Username" name="email_username">
                <input type="password" placeholder="Password" name="password">
                <p>New user? <a href="#" onclick="popup('register-popup')">Signup</a> here</p>
                <button type="submit" class="login-btn" name="login">Login</button>
                
            </form>
        </div>
    </div>


    <div class="popup-container" id="register-popup">
        <div class="register popup">
            <form method="POST" action="login_register.php">
                <h2>
                    <span>User Register</span>
                    <button type="reset" onclick="popup('register-popup')">x</button>
                </h2>
                <input type="text" placeholder="Full Name" name="full_name">
                <input type="text" placeholder="Username" name="username">
                <input type="email" placeholder="E-mail" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="register-btn" name="register">Sign up</button>
            </form>
        </div>
    </div>

    <?php
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
        {
            echo "<h2 style='text-align: center; margin-top: 200px;'>
                Welcome to this website - $_SESSION[username]
            </h2>";
        }
    ?>
    <script>
        function popup(popup_name) {
            var get_popup = document.getElementById(popup_name);
            if (get_popup.style.display === "flex") {
                get_popup.style.display = "none";
            } else {
                get_popup.style.display = "flex";
            }
        }
    </script>
</body>
</html>
