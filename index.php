<?php
include './conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
if (isset($_SESSION['login'])) {
    $_SESSION['login'] = $_SESSION['login'];
} else {
    $_SESSION['login'] = 0;
    $_SESSION['User'] = 0;
}
if (isset($_SESSION['User'])) {
    $_SESSION['User'] = $_SESSION['User'];
} else {
    $_SESSION['User'] = 0;
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $rowN = 0;
    $page = 1;
}
if (isset($_GET['list'])) {
    $list =  $_GET['list'];
} else {
    $list =  "";
}
$numrow = 1;
$num_per_page = 6;
$start_from = ($page - 1) * $num_per_page;
// แสดงจำนวนที่ค้าอยู่ในสต้อกของลูกค้า แสดงใน button ตระกร้าสินค้า
$sqlN = "SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '" . $_SESSION['User'] . "' AND orders.O_Status ='รอการชำระ' ";
$queryN = mysqli_query($conn, $sqlN);
$rowN = mysqli_num_rows($queryN);
$sqlU = "SELECT `U_ID`,U_FName,`U_Photo`,'' FROM `user` WHERE U_ID = '" . $_SESSION['User'] . "' ";
$queryU = mysqli_query($conn, $sqlU);
$resultU = mysqli_fetch_array($queryU);

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
    <link rel="stylesheet" href="./style.css">
    <title>Shop</title>
</head>

