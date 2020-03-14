<?php 
include '../conn/conn.php';
session_start();
if ($_POST['cars'] == 'ยืนยันการชำระเงิน'){
    for($i = 0; $i < count($_POST['check']); $i++){
        $num = $_POST['check'][$i];
        $product = $_POST['product'][$i];
        $unit = $_POST['unit'][$i];
        //Update order
    $sql ="UPDATE orders SET O_Status = '".$_POST['cars']."',O_Detail ='".$_POST['Note']."',ManageBy='".$_SESSION['User']."' WHERE O_ID ='".$num."'";
    $result = $conn->query($sql);
    // //Select  ID stock
    // $sql2 = "SELECT P_Unit FROM product where P_ID = '".$product."'";
    // $query = $conn->query($sql2);
    // $result2 = $query->fetch_assoc();
    // // Update Stock
    // $unit = $result2['P_Unit'] - $unit;
    // $sql3 = "UPDATE product SET P_Unit =$unit WHERE P_ID='".$product."'";
    // $result3 = $conn->query($sql3);
    } // for loop

    if($result){
       
        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
    }
       else{
        echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
       }
    
}
if($_POST['cars'] == 'ปฏิเสธการชำระเงิน'){
    for($i = 0; $i < count($_POST['check']); $i++){
        $num = $_POST['check'][$i];
        $product = $_POST['product'][$i];
        $unit = $_POST['unit'][$i];
        $sql ="UPDATE orders SET O_Status = '".$_POST['cars']."',O_Detail ='".$_POST['Note']."' WHERE O_ID ='$num'";
        $query = $conn->query($sql);
        $sql2 = "SELECT P_Unit FROM product where P_ID = '".$product."'";
        $query = $conn->query($sql2);
        $result2 = $query->fetch_assoc();
        // Update Stock
        $unit = $result2['P_Unit'] + $unit;
        $sql3 = "UPDATE product SET P_Unit =$unit WHERE P_ID='".$product."'";
        $result3 = $conn->query($sql3);

    }
    if($query){
         echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
         echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
         
        } 
        else{
            echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Mainadmin.php'>";
        }

}
 ?>
