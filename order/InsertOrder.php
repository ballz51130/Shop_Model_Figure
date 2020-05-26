<?php 
include '../conn/conn.php';
session_start();
$sql = "SELECT P_Number,U_ID,OD_Unit,orderdetail.O_ID  FROM orders INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID 
 WHERE U_ID='".$_SESSION['User']."' AND P_Number = '".$_POST['P_Number']."' AND O_Status='ยืนยันการสั่งซื้อ'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
if($result == 0){
    if($_POST['P_Status'] == 1){
        $sql2 = "INSERT INTO orders(U_ID,O_Status) VALUES ('".$_SESSION['User']."','ยืนยันการสั่งซื้อ')";
        $query2 = mysqli_query($conn, $sql2);
        $lest = $conn -> insert_id;
        $sql3 = "INSERT INTO orderdetail(P_Number,O_ID,OD_Unit,P_Status) VALUE ('".$_POST['P_Number']."','$lest','".$_POST['quantity']."','".$_POST['P_Status']."') ";
        $query3 = mysqli_query($conn, $sql3);
        if($query2&&$query3)
        {
            echo "<script type='text/javascript'>alert('ทำการสั่งซื้อสำเร็จ');</script>";
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../index.php'>";
        }
        else
        {
                echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดขึ้น');</script>";
              echo "<META HTTP-EQUIV='Refresh'CONTENT = '0;URL=../index.php'>";
        }
        } // status = 1
        else{
            // เช็ควันที่ PREORER กับ วันที่ สั่งซื้อ
            $sqlcheckMont = "SELECT P_Date ,DATE(now()) as DateOnPre  FROM product WHERE P_Number = '".$_POST['P_Number']."'";
            $querydate= mysqli_query($conn, $sqlcheckMont);
            $resultdate = mysqli_fetch_array($querydate,MYSQLI_ASSOC);
            if($resultdate['P_Date'] >= $resultdate['DateOnPre']){
                $queryinsert = "INSERT INTO orders(U_ID,O_Status) VALUES ('".$_SESSION['User']."','ยืนยันการสั่งซื้อ')";
                $resuktinsert = mysqli_query($conn,$queryinsert);
                $lest = $conn -> insert_id;
                $sql3 = "INSERT INTO orderdetail(P_Number,O_ID,OD_Unit,P_Status) VALUE ('".$_POST['P_Number']."','$lest','".$_POST['quantity']."','".$_POST['P_Status']."') ";
                $query3 = mysqli_query($conn, $sql3);
                if($queryinsert&&$query3){
            echo "<script type='text/javascript'>alert('ทำการสั่งซื้อสำเร็จ');</script>";
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../index.php'>";
        }
        else{
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด');</script>";
            echo "<META HTTP-EQUIV='Refresh'CONTENT = '0;URL=../index.php'>";
        }
            }
        
                else{
                    $newDate = date("d-m-Y", strtotime($resultdate['P_Date']));
                    echo '<script type="text/javascript">alert("หมดเวลาในPreOrderแล้ว สินสุด เมื่อวันที่ '.$newDate.'");</script>';
                    echo "<META HTTP-EQUIV='Refresh'CONTENT = '0;URL=../index.php'>";
            
                }
        
            } // status != 1
    
}

else{
    $sqlproduct = "SELECT P_Unit FROM product WHERE P_Number='".$_POST['P_Number']."'";
    $queryproduct= mysqli_query($conn, $sqlproduct);
    $resultproduct = mysqli_fetch_array($queryproduct,MYSQLI_ASSOC);
   
    $num = $result['OD_Unit']+$_POST['quantity'];
    if ($num > $resultproduct['P_Unit']){
        echo "<script type='text/javascript'>alert('สินค้ามีไม่พอกรุณาตรวจสอบ');</script>";
        echo "<META HTTP-EQUIV='Refresh'CONTENT = '0;URL=../user/Market.php'>";
        
    }
    else{
    $sqlup = "UPDATE orderdetail SET OD_Unit= '$num' WHERE O_ID = '".$result['O_ID']."'";
    $queryup= mysqli_query($conn, $sqlup);
    if($queryup)
    {
        echo "<script type='text/javascript'>alert('อัพเดดรายการสั่งซื้อเรียบร้อยแล้ว');</script>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../index.php'>";
    }
    else
    {
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดขึ้น');</script>";
          echo "<META HTTP-EQUIV='Refresh'CONTENT = '0;URL=../index.php'>";
    }
    }
    
    
} //else ($result > 0)

?>