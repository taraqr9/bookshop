<?php include "init.php";
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
    $query = $source->Query("SELECT * FROM book WHERE id=?", [$_GET['clicked']]);
    $product = $source->SingleRow();
    $uid = $product->uid;
    $row = $source->CountRows();
}

?>

<html>
<title>Home</title>

<head>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/productdetails.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

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
    <!-- After bought product msg -->
    <div class="text-success">
        <!-- <?php

                if (!empty($_SESSION['shopdone'])) {
                    echo $_SESSION['shopdone'];
                    $_SESSION['shopdone'] = "";
                }
                ?> -->
    </div>


    <!-- Product -->
    <div class="container mt-5">
        <div class="bg-light row">
            <div class="col-4">
                <img src="assets/img/defaultimg.png" class="col-12 mt-4" />
            </div>
            <div class="col-4">
                <?php
                if ($row > 0) {
                    echo
                        "
			<p class='mt-3'> Name : " . $product->bname . "</p>
			<hr class = 'col-12'>
            <p> Author : " . $product->author . " Tk</p>
            <hr class = 'col-12'>
            <p> Publisher : " . $product->publisher . " Tk</p>
            <hr class = 'col-12'>
            <p> Price : " . $product->price . " Tk</p>
            <hr class = 'col-12'>
            <div class='row mb-5'>
			<hr>
            <div class='row mt-5'>";

            if($uid !== $_SESSION['id']){
                echo "
                <a href='buy.php?clicked=" . $product->id . "' class='btn btn-outline-success'>Buy Now</a>
                <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-primary ml-2'>Add To Cart</a>";
            }
            if($uid == $_SESSION['id']){
                echo "<p class='text-danger h5'> You can not place order your own book.</p>";
            }
           echo "
            </div>
            </div> 
            </div>


            <div class='col-3 mt-4 ml-5'>
                <p class='text-success'>Cash On Delivery</p>
                <p class='text-success'>7 Days Happy Return</p>
                <p class='text-success'>Delivery Charge Tk. 50(Online Order)</p>
                <p class='text-success'>Purchase & Earn</p>
            </div>
            
            

            ";
                    if (!empty($product->description)) {
                        echo " <div class='container bg-light text-justify card mt-5'>
                <h2 class='mt-3'> Summury Of Story : <br> </h2>
                <h5 class='mt-3 mb-3'>" . $product->description . "</h5>
                </div>";
                    }
                    if ($product->oldbook == '1') {
                        echo " <div class='container bg-light text-justify card mt-5'>
                <h4 class='mt-3 text-primary'> After Placing Order You Will Get Seller Contact Number <br> </h4>
                
                </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php 
    $query = $source->Query("SELECT * FROM book Limit 5");
    $products = $source->FetchAll();
    $row = $source->CountRows();
    $i = 0;
    if($row>0){
        foreach($products as $product):
            if(empty($product->uid)){
                echo   "<div class='bookdetails1 col-sm-4 col-md-4 col-lg-2'>
                <div class='bookdetails card'>
                     <img class='card-img-top m-auto' src='assets/img/defaultimg.png'>
                     <div class='card-body'>
                         <p class='card-title'>".$product->bname."</p>
                         <hr>
                         <p class='card-text'>".$product->price." Tk</p>
                         <hr>
                         <a href='productdetails.php?clicked=".$product->id."' class='btn btn-outline-success m-auto'>See Details</a>
                     </div>
                 </div>
             </div>";
            }
        
            
            endforeach;
        }
?>
</body>

</html>