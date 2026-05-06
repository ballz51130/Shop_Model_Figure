<?php
include '../conn/conn.php';
$quantity = (int)$_POST['quantity'];
$o_id = (int)$_POST['O_ID'];
$sql = "UPDATE orderdetail SET OD_Unit='$quantity' WHERE O_ID = '$o_id'";
 $query = mysqli_query($conn,$sql);
 if ($query){
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
      echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
        
    }else{
      echo "<script type='text/javascript'>alert('ERROR');</script>";
      echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
    }


 
?>