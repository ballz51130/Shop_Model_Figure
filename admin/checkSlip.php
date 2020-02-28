<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
include '../conn/conn.php';
if ($_POST['cars'] == 'เตรียมจัดส่ง'){
    $sql ="UPDATE orders SET O_Status = '".$_POST['cars']."',O_Detail ='".$_POST['Note']."' WHERE O_ID ='".$_POST['O_ID']."'";
    $result = $conn->query($sql);
    $sql2 = "SELECT P_Unit FROM product where P_ID = '".$_POST['P_ID']."'";
    $query = $conn->query($sql2);
    $result2 = $query->fetch_assoc();
    $unit = $result2['P_Unit'] - $_POST['P_Unit'];
    $sql3 = "UPDATE product SET P_Unit =$unit WHERE P_ID='".$_POST['P_ID']."'";
    $result3 = $conn->query($sql3);
    if($query){
       if($result3){
        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
        
       } 
       else{
           echo "เกิดข้อผิดพลาดขึ้น";
       }
    }
    else{
        echo "เกิดข้อผิดพลาดขึ้น";
    }

}
if($_POST['cars'] == 'ปฏิเสธการชำระเงิน'){
    $sql ="UPDATE orders SET O_Status = '".$_POST['cars']."',O_Detail ='".$_POST['Note']."' WHERE O_ID ='".$_POST['O_ID']."'";
}
 ?>
</body>
</html>
