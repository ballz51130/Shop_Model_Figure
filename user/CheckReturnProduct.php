<?php 
include '../conn/conn.php';
session_start();
$image1 = $_FILES['image1']['name'];
$image2 = $_FILES['image2']['name'];
$image3 = $_FILES['image3']['name'];
$target1 = "../photo/ReProduct/".basename($image1);
$target2 = "../photo/ReProduct/".basename($image2);
$target3 = "../photo/ReProduct/".basename($image3);
    $sql = "INSERT INTO returnorder(O_ID, Re_feedback, Re_Detail, Re_Status, Re_NameBank, Re_NumberBank, Re_Date) VALUES ('".$_POST['O_ID']."','".$_POST['Re_feedback']."','".$_POST['Re_Detail']."','รอตรวจสอบ(สินค้า)','".$_POST['Re_NameBank']."','".$_POST['Re_NumberBank']."',NOW())";
    $query = mysqli_query($conn,$sql);
    $lest = $conn -> insert_id;
    $sql2 ="INSERT INTO returnorderdetail(O_ID, P1, P2, P3) VALUES ('".$_POST['O_ID']."','$image1','$image2','$image3')";
    $query2 = mysqli_query($conn,$sql2);
    $sql3 = "UPDATE orders SET O_Status='รอตรวจสอบ(สินค้า)' WHERE O_ID='".$_POST['O_ID']."'";
    $query3 = mysqli_query($conn,$sql3);
   move_uploaded_file($_FILES['image1']['tmp_name'], $target1);
   move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
    move_uploaded_file($_FILES['image3']['tmp_name'], $target3);


if($query){
    if($query2){
        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Market.php'>";
    
    }
    else{
        echo '<script type="text/javascript">alert("บันทึกไม่สำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Market.php'>";
    }
}
else{
    echo '<script type="text/javascript">alert("บันทึกไม่สำเร็จ");</script>';
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./Market.php'>";
}

?>