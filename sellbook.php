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

if (isset($_POST['post'])) {
    $status = 'Pending';
    $oldbook = '1';
    $data = [
        'bname' => $_POST['bname'],
        'author' => $_POST['author'],
        'publisher' => $_POST['publisher'],
        'price' => $_POST['price'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'uid' => $_SESSION['id']
    ];

    if ($source->Query("INSERT INTO `book` (`uid`, `bname`, `author`,`publisher`, `price`, `name`, `email`, `phone`, `address`, `oldbook`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)", [$_SESSION['id'], $data['bname'], $data['author'], $data['publisher'],$data['price'], $data['name'], $data['email'], $data['phone'], $data['address'],$oldbook, $status])) {
        $_SESSION['shoping'] = "<p class='container text-success'>Nice work dude, Check your post on My Post Tab </p>";
    } else {
        $_SESSION['shoping'] = "Something Went Wrong";
    }
}
?>

<html>

<head>
    <title>Home</title>
    <meta name="viewpost" content="width=device-width, initial-scale=1.0">

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
<div>
    <?php
    if(!empty($_SESSION['shoping'])){
        echo $_SESSION['shoping'];
        $_SESSION['shoping'] = '';
    }
    ?>
</div>

    <h1 class="container text-success">Sell Your Books</h1>
    <hr class="container" />
    <form method="post">
        <div class="container bg-light mt-5">
            <input type="text" name="bname" class="form-control col-5" placeholder="Book Name" required />
            <input type="text" name="author" class="form-control col-5 mt-2" placeholder="Author Name" required />
            <input type="text" name="publisher" class="form-control col-5 mt-2" placeholder="Publisher" required />
            <input type="text" name="price" class="form-control col-5 mt-2" placeholder="Price" required />

            <input type="text" name="name" class="form-control col-5 mt-2" placeholder="Name" required />
            <input type="email" name="email" class="form-control col-5 mt-2" placeholder="Email" required />
            <input type="phone" name="phone" class="form-control col-5 mt-2" placeholder="Phone Number" required />
            <input type="text" name="address" class="form-control col-5 mt-2" placeholder="Address" required />
            <hr class="bg-light" />
            <div class="mt-5">
                <a href="#" style="text-decoration:none; color: black; ">
                    <input type="submit" name="post" value="Post" class="btn btn-outline-success col-2 mb-5">
                </a>
            </div>
    </form>
    </div>
</body>

</html>