<?php
include("init.php");
$check = $source->Query("SELECT * FROM `order` where oid=?", [$_GET['delete']]);
$details = $source->SingleRow();
$bookid = $details->bid;
$numrow = $source->CountRows();
if ($numrow > 0) {
    if (!empty($details->sid)) {
        
        if ($source->Query("UPDATE book set status = 'Pending' where id = ?", [$bookid])) {
            if ($source->Query("DELETE FROM `order` where oid=?", [$_GET['delete']])) {
                $_SESSION['delete'] = "Order Deleted Successfully";
                header("location:order.php");
                }
        } else {
            $_SESSION['delete'] = "Failed To Delete";
            header("location:order.php");
        }
    }else{
        if($source->Query("DELETE FROM `order` where oid=?", [$_GET['delete']])){
            $_SESSION['delete'] = "Order Deleted Successfully";
            header("location:order.php");
        }else{
            $_SESSION['delete'] = "Failed To Delete";
            header("location:order.php");z
        }
        
        
    }

}



// $query = $source->Query("DELETE FROM `order` where oid=?", [$_GET['delete']]);
// if ($query) {
//     $_SESSION['delete'] = "Order Deleted Successfully";
//     header("location:order.php");
// } else {
//     $_SESSION['delete'] = "Failed To Delete";
//     header("location:order.php");
// }
