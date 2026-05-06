<?php 
include '../conn/conn.php';
session_start();
$image1 = $_FILES['image1']['name'];
$image2 = $_FILES['image2']['name'];
$image3 = $_FILES['image3']['name'];
$target1 = "../photo/ReProduct/".basename($image1);
$target2 = "../photo/ReProduct/".basename($image2);
$target3 = "../photo/ReProduct/".basename($image3);
$o_id = (int)$_POST['O_ID'];
$re_feedback = mysqli_real_escape_string($conn, $_POST['Re_feedback']);
$re_detail = mysqli_real_escape_string($conn, $_POST['Re_Detail']);
$re_namebank = mysqli_real_escape_string($conn, $_POST['Re_NameBank']);
$re_numberbank = mysqli_real_escape_string($conn, $_POST['Re_NumberBank']);
    $sql = "INSERT INTO returnorder(O_ID, Re_feedback, Re_Detail, Re_Status, Re_NameBank, Re_NumberBank, Re_Date) VALUES ('$o_id','$re_feedback','$re_detail','รอตรวจสอบ(สินค้า)','$re_namebank','$re_numberbank',NOW())";
    $query = mysqli_query($conn,$sql);
    $lest = $conn -> insert_id;
    $sql2 ="INSERT INTO returnorderdetail(O_ID, P1, P2, P3) VALUES ('$o_id','$image1','$image2','$image3')";
    $query2 = mysqli_query($conn,$sql2);
    $sql3 = "UPDATE orders SET O_Status='รอตรวจสอบ(สินค้า)' WHERE O_ID='$o_id'";
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