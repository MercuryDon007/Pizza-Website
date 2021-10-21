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

    $sql2 = "select billid from bill ORDER by billid DESC LIMIT 1";
    $query2=mysqli_query($con,$sql2);

    while ($row2= mysqli_fetch_array($query2,MYSQLI_ASSOC)) 
    {
        $invoiceid[]=$row2;
        foreach($invoiceid as $invoiceid){
            if(empty($invoiceid)){
                $invoiceid = 1;
            }else{
                $invoiceid =  $invoiceid['billid']+1;
            }
            
        }
    }

    $sql3="select * from products";
    $query3=mysqli_query($con,$sql3);
    while ($row3= mysqli_fetch_array($query3,MYSQLI_ASSOC)) 
    {
        $productslist[]=$row3;

        foreach($productslist as $productslist2){
            $productslist2;
        }
    }

    if(isset($_POST['search'])){

        $searchtext = $_POST['searchtext'];
        $products=[];
        $sql="select * from products where productname = '".$searchtext."' ";
        $query=mysqli_query($con,$sql);
        while ($row= mysqli_fetch_array($query,MYSQLI_ASSOC)) 
        {
            $products[]=$row;
            foreach($products as $product){
                //echo $product['productname'];
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="http://localhost:81//PizzaApp/images/pizzaapp.png">
  <title>Cashier</title>
  <link rel="stylesheet" href="../cashier/style/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    form {
        width:100%;
        outline: 0;
        float: left;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }
  
    form > .textbox {
        outline: 0;
        height: 42px;
        width: 90%;
        line-height: 42px;
        padding: 0 16px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #212121;
        border: 0;
        float: left;
        -webkit-border-radius: 4px 0 0 4px;
        border-radius: 4px 0 0 4px;
    }

    form > .textbox:focus {
        outline: 0;
        background-color: #FFF;
    }

    form > .button {
        outline: 0;
        background: none;
        background-color: rgba(38, 50, 56, 0.8);
        float: left;
        height: 42px;
        width:10%;
        text-align: center;
        line-height: 42px;
        border: 0;
        color: #FFF;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: 16px;
        text-rendering: auto;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        -webkit-transition: background-color .4s ease;
        transition: background-color .4s ease;
        -webkit-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
    }

    form > .button:hover {
        background-color: rgba(0, 150, 136, 0.8);
    }

    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
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
<br>
<div style="width:100%;text-align:center;display: flex;flex-direction: column;justify-content: top;align-items: center;display: flex;flex-direction: column;justify-content: top;align-items: center;" class="refresh">
    
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="searchtext" class="textbox" placeholder="Search">
        <input title="Search" value="" type="submit" name="search" class="button">
    </form>
</div>
<br/>
<div class="FixedHeightContainer">
    <h5>Listed products for sale</h5>
    <div class="Content">
    <section style="background:rgb(66, 65, 65); height:100%;">
    <div class="table-responsive text-nowrap">
        <!--Table-->
        <table  id="table1" class="table table-bordered table-dark table-hover">
          <!--Table head-->
          <thead>
            <tr>
              <th style="text-align:center;">Select Product</th>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Image</th>
              <th>User Uploaded</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                <td><input type="checkbox" name="check-tab1"></td>
                <td id="name" style="width: 30%"><?php echo $product['productname'] ?></td>
                <td id="price" style="width: 20%"><?php echo $product['productprice'] ?></td>
                <td style="width: 20%"><img src="../serverimages/<?php echo $product['productimage'] ?>" style="width:30%;" ></td>
                <td style="width: 20%"><?php echo $product['username'] ?></td>
                </tr>
            <?php endforeach ?>
          </tbody>
         
        </table>
        
      </div>
    </section>
    </div>
    </div>
    <br/>
        <div class="buttons">
            <button class="btn btn-danger btn-block" onclick="tab1_To_tab2();">ADD</button>
            <button class="btn btn-danger btn-block" onclick="tab2_To_tab1();">REMOVE</button>
        </div>
    <br/>
    <div class="FixedHeightContainer">
    <h5>Order products list</h5>
    <div class="Content">
    <section style="background:rgb(66, 65, 65); height:100%;">
    <div class="table-responsive text-nowrap">
            
            <table id="table2" class="table table-bordered table-dark table-hover">
            
            <thead>
                <tr>
                    <th>Select Product</th>
                    <th>ProductName</th>
                    <th>ProductPrice</th>
                    <th>User Uploaded</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                 
                <?php endforeach ?>
            </tbody>
           
            </table>
         
        </div>
    </section>
    </div>
    </div>     
    <div class="button">
        <br>
            <button class="btn btn-danger btn-block" onclick="billheight();">BILL</button>
        <br>
    </div>
    <div id='BillViewer' style="display: none;flex-direction: column;justify-content: top;align-items: center;background:#ccc;">
    <div id='Bill' style="width:400px;background:#fff;margin:1rem 0rem 1rem 0rem;" class="FixedHeightContainer2">
        <h4 style="width:100%;text-align:center; margin-top:4rem;">PIZZA APP</h4>
        <h4 style="width:100%;text-align:center;">Bill Reciept</h4>
        <br>
        <strong>
            <p style="width:100%;text-align:center;">
                Address : Lane 15, 3rd Cross
            </p>
            <p style="width:100%;text-align:center;">
                Website : www.pizzaapp.com
            </p>
            <p style="width:100%;text-align:center;">
                Contact : 012345
            </p>
        </strong>
        <strong style="margin:0.8rem;">Invoice ID : <span name="invoiceid" id="invoiceid"><?php echo $invoiceid ?></span></strong><br>
        <strong style="margin:0.8rem;">Cashier : </strong><strong id="name2"><?php echo $_SESSION['username']?> </strong><br>
        <strong style="margin:0.8rem;">Date & Time : <span name="time" id="time"></span></strong><br>
        <br>
        <div class="Content2">
                <div id="box" style="border:none;">
                    <div class="table-responsive text-nowrap">

                    </div>
                </div>
        </div>
        <br>
            <strong style="float:right; margin-right:2rem;">Total Quantity -<span name="qty" id="totalqty"></span></strong><br><br>
            <strong style="float:right; margin-right:2rem;">Total Price -<span name="price" id="total"></strong></span><br><br>
            <strong>
            <br>
            <br>
    </div>
    </div>
    <br>
    <div class="button">
        <br>
            <button class="btn btn-danger btn-block" onclick="printDiv('Bill');">PRINT</button>
            <br>
            <button class="btn btn-danger btn-block" name="save" id="save" onclick="save()">DONE</button>
        <br>
    </div>
    <br>
    
</div>
    <!-- -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <!-- -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../cashier/js/cashier.js"></script>
    <script langauge="JavaScript">

        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        function refresh(){
            window.location.reload();
        }
    </script>
    
</body>
</html>