<?php 
include '../../conn/conn.php';
// img != "" 
if($_FILES['image']['name'] !="")
{
    $image = $_FILES['image']['name'];
    //Get text
    $image_text = mysqli_real_escape_string($conn, $_POST['P_Detel']);
    $p_number = mysqli_real_escape_string($conn, $_POST['P_Number']);
    $p_name = mysqli_real_escape_string($conn, $_POST['P_Name']);
    $p_price = mysqli_real_escape_string($conn, $_POST['P_Price']);
    $p_pricebye = mysqli_real_escape_string($conn, $_POST['P_Pricebye']);
    $p_unit = mysqli_real_escape_string($conn, $_POST['P_Unit']);
    $p_status = mysqli_real_escape_string($conn, $_POST['P_Status']);
    $p_group = mysqli_real_escape_string($conn, $_POST['P_Group']);
    $p_id = (int)$_POST['P_ID'];
    // image file directory
    $target = "../../photo/Order/".basename($image);
    $sql = "UPDATE `product` SET `P_Number`='$p_number',`P_Name`='$p_name',`P_Price`='$p_price',`P_Purchaseprice`='$p_pricebye',`P_Detel`='$image_text',`P_Unit`='$p_unit',`P_Status`='$p_status',`P_Group`='$p_group',`P_Photo`='$image' WHERE P_ID='$p_id'";
    $query = mysqli_query($conn,$sql);
if($query){
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./MainProduct.php'>";
          
      }else{
        echo '<script type="text/javascript">alert("เกิดข้อผิดพลาด");</script>';
        echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ../MainProduct.php'>";
           }   
}
else{
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาด");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
}
}
// img = ""
else{ 
$sql = "UPDATE `product` SET `P_Number`='$p_number',`P_Name`='$p_name',`P_Price`='$p_price',`P_Purchaseprice`='$p_pricebye',`P_Detel`='$image_text',`P_Unit`='$p_unit',`P_Status`='$p_status',`P_Group`='$p_group' WHERE P_ID='$p_id'";

$query = mysqli_query($conn,$sql);
if($query){
    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ../MainProduct.php'>";
    
}
else{
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาด");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ../MainProduct.php'>";
}
}
?>