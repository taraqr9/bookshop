<?php
include("init.php");

$delete = $_GET['delete'];
$query = $source->Query("DELETE FROM `book` where id=?",[$_GET['delete']]);
if($query){
    $_SESSION['deletepo'] = "Deleted Successfully";
    header("location:mypost.php");
}else{
    $_SESSION['delete'] = "Failed To Delete";
    header("location:mypost.php");
}
?>