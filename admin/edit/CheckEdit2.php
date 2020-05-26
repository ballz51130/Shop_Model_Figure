<?php 
include '../../conn/conn.php';
$sql = "UPDATE `product` SET `P_Unit`='".$_POST['P_Unit']."' WHERE P_ID='".$_POST['P_ID']."'";

$query = mysqli_query($conn,$sql);
if($query){
    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ../MainProduct.php'>";
    
}
else{
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาด");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ../MainProduct.php'>";
}

?>