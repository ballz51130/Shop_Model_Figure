<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
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
    <link rel="stylesheet" href="./css/MainProduct.css">
    <title>Shop</title>
</head>

<body>
    <div class="head_bar">
        <div class="manu_login">
            <ul>
                <li> <?php if($_SESSION['login'] == ""){ ?>
                    <a href="../login/login.php">Login</a>
                    <?php }  if($_SESSION['login'] == 1){?>
                <li><?php echo$resultU['U_FName'];?></li>
                <li> <a href="">MY ACCOUNT </a></li>
                <li><a href="../login/logout.php">Logout</a></li>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="contriner">
        <div class="topmenu">
            <div class="row-home">
                <!-- โลโก้ -->
                <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                    <a href="./admin.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>

            </div>
            <div class="list">
                <ul class="list">
                    <a href="../index.php" class="btn btn-primary">หน้าแรก</a>
                    <a href="#" class="btn btn-primary">Home</a>
                    <a href="#" class="btn btn-primary">Home</a>
                </ul>
            </div>
        </div> <!-- topmenu -->
        <div class="maimMenu">
<a class="btn btn-primary" style="float:left; margin-left:50px;margin:10px" href="./addProduct.php">เพิ่ม</a>
        <table class="table table-bordered-md">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อสินค้า </th>
                    <th scope="col ">รูป</th>
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
                    <td scope="col"><img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>"
                            width="50px" height="50px"></td>
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
        </div>


    </div>
    </div> <!-- contrinner-->
    <footer>
        <p> Power By Harumyx </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>



</body>

</html>