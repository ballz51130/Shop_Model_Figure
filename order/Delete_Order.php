<?php 
include '../conn/conn.php';
$ID = $_GET['ID'];
$sql = "DELETE FROM orders WHERE O_ID=".$ID;
$query = mysqli_query($conn,$sql);
$sql2 = "DELETE FROM orderdetail WHERE O_ID=".$ID;
$query2 = mysqli_query($conn,$sql);
if($query=TRUE){
    if($query2=TRUE){
        echo "<h1>สำเร็จ</h1>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../user/user.php'>";
    }
    else{
        echo "<h1>Error</h1>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../index.php'>";
        }
}
else{
    echo "<h1>Error</h1>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '2;URL=../index.php'>";
}

?>