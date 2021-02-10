<?php include "init.php"; ?>
<?php
if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
if (isset($_POST['home'])) {
    header("location:home.php");
}
if (isset($_POST['sellbook'])) {
    header("location:sellbook.php");
}
if (isset($_POST['aboutus'])) {
    header("location:aboutus.php");
}
if (isset($_POST['order'])) {
    header("location:order.php");
}
if (empty($_SESSION['login_success'])) {
    header("location:index.php");
}
?>


<?php

if (!empty($_GET['clicked'])) {
    if ($source->Query("SELECT * FROM book WHERE id=?", [$_GET['clicked']])) {
        $row = $source->SingleRow();
        $sellerid = $row->uid;
        $oldbook = $row->oldbook;
        $bname = $row->bname;
        $price = $row->price;
        $author = $row->author;
        $publisher = $row->publisher;
        $bookid = $_GET['clicked'];
    }
}
?>

<?php
// checking user details
if (isset($_POST['proceed'])) {
    $status = "Pending";
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ];

    if($oldbook == '1'){
        if ($source->Query("INSERT INTO `order` (`uid`, `bid`,`sid`,`bname`, `author`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$_SESSION['id'],$bookid,$sellerid, $bname, $author, $price, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {
            if($source->Query("UPDATE book SET status = 'Approved' where id = ?",[$_GET['clicked']])){
                $_SESSION['shoping'] = "Order Placed";
                header("location:order.php");
            }
            
        } else {
            $_SESSION['shoping'] = "Something Went Wrong";
        }
    }else{
        if ($source->Query("INSERT INTO `order` (`uid`, `bname`, `author`, `price`, `name`, `email`, `phone`, `address`, `status`) VALUES (?,?,?,?,?,?,?,?,?)", [$_SESSION['id'], $bname, $author, $price, $data['name'], $data['email'], $data['phone'], $data['address'], $status])) {
            $_SESSION['shoping'] = "<p class='text-white bg-success'>Order Placed</p>";
            header("location:order.php");
        } else {
            $_SESSION['shoping'] = "Something Went Wrong";
        }
    }
    
}
?>
<html>

<head>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="assets/css/buy.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid sticky-top">
        <div class="row bg-light">
            <h1 class="text-primary col-6 text-center">Book Saler</h1>
            <div class="col-6 text-center ml-auto mt-2">

                <form action="" method="POST">
                    <input type="submit" value="Home" name="home" class="btn btn-outline-primary mr-2">

                    <input type="submit" value="Sell Book" name="sellbook" class="btn btn-outline-primary mr-2">

                    <input type="submit" value="Old Books" name="oldbook" class="btn btn-outline-primary mr-2">

                    <input type="submit" value="Order" name="order" class="btn btn-outline-primary mr-2">

                    <input type="submit" value="My Post" name="mypost" class="btn btn-outline-primary mr-2">

                    <a href="logout.php" class="btn btn-outline-primary mr-2">Logout</a>
                </form>

            </div>
        </div>
    </div>

    <!-- show product -->
    <form action="" method="POST">
        <div class="container mt-2">
            <div class="row bg-light">
                <div class="col-4 m-auto">
                    <img src="assets/img/defaultimg.png" class="col-12 mt-4" />
                </div>
                <div class="col-6 ml-auto mt-5">
                    <p><b>Name</b> : <?php echo $bname; ?></p>
                    <p><b>Price</b> : <?php echo $price . " TK"; ?></p>
                    <p><b>Author</b> : <?php echo $author; ?></p>
                    <p><b>Publisher</b> : <?php echo $publisher; ?></p>
                    <hr class="bg-primary">
                </div>

            </div>

            <!-- User Address -->


            <div class="entertaiment mt-5">
                <input type="text" name="name" class="form-control col-5" placeholder="Name" required>
                <input type="email" name="email" class="form-control col-5 mt-2" placeholder="Email" required>
                <input type="phone" name="phone" class="form-control col-5 mt-2" placeholder="Phone Number" required>
                <input type="text" name="address" class="form-control col-5 mt-2" placeholder="Address" required>
                <div class="row container m-center mt-5">
                    <p><input type="checkbox" checked> Cash On Delivery</p>
                </div>
                <hr class="bg-success">
            </div>

<?php 
    if($sellerid !== $_SESSION['id']){
        echo " 
        <div class='mr-auto mt-5'>
                <a href='order.php' style='text-decoration:none; color: black; '>
                    <input type='submit' name='proceed' value='Proceed To Buy' class='btn btn-outline-success col-2'>
                </a>
            </div>
        ";
    }
?>
            

    </form>

    </div>





</body>

</html>