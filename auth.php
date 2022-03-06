<?php
    session_start();
    if(isset($_SESSION['status'])){
        print_r($_SESSION['status']);
    }else{
        echo "Not Set";
    }
?>