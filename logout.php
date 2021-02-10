<?php
session_start();
session_destroy();
if(isset($_SESSION['login_success'])){
    unset($_SESSION['login_success']);
}
header("location:index.php");
?>