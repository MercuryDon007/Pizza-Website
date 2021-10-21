<?php
    include '../connection/connection.php';

    if(empty($_SESSION['email']))
    {
        echo "<script>window.location.href='../index.php';</script>";
    }

    $products=[];
    $sql="select * from products";
	$query=mysqli_query($con,$sql);
	while ($row= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

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
  <title>Products</title>
  <link rel="stylesheet" href="../products/style/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
      body{
          color:#fff;
          background:rgb(36, 35, 35);
      }
  </style>
</head>
<body>
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
            <a href="../logout/logout.php" class="nav-item nav-link"> <img src="../images/user.png" width="30px" height="30px" class="rounded-circle" alt="Circular Image"> Logout ( logged in as <?php echo $_SESSION['username']?> )</a>
        </div>
    </div>
</nav>

<?php 

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (isset($_POST['insert'])) {

        $productname = $_POST['productname'];
        $productprice = $_POST['productprice'];
        $tmp_name = $_FILES['productimage']['tmp_name'];
        $org_name = $_FILES['productimage']['name'];

        move_uploaded_file($tmp_name, "../serverimages/".$org_name);

        $sql = "insert into products(username,email,productname,productprice,productimage) 
        VALUES ('".$username."','".$email."','".$productname."','".$productprice."','".$org_name."')";
        
        $query=mysqli_query($con,$sql);
        if($query){
            echo'<div class="alert alert-success alert-dismissible fade show">
            Product<strong> Registered </strong>successfully.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show">
                Error <strong> Registering </strong>Product.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
        }

    }

    if (isset($_GET['id'])) {

		$sql_delete = "delete from products where id = '" .$_GET['id']."'";
		$query_delete = mysqli_query($con,$sql_delete);

		if($query_delete){
			echo'<div class="alert alert-danger alert-dismissible fade show">
            Product<strong> Deleted </strong>successfully.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>';
		}
		else{
			echo mysqli_error($con);
		}
	}

?>
<br>
<div class="container-fluid">
    <form id="register" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="form-group">
                <label for="inputEmail">Product Name</label>
                <input id="nameofproduct" type="text" name="productname" class="form-control" id="inputEmail" placeholder="Product Name" required>
                <div class="invalid-feedback">Please enter a product name.</div>
        </div>
        <div class="form-group">
                <label for="inputEmail">Product Price</label>
                <input type="text" name="productprice" class="form-control" id="inputEmail" placeholder="Product Price" required>
                <div class="invalid-feedback">Please enter a product price.</div>
        </div>
        <div class="form-group">
                  Image : <input type="file" name="productimage" class="form-control" id="inputEmail" class="btn btn-primary" required> <br/>
                <div class="invalid-feedback">Please choose an Image.</div>
        </div>
            <button type="submit" name="insert" class="btn btn-danger btn-block">ADD PRODUCT</button>
    </form>
        <br><br>
        <h2 style="width:100%;text-align:center;">YOUR ITEMS COLLECTION LIST</h2>
        <br>
       
        <div class="table-responsive text-nowrap">

        <table  id="table1" class="table table-bordered table-dark table-hover">

          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Image</th>
              <th>Edit Product</th>
              <th>Delete Product</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td style="width:20%;"><?php echo $product['productname'] ?></td>
                    <td style="width:20%;"><?php echo $product['productprice'] ?></td>
                    <td style="width:20%;text-align:center;"><img width="300px" src="../serverimages/<?php echo $product['productimage'] ?>"></td>
                    <td style="width:20%;"><a class="btn btn-danger btn-block" href="editproduct.php?edit=<?php echo $product['id'] ?>">EDIT PRODUCT</a></td>
                    <td style="width:20%;"><a class="btn btn-danger btn-block" href="?id=<?php echo $product['id'] ?>">DELETE PRODUCT</a></td>
                </tr>
            <?php endforeach ?>
          </tbody>
       
        </table>

        </div>
        <br><br><br>

</div>
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../login/login.js"></script>
</body>
</html>