<body>
    <div class="head_bar">
        <div class="manu_login">
            <ul>
                <li> <?php if ($_SESSION['login'] == "") { ?>
                    <a href="./login/login.php">Login</a>
                    <?php }
                        if ($_SESSION['login'] == 1) { ?>
                <li><?php echo $resultU['U_FName']; ?></li>
                <li> <a href="">MY ACCOUNT </a></li>
                <li><a href="./login/logout.php">Logout</a></li>
                <?php } ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="contriner">
        <div class="topmenu">
            <div class="row">
                <!-- โลโก้ -->
                <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                    <a href="./index.php?list=<?php echo "" ?>"><img src="./photo/home.png" alt="" width="40px"
                            hight="40px"></a>
                </div>
                <!-- ส่วนของ ค้นหา  -->
                <div class="col-md-5" id="serch">
                    <input id="search" type="text" name="q" value="" class="input-text form-control" maxlength="128"
                        placeholder="ค้นหาที่นี่..." role="combobox" aria-expanded="true" aria-haspopup="false"
                        aria-autocomplete="both" autocomplete="off">
                    <button type="submit" title="ค้นหา" class="button"> ค้นหา </button>
                </div>
                <!-- ตระกร้าสินค้า -->
                <div class="col-md-4">
                    <ul class="social">
                        <li class="so"><a href="http://"><img src="./photo/facebook_1_.png" alt=""></a></li>
                        <li class="so"><a href="http://"><img src="./photo/instagram.png" alt=""></a></li>
                        <li class="so"><a href="http://"><img src="./photo/line.png" alt=""></a></li>
                        <li class="market_u"><a href="./user/user.php">|<img src="./photo/supermarket.png" width="30px"
                                    hight="30px">|<span
                                    class="badge badge-primary badge-pill"><?php echo $rowN; ?></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="list">
                <ul class="list">
                    <a href="./index.php?list=<?php echo ""; ?>" class="btn btn-primary">หน้าแรก</a>
                    <a href="#" class="btn btn-primary">สินค้าPreOrder</a>
                    <a href="#" class="btn btn-primary">แจ้งชำระเงิน</a>
                </ul>
            </div>
        </div> <!-- topmenu -->

        <div class="product">
            <div class="sidebar">
                <h3 class="w3-bar-item">Menu</h3>
                <a href="./index.php?list=Vocaloid"> <img src="./photo/model/Miku.jpg"></a> <br>
                <a href="./index.php?list=Gundum"> <img src="./photo/model/kh.jpg"></a> <br>
                <a href="./index.php?list=asd"> <img src="./photo/model/ms.jpg"></a> <br>
                <a href="./index.php?list=Gundum"> <img src="./photo/model/p7.jpg"></a> <br>
                <a href="./index.php?list=Gundum"> <img src="./photo/model/rt.jpg"></a> <br>
            </div>
            <?php
            if ($list == "") {
                $sql = "SELECT * FROM product ORDER BY P_ID ASC limit $start_from,$num_per_page ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0)  // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
                {
                    while ($row = mysqli_fetch_array($result))  // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป     
                    {
            ?>
            <div class="col-md-4">
                <form method="post" action="./order/InsertOrder.php">
                    <div class="card" style=" width: 100% ;background-color:#D8FFFB; padding:20px;" align="center">
                        <a href=""><img src="<?php echo './photo/Order/' . $row['P_Photo']; ?>" width="300px"
                                height="350px"></a>
                        <div class="card-body">
                            <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number'] ?>">
                            <h4 class="text-info"><?php echo $row["P_Name"]; ?></h4>
                            <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>">
                            <input type='button' value='-' class='qtyminus' field='quantity'
                                style="width:50px; position: relative; margin-top:4px; margin-left:90px; margin-right:-150px ;float:left;">
                            <input type="text" name="quantity" id="quantity" class="form-control" value="1"
                                style="width:40px; position: relative; ">
                            <input type='button' value='+' class='qtyplus' field='quantity'
                                style=" width:50px;  margin-top:-30px; margin-right: 90px; position: relative; float:right;">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>"> <br>
                            <?php if ($_SESSION['login'] == "") { ?>
                            <a href="./login/login.php"><input name="add_to_cart" class="btn btn-success"
                                    value="เพื่มเข้าตระกร้า" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')">
                            </a>
                            <?php } ?>
                            <!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1) { ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')"> <br>
                            <?php } ?>
                            <!-- end if session log   in = 1 -->
                        </div>
                    </div>
                </form>
                <br>
            </div>
            <?php
                    }   // while $row
                }  // if mysqli_num_rows
            } // if $list        
            ?>
            <?php
            if ($list <> "") {
                $sql = "SELECT * FROM product WHERE P_Group ='$list' ORDER BY P_ID ASC limit $start_from,$num_per_page ";
                $result = mysqli_query($conn, $sql);

                if ($numrow = mysqli_num_rows($result) > 0)  // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
                {
                    while ($row = mysqli_fetch_array($result))  // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป     
                    {
            ?>
            <div class="col-md-4">
                <form method="post" action="./order/InsertOrder.php">
                    <div class="card" style=" width: 100% ;background-color:#D8FFFB; padding:20px;" align="center">
                        <a href=""><img src="<?php echo './photo/Order/' . $row['P_Photo']; ?>" width="300px"
                                height="350px"></a>
                        <div class="card-body">
                            <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number'] ?>">
                            <h4 class="text-info"><?php echo $row["P_Name"]; ?></h4>
                            <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>">
                            <input type='button' value='-' class='qtyminus' field='quantity'
                                style="width:30px; position: relative; margin-top:4px; margin-left:90px; margin-right:-150px ;float:left;">
                            <input type="text" name="quantity" id="quantity" class="form-control" value="1"
                                style="width:40px; position: relative; ">
                            <input type='button' value='+' class='qtyplus' field='quantity'
                                style=" width:30px;  margin-top:-30px; margin-right: 90px; background-color: ; position: relative; float:right;">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>"> <br>
                            <?php if ($_SESSION['login'] == "") { ?>
                            <a href="./login/login.php"><input name="add_to_cart" class="btn btn-success"
                                    value="เพื่มเข้าตระกร้า" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')">
                            </a>
                            <?php } ?>
                            <!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1) { ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')"> <br>
                            <?php } ?>
                            <!-- end if session log   in = 1 -->
                        </div>
                    </div>
                </form>
                <br>
            </div>
            <?php
                    }   // while $row
                }  // if mysqli_num_rows
            } // if $list   

            if ($numrow == "") {
                echo " <br><center><h1>ไม่พบข้อมูล</h1></center>";
            }

            ?>

        </div>

    </div> <!-- contrinner-->
    <div class="numpage">
        <?php
        if ($list == "") {
            $pr_query = "select * from Product ";
            $pr_reqult = mysqli_query($conn, $pr_query);
            $total = mysqli_num_rows($pr_reqult);
            $total_page = ceil($total / $num_per_page) + 1;

            for ($i = 1; $i < $total_page; $i++) {
                echo "<a href='index.php?page=" . $i . "' class='btn btn-primary'>$i</a>";
            }
        }
        if ($list <> "") {
            $pr_query = "select * from Product where P_Group = '$list' ";
            $pr_reqult = mysqli_query($conn, $pr_query);
            $total = mysqli_num_rows($pr_reqult);
            $total_page = ceil($total / $num_per_page) + 1;

            for ($i = 1; $i < $total_page; $i++) {
                echo "<a href='index.php?page=" . $i . "&list=" . $list . "' class='btn btn-primary'>$i</a>";
            }
        }


        ?>
    </div>


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
    <script type="text/javascript">
        // บวกลบ จำนวนสินค้า
        $(document).ready(function () {
            // This button will increment the value
            $('.qtyplus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var fieldName = $(this).prev();
                // Get its current value
                var currentVal = parseInt(fieldName.val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                    fieldName.val(currentVal + 1);
                } else {
                    // Otherwise put a 0 there
                    fieldName.val(5);
                }
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var fieldName = $(this).next();
                // Get its current value
                var currentVal = parseInt(fieldName.val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    fieldName.val(currentVal - 1);
                } else {
                    // Otherwise put a 0 there
                    fieldName.val(0);
                }
            });
        });
</script>
</body>
</html>