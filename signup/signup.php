<?php 
    session_start();
    if($_SESSION['status'] == 'true'){
        header('location: /programs/auth/index.html');
    }
    // require_once "/programs/auth/login.php";
    $con = new mysqli('localhost','root','','users',3306);

    if($con->errno){
        echo $con->error;
        die("Error connecting Database");
    }
    if(isset($_POST['fname'])
    && isset($_POST['lname'])
    && isset($_POST['email'])
    && isset($_POST['uname'])
    && isset($_POST['pass'])){
        signup_success($con);
        echo "Signup Succesful";
        // header('location: programs/sql-form/login-page.php');
    }else{
        echo "Signup unsuccesful";
        
    }
    function signup_success($con){
        $first = htmlspecialchars(get_post($con,'fname'));
        $last = htmlspecialchars(get_post($con,'lname'));
        $email = htmlspecialchars(get_post($con,'email'));
        $username = htmlspecialchars(get_post($con,'uname'));
        $pass = password_hash(get_post($con,'pass'),PASSWORD_DEFAULT);
        $sql = "INSERT INTO auth_info VALUES
        ('$username','$first','$last','$email','$pass')";
        $result = $con->query($sql);
    }
    // function form(){
    //     echo <<<_END
    //         <form method="post" action="signup.php">
    //         <div>
    //             First Name<input type="text" name="first_name" required>
    //         </div>
    //         <div>
    //             last Name<input type="text" name="last_name" required>
    //         </div>
    //         <div>
    //             email<input type="text" name="email" required>
    //         </div>
    //         <div>
    //             username<input type="text" name="username" required>
    //         </div>
    //         <div>
    //             password<input type="password" name="pass" required>
    //         </div>
    //         <div>
    //             <input type="submit">
    //         </div>   
    //     </form>  
    //     _END;

    //}
    function get_post($con,$var){
        return $con->real_escape_string($_POST[$var]);
    }
    $con->close();
// $fname = $_REQUEST['fname'];
// $lname = $_POST['lname'];
// $uname = $_POST['uname'];
// $email = $_POST['email'];
// $pass = $_POST['pass'];
// // echo "$fname, $lname, $uname,$email,$pass";
// $a = ['fname'=>$fname,'lname'=>$lname,'uname'=>$uname];
// echo json_encode($a);

?>
