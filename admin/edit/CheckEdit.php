<?php 
include '../../conn/conn.php';
// img != "" 
if($_FILES['image']['name'] !="")
{
    $image = $_FILES['image']['name'];
    //Get text
    $image_text = mysqli_real_escape_string($conn, $_POST['P_Detel']);
    // image file directory
    $target = "../../photo/Order/".basename($image);
    $sql = "UPDATE `product` SET `P_Number`='".$_POST['P_Number']."',`P_Name`='".$_POST['P_Name']."',`P_Price`='".$_POST['P_Price']."',`P_Detel`='".$_POST['P_Detel']."',`P_Unit`='".$_POST['P_Unit']."',`P_Status`='".$_POST['P_Status']."',`P_Group`='".$_POST['P_Group']."',`P_Photo`='$image' WHERE P_ID='".$_POST['P_ID']."'";
$query = mysqli_query($conn,$sql);
if($query){
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL= ./MainProduct.php'>";
          
      }else{
            echo "ERROR it Not Update ";
           }   
}
else{
    echo '<script type="text/javascript">alert("เกิดข้อผิดพลาด");</script>';
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
}
}
// img = ""
else{ 
$sql = "UPDATE `product` SET `P_Number`='".$_POST['P_Number']."',`P_Name`='".$_POST['P_Name']."',`P_Price`='".$_POST['P_Price']."',`P_Detel`='".$_POST['P_Detel']."',`P_Unit`='".$_POST['P_Unit']."',`P_Status`='".$_POST['P_Status']."',`P_Group`='".$_POST['P_Group']."' WHERE P_ID='".$_POST['P_ID']."'";
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