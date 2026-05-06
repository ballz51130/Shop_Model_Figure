<?php 
include '../../conn/conn.php';
$p_unit = (int)$_POST['P_Unit'];
$p_id = (int)$_POST['P_ID'];
$sql = "UPDATE `product` SET `P_Unit`='$p_unit' WHERE P_ID='$p_id'";

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