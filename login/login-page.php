<?php
    // require_once 'login.php';
    $con = new mysqli('localhost','root','','users',3306);

    if($con->errno){
        echo $con->error;
        die("Cannot connect to database");
    }
    if(@$_SESSION['status'] == 'true'){
        header('location: /programs/auth/index.html');
        // echo "<button><a href='forms.php'>Continue to Database</button>";
        // echo "<button><a href='logout.php'>Click here to logout</button>";
        // echo "<button onclick='log_out()'>Click here to logout</button>";
    }
    elseif(isset($_POST['login'])
    && isset($_POST['password'])){
        $email = get_post($con,'login');
        $pass = get_post($con,'password');
        $sql = "SELECT * FROM auth_info WHERE username = '$email' OR email = '$email'";
        try{
        $result = $con->query($sql);
        $res = $result->fetch_row();
        if(!$res){
            throw new Exception("Wrong USername and password");
        }
        }catch(Exception $e){
            die("Wrong Username/email");
            // form();
            
        }
        if(password_verify($pass,$res[4])){
            session_start();
            $_SESSION['status'] = 'true'; 
            // $stop = log_out();
            // echo "Login Succesful <br>";
            // echo "<button><a href='forms.php'>Continue to Database</button>";
            // echo "<br>";
            // echo "<button><a href='logout.php'>Click here to logout</button>";
            // header('location: /programs/sql-form/forms.php');
            echo "Login Succesful";
        }else{
            echo "Wrong Password/email";
            // form();
        }
    }else{
        echo "invalid";
    }


    // function form(){
    //     echo <<<_END
    //     <form method="post" action="login-page.php">
    //     <div>
    //         username/email<input type="text" name="login">
    //     </div>
    //     <div>
    //         password<input type="password" name="password">
    //     </div>
    //     <div>
    //         <input type="submit" value="LOG IN">
    //     </div>
    //     </form>
    //     _END;
    //     echo '<br>';
    //     echo '<button><a href="signup,php">Click here to signup</button>';
    // }
    function get_post($con,$var){
        return $con->real_escape_string($_POST[$var]);
    }
   $con->close();
// $uname = $_REQUEST['login'];
// $pass = $_POST['password'];
// echo $uname.' '.$pass;
?>