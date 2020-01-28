<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 
include '../conn/conn.php';
?>
<a class="btn btn-primary" href="./addProduct.php">เพิ่ม</a>
        <table class="table">
            <thead>
            <tr>
                <th> UserName </th>
                <th> ชื่อ-สกุล </th>
                <th> โทรศัพย์ </th>
                <th> สถานะ </th>
                <th>แก้ไข</th>
                <th>ลบ</th>
      
            </tr>
            </thead>
            <tbody>
                    <?php 
                        $sql="SELECT * FROM user " ;
                        $query = mysqli_query($conn,$sql);
                        while($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                    ?>      
                <tr>
                <td><?php echo $result['U_UserName'];?></td>
                <td><?php echo $result['U_FName'].$result['U_LName'];?></td>
                <td><?php echo $result['U_Phone'];?></td>
                <td><?php echo $result['U_Status'];?> </td>
                <td> <a href="./edtiUser.php?ID=<?php echo $result['U_ID'];?>">Edit</a></td>
                <td><a href="./delUser.php?ID=<?php echo $result['P_ID'] ;?>">Del</a></td>
                </tr>
                    <?php } ?> 
            </tbodt>
            </table>
</body>
</html>