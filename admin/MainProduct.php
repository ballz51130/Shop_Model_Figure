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
        <a class="btn btn-primary" href="./addProduct.php">เพิ่ม</a>
        <table class="table">
            <thead>
                <tr>
                    <th> ID</th>
                    <th> ชื่อสินค้า </th>
                    <th> จำนวน </th>
                    <th> ราคา </th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                        $sql="SELECT * FROM Product " ;
                        $query = mysqli_query($conn,$sql);
                        while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                    ?>
                <tr>
                    <td><?php echo $result['P_ID'];?></td>
                    <td><?php echo $result['P_Name'];?></td>
                    <td><?php echo $result['P_Unit'];?></td>
                    <td><?php echo $result['P_Price'];?> </td>
                    <td> <a href="./editProduct.php?ID=<?php echo $result['P_ID'];?>">Edit</a></td>
                    <td><a href="./delProduct.php?ID=<?php echo $result['P_ID'] ;?>">Del</a></td>
                </tr>
                <?php } ?>
                </tbodt>
        </table>
    </div> <!-- contriner -->
</body>

</html>