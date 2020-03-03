<?php 
 include '../conn/conn.php';
 $query=mysqli_query($conn,"SELECT * FROM orders INNER JOIN product ON product.P_Number = orders.P_Number INNER JOIN user ON user.U_ID = orders.U_ID INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID WHERE user.U_ID = '12' AND orders.O_Status ='รอการชำระ1' ");

 if(mysqli_num_rows($query)>0){
     while($row = mysqli_fetch_assoc($query)){
         $arr[] = $row;
         $id[] = $row['O_ID'];

     }
 }

for($i = 0; $i < count($id); $i++){
    $num = $id[$i];
    $query = "UPDATE orders SET O_Status = 'รอการชำระ',Sn_id = '2',Bk_id = '2', O_Date = current_timestamp WHERE O_ID = '$num'";
    $result = mysqli_query($conn,$query);
}

?>