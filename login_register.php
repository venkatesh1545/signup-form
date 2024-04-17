<?php
    require('connection.php');
    session_start();
    # For login purpose
    if(isset($_POST['login'])){
        $email_username = $_POST['email_username'];
        $query = "SELECT * FROM registered_users WHERE email = '$email_username' OR username = '$email_username'";
        $result = mysqli_query($con, $query);
        if($result){
            if(mysqli_num_rows($result) == 1){
                $result_fetch = mysqli_fetch_assoc($result);
                if(password_verify($_POST['password'], $result_fetch['password']))
                {
                    # If password matched, redirect to the home page
                    $_SESSION['logged_in']=true;
                    $_SESSION['username'] = $result_fetch['username'];
                    header("location: login.php");
                    /*
                    echo "<script>alert('You are logged in successfully');</script>";
                    echo "<script>window.location.href = 'login.php';</script>";
                    */
                }
                else{
                    # If password is incorrect, show an error message and redirect to the login page
                    echo "<script>alert('Incorrect password');</script>";
                    echo "<script>window.location.href = 'login.php';</script>";
                }
            }
            else {
                # If no matching user found, show an error message and redirect to the login page
                echo "<script>alert('Incorrect email or username');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
            }
        }
        else {
            # If query execution fails, show an error message and redirect to the login page
            echo "<script>alert('Cannot Run Query');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    }


    # For registration purpose
    if(isset($_POST['register'])){
        $user_exist_query = "SELECT * FROM registered_users WHERE username = '{$_POST['username']}' OR email = '{$_POST['email']}'";
        $result = mysqli_query($con, $user_exist_query);

        if($result){
            if(mysqli_num_rows($result) > 0) {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['username'] == $_POST['username']){
                    echo "
                        <script>
                            alert('$result_fetch[username] - Username already taken');
                            window.location.href = 'login.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('$result_fetch[email] - E-mail already registered');
                            window.location.href = 'login.php';
                        </script>
                    ";
                }
            } else {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $query = "INSERT INTO registered_users (full_name, username, email, password) VALUES ('$_POST[full_name]','$_POST[username]','$_POST[email]','$password')";
                if(mysqli_query($con, $query)){
                    echo "
                        <script>
                            alert('Registration successfully completed');
                            window.location.href = 'login.php';
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Cannot Run Query');
                            window.location.href = 'login.php';
                        </script>
                    ";
                }
            }
        } else {
            echo "
                <script>
                    alert('Cannot Run Query');
                    window.location.href = 'login.php';
                </script>
            ";
        }
    }
?>
