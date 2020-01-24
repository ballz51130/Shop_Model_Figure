<?php 
include '../conn/conn.php';
$sql = "UPDATE `product` SET `P_Number`='".$_POST['P_Number']."',`P_Name`='".$_POST['P_Name']."',`P_Price`='".$_POST['P_Price']."',`P_Detel`='".$_POST['P_Detel']."',`P_Unit`='".$_POST['P_Unit']."',`P_Status`='".$_POST['P_Status']."',`P_Group`='".$_POST['P_Group']."' WHERE P_ID='".$_POST['P_ID']."'";
echo $sql;
$query = mysqli_query($conn,$sql);
if($query){
    echo "บันทึกสำเร็จ";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
    
}
else{
    echo "ERROR it Not Update ";
    echo "<META HTTP-EQUIV='Refresh' CONTENT ='2;URL= ./MainProduct.php'>";
}

?>