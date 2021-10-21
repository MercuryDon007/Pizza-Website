<?php
    include '../connection/connection.php';

    if(empty($_SESSION['email']))
    {
        echo "<script>window.location.href='../index.php';</script>";
    }

    $products=[];

    $sql="select * from products";
    $query=mysqli_query($con,$sql);
    while ($row= mysqli_fetch_array($query,MYSQLI_ASSOC)) 
    {
        $products[]=$row;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="http://localhost:81//PizzaApp/images/pizzaapp.png">
  <title>Prices</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background:rgb(49, 45, 45);">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="#" class="navbar-brand">
        <img src="../images/pizzaapp.png" height="28" alt="Pizza App">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../cashier/cashier.php" class="nav-item nav-link active">Cashier</a>
            <a href="../orders/orders.php" class="nav-item nav-link">Orders</a>
            <a href="../prices/prices.php" class="nav-item nav-link">Prices</a>
            <a href="../products/products.php" class="nav-item nav-link">Products</a>
            <a href="../sales/sales.php" class="nav-item nav-link">Sales</a>
            <a href="../users/users.php" class="nav-item nav-link">Users</a>
        </div>
        <div class="navbar-nav ml-auto">
            <a href="../logout/logout.php" class="nav-item nav-link">Logout ( logged in as <?php echo $_SESSION['username']?> )</a>
        </div>
    </div>
</nav>
<div style="margin-top:1rem;" class="container-fluid">
<div class="table-responsive text-nowrap">
       
        <table  id="table1" class="table table-bordered table-dark table-hover">
          
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Image</th>
            </tr>
          </thead>
          
          <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td style="width:30%;"><?php echo $product['productname'] ?></td>
                    <td style="width:30%;"><?php echo $product['productprice'] ?></td>
                    <td style="width:40%;text-align:center;"><img width="300px" src="../serverimages/<?php echo $product['productimage'] ?>"></td>
                </tr>
            <?php endforeach ?>
          </tbody>
          
        </table>
       
      </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>