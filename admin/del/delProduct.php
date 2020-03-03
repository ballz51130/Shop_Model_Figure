<?php 
include '../conn/conn.php';
$ID = $_GET['ID'];
 $sql ="DELETE FROM product WHERE P_ID = ".$ID;
 $query = mysqli_query($conn,$sql);
 if($query){
     echo "ลบข้อมูลสำเร็จ";
     echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
 }
 else{
     echo "เกิดข้อผิดพลาด กรุณาตรวจสอบ";
     echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
 }

?>