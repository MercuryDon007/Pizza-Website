<?php

    include '../connection/connection.php';

    $requestPayload = file_get_contents("php://input");
    $object = json_decode($requestPayload, true);

    $serialized = serialize($object);
    $array = unserialize($serialized);

 
    $end = end($object);
    $invoiceid = $end['invoiceid'];
    $totalprice = $end['total'];
    $totalqty = $end['totalqty'];
    $time = $end['time'];
    $username = $_SESSION['username'];

    $count = count($object)-1;
    $i = $count;

    $Products = $object;
    $ProductName = array_column($Products, 'ProductName');
    $ProductPrice= array_column($Products, 'ProductPrice');

    foreach($object as $objects) {

      $sql = "insert into bill(billid,username,productname,productprice) 
      VALUES ('".$invoiceid."','".$username."','".$objects['ProductName']."','".$objects['ProductPrice']."') ";
      
      $query=mysqli_query($con,$sql);

    } 

    if($query){
      echo 'success';
       $sql = "Delete from bill where productname = '' ";

       $query=mysqli_query($con,$sql);

          if($query){
            echo "success removing null row";

            $current_date = date("Y/m/d");
            date_default_timezone_set('Asia/karachi');
            $current_time = date('h:i:s');

            $sql = "insert into bill_total(billid,totalqty,totalprice,date_time,time,date) 
            VALUES ('".$invoiceid."','".$totalqty."','".$totalprice."','".$time."','".$current_time."','".$current_date."') ";
            
            $query=mysqli_query($con,$sql);

                  if($query){

                    echo "new table record insert";
                    header("location: cashier.php");
                  }else{
                    echo mysqli_error($con);
                    
                      }
            
          }else{
          echo mysqli_error($con);
          
            }
      
    }else{
      echo mysqli_error($con);
      
        }
      
?>