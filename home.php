<?php
include "init.php";

if (isset($_POST['home'])) {
    header("location:home.php");
}
if (isset($_POST['oldbook'])) {
    header("location:oldbook.php");
}
if (isset($_POST['sellbook'])) {
    header("location:sellbook.php");
}
if (isset($_POST['mypost'])) {
    header("location:mypost.php");
}
if (isset($_POST['order'])) {
    header("location:order.php");
}
if (empty($_SESSION['login_success'])) {
    header("location:index.php");
}
?>

<html>

<head>
    <title>Home</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/home.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">


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

    <div class='row container-fluid mt-5'>
        <?php
        $query = $source->Query("SELECT * FROM book");
        $products = $source->FetchAll();
        $row = $source->CountRows();
        $i = 0;
        if ($row > 0) {
            foreach ($products as $product) :
                if (empty($product->uid)) {
                    echo   "<div class='bookdetails1 col-sm-10 col-md-6 col-lg-2'>
                <div class='bookdetails card'>
                     <img class='card-img-top m-auto' src='assets/img/defaultimg.png'>
                     <div class='card-body'>
                         <p class='card-title'>" . $product->bname . "</p>
                         <hr>
                         <p class='card-text'>" . $product->price . " Tk</p>
                         <hr>
                         <a href='productdetails.php?clicked=" . $product->id . "' class='btn btn-outline-success m-auto'>See Details</a>
                     </div>
                 </div>
             </div>";
                }


            endforeach;
        }
        ?>


</body>

</html>