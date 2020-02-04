<?php 
    include '../conn/conn.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>Product</title>
</head>

<body>
    <div class="contriner">
        <a class="btn btn-primary" style="float:left; margin-left:50px;margin:10px" href="./addProduct.php">เพิ่ม</a>
        <table class="table table-bordered-md">
            <thead >
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อสินค้า </th>
                    <th scope="col">รูป</th>
                    <th scope="col">จำนวน </th>
                    <th scope="col">ราคา </th>
                    <th scope="col">แก้ไข</th>
                    <th scope="col">ลบ</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                        $sql="SELECT * FROM Product ORDER BY `P_Unit`  ASC " ;
                        $query = mysqli_query($conn,$sql);
                        $count=1;
                        while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                    ?>
                <tr>
                    <td scope="col"><?php echo $count;?></td>
                    <td scope="col"><?php echo $result['P_Name'];?></td>
                    <td scope="col" align="center"><img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>" width="50px" height="50px"></td>
                    <td scope="col"><?php echo $result['P_Unit'];?></td>
                    <td scope="col"><?php echo $result['P_Price'];?> </td>
                    <td scope="col"> <a href="./editProduct.php?ID=<?php echo $result['P_ID'];?>">Edit</a></td>
                    <td scope="col"><a href="./delProduct.php?ID=<?php echo $result['P_ID'] ;?>">Del</a></td>
                </tr>
                <?php 
                    $count++;
                    } ?>
                </tbodt>
        </table>
    </div> <!-- contriner -->
</body>

</html>