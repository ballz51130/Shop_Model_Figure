
<?php 
session_start();
include '../conn/conn.php';
$sql = "SELECT * FROM orders ORDER BY C_ID DESC LIMIT 1";
    $query = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($query);
    $lest = $result['C_ID']+1;
for($i = 0; $i < count($_POST['check']); $i++){
    $num = $_POST['check'][$i];
$sqlsend = "UPDATE orders SET O_Status = 'รอการชำระ',Sn_id = '".$_POST['gender']."',Bk_id = '".$_POST['bank']."',C_ID='".$lest."' WHERE O_ID = '$num'";
$query = mysqli_query($conn,$sqlsend);
}
if($query){
    echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../user/payment.php'>";
}
else{
    echo "<script type='text/javascript'>alert('Error');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../user/Market.php'>";
}
?>