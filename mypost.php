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
  <title>Create Event</title>
  <meta name="viewpost" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/createevent.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">


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
  <!-- view events -->
  <div class="container-fluid">
    <div class="container">
      <table class="table table-hover">
        <thead>
          <tr>

            <th class="col-1">Book Name</th>
            <th class="col-1">Author</th>
            <th class="col-1">Publisher</th>
            <th class="col-1">Price</th>
            <th class="col-1">Name</th>
            <th class="col-1">Address</th>
            <th class="col-1">Mobile</th>
            <th class="col-1">Email</th>
            <th class="col-1">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = $source->Query("SELECT * FROM `book` WHERE uid = ? ORDER BY id DESC", [$_SESSION['id']]);
          $details = $source->FetchAll();
          $numrow = $source->CountRows();
          if ($numrow > 0) {
            foreach ($details as $row) :

              if ($row->status === 'Pending') {
                $app = "<a href='deletemypost.php?delete=".$row->id ."' class='btn btn-outline-dark mt-2'> Delete</a>";
                $approval_text = "class = text-warning";
              } else {
                $app = "";
                $approval_text = "class = text-success";
              }

              echo "
                <tr>
                
                <td>" . $row->bname . "</td>
                <td>" . $row->author . "</td>
                <td>" . $row->publisher . "</td>
                <td>" . $row->price . "</td>
                <td>" . $row->name . "</td>
                <td>" . $row->address . "</td>
                <td>" . $row->phone . "</td>
                <td>" . $row->email . "</td>
                <td " . $approval_text . ">" . $row->status . "</td>
                <td>" . $app . " </td>
                </tr>";

            endforeach;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>