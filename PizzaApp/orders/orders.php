<?php
    include '../connection/connection.php';

    if(empty($_SESSION['email']))
    {
        echo "<script>window.location.href='../index.php';</script>";
    }

    $bill=[];

    $sql="select * from bill";
    $query=mysqli_query($con,$sql);
    while ($row= mysqli_fetch_array($query,MYSQLI_ASSOC)) 
    {
        $bill[]=$row;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="http://localhost:81//PizzaApp/images/pizzaapp.png">
  <title>Orders</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
        .FixedHeightContainer
        {
        height: 680px;
        width:100%; 
        padding:3px; 
        background:rgb(36, 35, 35);
        color: #fff;
        }

        .Content
        {
        height: 90%;
        overflow:auto;
        }

        h5{
            width: 100%;
            text-align: center;
            padding: 1rem;
        }
  </style>
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
<div class="container-fluid">
    <br/>
    <div class="FixedHeightContainer">
        <h5>Customer Invioce Record</h5>
        <div class="Content">
        <section style="background:rgb(66, 65, 65); height:100%;">
        <div class="table-responsive text-nowrap">
            
            <table  id="table1" class="table table-bordered table-dark table-hover">
           
            <thead>
                <tr>
                <th>Invoice ID</th>
                <th>Cashier</th>
                <th>Product Name</th>
                <th>Product Price</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($bill as $billdetail): ?>
                    <tr>
                    <td style="width: 15%"><?php echo $billdetail['billid'] ?></td>
                    <td style="width: 25%"><?php echo $billdetail['username'] ?></td>
                    <td style="width: 35%"><?php echo $billdetail['productname'] ?></td>
                    <td style="width: 25%"><?php echo $billdetail['productprice'] ?></td>        
                    </tr>
                <?php endforeach ?>
            </tbody>
            
            </table>
           
        </div>
        </section>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>