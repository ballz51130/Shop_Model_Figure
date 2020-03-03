<?php 
include '../conn/conn.php';
$sqlsend = "UPDATE orders SET O_Status = 'รอการชำระ',Sn_id = '".$_POST['gender']."',Bk_id = '".$_POST['bank']."', O_Date = current_timestamp  WHERE O_ID = '".$_POST['O_ID']."'";
$query = mysqli_query($conn,$sqlsend);
if($query){
    echo "บันทึกสำเร็จ";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../user/Market.php'>";
}
else{
    echo "เกิดข้อผิดพลาด กรุณาติดต่อ Admin";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '3;URL=../user/Market.php'>";
}
?>