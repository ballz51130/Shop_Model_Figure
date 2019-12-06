<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <title>Document</title>
</head>
<body>
 <?php 
   include '../conn/conn.php';
   session_start();
   
?>
  <center> <h1> สินค้าที่ต้องชำระ </h1> </center>
<div class="table" align ="center">
<table class="table table-bordered "style="width: 900px;">
    <thead>
    <tr>
        <th scope="col"> ID</th>
        <th scope="col"> ชื่อสินค้า </th>
        <th scope="col"> จำนวน </th>
        <th scope="col"> ราคา </th>
        <th scope="col"> ยอดชำระ </th>
        <th scope="col"> สถานะ </th>
        <th scope="col"> จัดการ </th>
        <th scope="col"> ลบรายการ </th>
        </tr>
        </thead>
        <tbody>
        <tr>
    <?php
   $sql ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ' ";
   $query = mysqli_query($conn,$sql);
   $SUM =0;
   $AllSum = 0;
   while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
       
       if ($result['O_Status']=='รอตรวจสอบ'){
        $bg="#3366ff";
       }
       if($result['O_Status']=='รอการชำระ'){
        $bg="#FF6600";
       }
       if($result['O_Status']=='จ่ายแล้ว'){
        $bg="#8cff66"; 
       }
    ?>  
<td align ="center"> <?php echo $result['O_ID'];?></td>
<td align ="center"> <?php echo $result['P_Name'];?></td>
<td align ="center"> <?php echo $result['O_Unit']; ?> </td>
<td align ="center"> <?php echo $result['P_Price']; ?> </td>
 <?php $SUM = $result['P_Price'] * $result['O_Unit']; $AllSum = $AllSum + $SUM ;?>
<td align ="center"> <?php echo $SUM ;?> </td>
<td bgcolor="<?=$bg;?>" align ="center"> <?php echo $result['O_Status'];?> </td>
<td align ="center"> <a href="../order/Confrime.php?ID=<?php echo $result['O_ID'];?>&P_Name=<?php echo $result["P_Name"];?>&Sum=<?php echo $SUM; ?>&O_Unit=<?php echo $result['O_Unit']; ?>&P_Price=<?php echo $result['P_Price']; ?>"><?php echo "Edit";?></a> </td>
<td align ="center"> <a href=""><?php echo "ลบ";?></a> </td>
   </tr>
  <?php } ?> 
  </tbodt>
   </table>
    <h4 align = 'right'style="width: 900px;"> <?php  echo "<br>ราคารวมทั้งหมด" ,"&nbsp",$AllSum; ?> </h4>
    <a href="./main/user.php"><button type="button" class="btn btn-outline-dark">จ่ายแยก</button></a> <a href="./main/user.php"><button type="button" class="btn btn-outline-dark">จ่ายรวม</button></a><br>
   </div>
<br>

<center> <H2> สินค้ารอตรวจสอบ/จ่ายแล้ว</H2> </center>

<div class="table" align ="center">
<table class="table table-bordered "style="width: 900px;">
    <thead>
    <tr>
        <th scope="col"> ID</th>
        <th scope="col"> ชื่อสินค้า </th>
        <th scope="col"> จำนวน </th>
        <th scope="col"> ราคา </th>
        <th scope="col"> ยอดชำระ </th>
        <th scope="col"> สถานะ </th>
        <th scope="col">รายระเอียด</th>
      
        </tr>
        </thead>
        <tbody>
        <tr>
    <?php
   $sql ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."'  AND orders.O_Status NOT LIKE 'รอการชำระ' ";
   $query = mysqli_query($conn,$sql);
   $SUM =0;
   $AllSum = 0;
   
   while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
       if ($result['O_Status']=='รอตรวจสอบ'){
        $bg="#3366ff";
       }
       if($result['O_Status']=='รอการชำระ'){
        $bg="#FF6600";
       }
       if($result['O_Status']=='จ่ายแล้ว'){
        $bg="#8cff66"; 
       }
    ?>  
<td align ="center"> <?php echo $result['O_ID'];?></td>
<td align ="center"> <?php echo $result['P_Name'];?></td>
<td align ="center"> <?php echo $result['O_Unit']; ?> </td>
<td align ="center"> <?php echo $result['P_Price']; ?> </td>
 <?php $SUM = $result['P_Price'] * $result['O_Unit']; $AllSum = $AllSum + $SUM ;?>
<td align ="center"> <?php echo $SUM ;?> </td>
<td bgcolor="<?=$bg;?>" align ="center"> <?php echo $result['O_Status'];?> </td>
<td align ="center"> <a href="http://"> <botton> ด฿</botton> </a> </td>

   </tr>
  <?php } ?> 
  </tbodt>
   </table>
  
   </div>
</body>
</html>