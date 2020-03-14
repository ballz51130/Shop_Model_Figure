<?php 
include '../conn/conn.php';
for($i = 0; $i < count($_POST['O_ID']); $i++){
    $O_ID = $_POST['O_ID'][$i];
$sql = "UPDATE orders SET O_Status='จัดส่งแล้ว',O_EMS='".$_POST['EMS']."' WHERE O_ID = '$O_ID'";
$query = mysqli_query($conn,$sql);
}
if($query){
     echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
     echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
     
    } 
    else
    {
     echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
     echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
    }

?>