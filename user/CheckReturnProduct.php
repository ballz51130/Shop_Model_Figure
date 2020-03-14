<?php 
include '../conn/conn.php';
session_start();
$image1 = $_FILES['image1']['name'];
$image2 = $_FILES['image2']['name'];
$image3 = $_FILES['image3']['name'];
echo $image1;
echo $image2;
echo $image3;
$target1 = "../photo/ReProduct/".basename($image1);
$target2 = "../photo/ReProduct/".basename($image2);
$target3 = "../photo/ReProduct/".basename($image3);
for($i = 0; $i < count($_POST['check']); $i++){
    $num = $_POST['check'][$i];
    $sql = "INSERT INTO returnorder(U_ID,O_ID, Re_feedback, Re_Detail, Re_Status, Re_NameBank, Re_NumberBank, Re_Date) VALUES ('".$_SESSION['User']."','$num','".$_POST['Re_feedback']."','".$_POST['Re_Detail']."','รอตรวจสอบการคืน','".$_POST['Re_NameBank']."','".$_POST['Re_NumberBank']."',NOW())";
    $query = mysqli_query($conn,$sql);
    $lest = $conn -> insert_id;
    $sql2 ="INSERT INTO returnorderdetail(O_ID, P1, P2, P3) VALUES ('$num','$image1','$image2','$image3')";
    $query2 = mysqli_query($conn,$sql2);
    move_uploaded_file($_FILES['image1']['tmp_name'], $target1);
    move_uploaded_file($_FILES['image2']['tmp_name'], $target2);
    move_uploaded_file($_FILES['image3']['tmp_name'], $target3);

}
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