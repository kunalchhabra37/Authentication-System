<?php
    session_start();
    if($_SESSION['status'] != 'true'){
        header('location: /programs/auth/index.html');
    }
    log_out();
 function log_out(){
    $_SESSION = "false"; 
    session_unset();
    @session_destroy();
    setcookie(session_name(), '', time() - 2592000, '/');
    echo "Logout <br>";
    // echo "<button><a href='login-page.php'>Click here to login</button>";
}