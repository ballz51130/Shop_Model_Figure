<?php 
include '../conn/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- link bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <div class="table" align ="center">
     สินค้ารอตรวจสอบการชำระเงิน
    <table class="table table-bordered "style="width: 900px;">
    <thead>
    <tr>
        <th scope="col"> ID</th>
        <th scope="col"> รหัสสินค้า </th>
        <th scope="col"> ชท่อสินค้า </th>
        <th scope="col"> รหัสลูกค้า </th>
        <th scope="col"> ชื่อ </th>
        <th scope="col"> จำนวน </th>
        <th scope="col"> ราคา </th>
        <th scope="col"> ยอดชำระ </th>
        <th scope="col"> สถานะ </th>
        <th scope="col"> จัดการ </th>
        </tr>
        </thead>
   
        <tbody>
        <tr>
            <?php 
                 $sqlOrder = "SELECT orders.O_ID, orders.P_Number,product.P_Name,user.U_ID,user.U_FName,orders.O_Unit,product.P_Price,orders.O_Status FROM orders
                 INNER JOIN product ON orders.P_Number = product.P_Number
                 INNER JOIN user ON orders.U_ID = user.U_ID WHERE O_Status='รอตรวจสอบ'";
                 $queryOrder = mysqli_query($conn,$sqlOrder);
                 while($resultOrder = mysqli_fetch_array($queryOrder,MYSQLI_ASSOC))
                 {?>
                <td> <?php echo $resultOrder['O_ID']; ?> </td>
                <td> <?php echo $resultOrder['P_Number']; ?> </td>
                <td> <?php echo $resultOrder['P_Name']; ?> </td>
                <td> <?php echo $resultOrder['U_ID']; ?> </td>
                <td> <?php echo $resultOrder['U_FName']; ?> </td>
                <td> <?php echo $resultOrder['O_Unit']; ?> </td>
                <td> <?php echo $resultOrder['P_Price']; ?> </td>
                <?php $SumOrder = $resultOrder['O_Unit'] * $resultOrder['P_Price']; ?>
                <td> <?php echo $SumOrder ; ?> </td>
                <td> <?php echo $resultOrder['O_Status']; ?> </td>
                <td> <a href="../order/UpdateOrder.php?O_status=<?php echo $resultOrder['O_ID'];?>&user=<?php echo $resultOrder['U_ID']; ?>&Num=<?php echo $resultOrder['O_Unit'];?>$status=<?php echo $resultOrder['O_Status']; ?>">asdsad</a> </td>
                 </tr>
                 <?php } ?>
        </tbody>
    </table>

         
 </div>

     <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>

</body>
</html>