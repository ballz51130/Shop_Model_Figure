<?php 
include '../conn/conn.php';
$ID = $_GET['ID'];
$sql = "DELETE FROM `orders` WHERE O_ID=".$ID;
$query = mysqli_query($conn,$sql);
if($query=TRUE){
    echo "สำเร็จ";
   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../main/user.php'>";
}
else{
    echo "ไม้สำเร็จ";
 echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../index.php'>";
}

?>