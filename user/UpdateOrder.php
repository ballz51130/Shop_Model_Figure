<?php
include '../conn/conn.php';
$sql = "UPDATE orderdetail SET OD_Unit='".$_POST['quantity']."' WHERE O_ID = '".$_POST['O_ID']."'";
 $query = mysqli_query($conn,$sql);
 if ($query){
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
      echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
        
    }else{
      echo "<script type='text/javascript'>alert('ERROR');</script>";
      echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./Market.php'>";
    }


 
?>