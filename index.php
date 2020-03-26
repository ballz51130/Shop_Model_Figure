<?php
include './conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session
if (isset($_SESSION['login']))
{
    $_SESSION['login'] = $_SESSION['login'];
}
else
{
    $_SESSION['login'] = 0;
    $_SESSION['User'] = 0;
}
if (isset($_SESSION['User']))
{
    $_SESSION['User'] = $_SESSION['User'];
}
else
{
    $_SESSION['User'] = 0;
}
if (isset($_GET['page']))
{
    $page = $_GET['page'];
}
if (isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $rowN = 0;
    $page = 1;
}
if (isset($_GET['list']))
{
    $list = $_GET['list'];
}
else
{
    $list = "";
}
$numrow = 1;
$num_per_page = 6;
$start_from = ($page - 1) * $num_per_page;
// แสดงจำนวนที่ค้าอยู่ในสต้อกของลูกค้า แสดงใน button ตระกร้าสินค้า
$sqlN = "SELECT * FROM orders WHERE U_ID= '".$_SESSION['User']."' AND (O_Status='ยืนยันการสั่งซื้อ' or orders.O_Status ='รอการชำระ') ";
$queryN = mysqli_query($conn, $sqlN);
$rowN = mysqli_num_rows($queryN);
$sqlU = "SELECT `U_ID`,U_Name,`U_Photo`,'' FROM `user` WHERE U_ID = '" . $_SESSION['User'] . "' ";
$queryU = mysqli_query($conn, $sqlU);
$resultU = mysqli_fetch_array($queryU);

?> 
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Model_Shop_Figure</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
</head>
<body style="background-color: #d2dfdfa8;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="./index.php?list=<?php echo "" ?>"><img src="./photo/home.png" alt="" width="30px"
                            hight="30px"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php if ($_SESSION['login'] == ""){?>
            <li class="nav-item">
            <a class="nav-link" href="https://web.facebook.com/ballz51130">ติดต่อเรา</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login/login.php">เข้าสู่ระบบ</a>
          </li>
          <?php } ?>
          <?php if ($_SESSION['login'] == 1){ ?>
            <li class="nav-item active">
            <a class="nav-link" href="./user/Market.php"><img src="./photo/supermarket.png" width="30px"
                                    hight="30px"><span
                                    class="badge badge-light badge-pill"><?php echo $rowN; ?></span></a>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="./user/mainUser.php">ข้อมูลส่วนตัว</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://web.facebook.com/ballz51130">ติดต่อเรา</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login/logout.php">ออกจากระบบ</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">

      <div class="col-lg-3">
      
        <h3 class="my-4">ประเภทสินค้า</h3>
        <div class="list-group">
        <?php $sqllist="SELECT * FROM group_tb WHERE G_Status = 1 " ;
        $querylist = $conn->query($sqllist);
       while($resultlist = $querylist->fetch_array()){

        ?>
       <a href="./index.php?list=<?php echo $resultlist['G_Name'];?>"><img src="<?php echo'./photo/model/'.$resultlist['G_Photo']; ?>"><p style="color:black;" ><?php echo $resultlist['G_Name']; ?></p></a> 
       <?php } ?>
       <a href="./Preorder.php"><img src="./photo/model/preorder.jpg"><p></p></a> 
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
             <a href=""><img class="d-block img-fluid" src="./photo/head/1.jpg" alt="First slide"></a> 
            </div>
            <div class="carousel-item">
            <a href=""><img class="d-block img-fluid" src="./photo/head/2.jpg" alt="Second slide"></a> 
            </div>
            <div class="carousel-item">
            <a href=""><img class="d-block img-fluid" src="./photo/head/3.jpg" alt="Third slide"></a> 
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
          <?php
if ($list == "")
{
    $sql = "SELECT * FROM product
        INNER JOIN status_tb ON status_tb.St_Number = product.P_Status
         limit $start_from,$num_per_page ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
    {
        while ($row = mysqli_fetch_array($result)) // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป
        
        {
?>
            <div class="col-lg-4 col-md-6 mb-4">
                <form method="post" action="./order/InsertOrder.php">
                    <div class="card">
                        <a href="./product/ShowProduct.php?P_Number=<?php echo$row['P_Number']; ?>"><img class="card-img-top" src="<?php echo './photo/Order/' . $row['P_Photo']; ?>" alt="" ></a>
                        <?php if($row['P_Status'] == 1){ ?>
                        <?php if($row['P_Unit'] > 0){ ?>
                        <div id="ribbon" style="background-color: greenyellow;"><?php echo $row['St_Name'];?></div>
                        <?php }?>
                        <?php if($row['P_Unit'] == 0){ ?>
                            <div id="ribbon2"><?php echo 'สินค้าหมด';?></div>
                        <?php } ?>
                        <?php } ?>
                        <?php if($row['P_Status'] == 2){ ?>
                        <div id="ribbon" style="background-color: rgb(164, 71, 240);"><?php echo $row['St_Name'];?></div>
                        <?php } ?>
                        <div class="card-body">
                            <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number'] ?>">
                            <div class="product_code">รหัสสินค้า <span class="code"><?php echo $row['P_Number'] ?></span></div>
                            <p class="text-info"><?php echo $row["P_Name"]; ?></p>
                            <h5 class="text"><?php echo '฿ '.$row["P_Price"]; ?></h5>
                            <!-- <h5 class="text"><?php // echo 'มีสินค้า '.$row["P_Unit"].' ชิ้น'; ?></h5> -->
                            <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>">
                            <input type="hidden" name="P_Status" value="<?php echo $row["P_Status"]; ?>">
                            <input type="hidden" name="quantity" id="quantity" class="form-control" value="1"
                                style="width:40px; position: relative; text-align: center; ">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>"> <br>
                            <div class="buttons">
                            <?php if($row['P_Status']==1){ ?>
                            <?php if($row['P_Unit'] > 0){ ?>
                            <?php if ($_SESSION['login'] == ""){ ?>
                            <a class="btn btn-success" href="./login/login.php" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> เพื่มเข้าตระกร้า</a>
                            <?php } ?><!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1){ ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
                            <?php } ?><!-- end if session log   in = 1 -->
                            <?php }?>
                            <?php if($row['P_Unit'] == 0){ ?>
                              <p class="card-text text-danger">สินค้าหมด</p>
                        <?php } ?> 
                            <?php } ?>
                            <?php if($row['P_Status']==2){ ?>
                              <?php if ($_SESSION['login'] == ""){ ?>
                            <a class="btn btn-success" href="./login/login.php" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> เพื่มเข้าตระกร้า</a>
                            <?php } ?><!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1){ ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
                            <?php } ?><!-- end if session log   in = 1 -->
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                </form>
              
            </div>
            <?php
        } // while $row
        
    } // if mysqli_num_rows
  
} // if $list
?>
<?php
if ($list <> "")
{
    $sql = "SELECT * FROM product INNER JOIN status_tb ON status_tb.St_Number = product.P_Status WHERE P_Group ='$list' ORDER BY P_ID ASC limit $start_from,$num_per_page ";
    $result = mysqli_query($conn, $sql);
    if ($numrow = mysqli_num_rows($result) > 0) // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
  
    {
        while ($row = mysqli_fetch_array($result)) // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป
        
        {
?>
            <div class="col-lg-4 col-md-6 mb-4">
                <form method="post" action="./order/InsertOrder.php">
                    <div class="card">
                        <a href="./product/ShowProduct.php?P_Number=<?php echo$row['P_Number']; ?>"><img class="card-img-top" src="<?php echo './photo/Order/' . $row['P_Photo']; ?>" alt="" ></a>
                        <?php if($row['P_Status'] == 1){ ?>
                        <?php if($row['P_Unit'] > 0){ ?>
                        <div id="ribbon" style="background-color: greenyellow;"><?php echo $row['St_Name'];?></div>
                        <?php }?>
                        <?php if($row['P_Unit'] == 0){ ?>
                            <div id="ribbon2"><?php echo 'สินค้าหมด';?></div>
                        <?php } ?>
                        <?php } ?>
                        <?php if($row['P_Status'] == 2){ ?>
                        <div id="ribbon" style="background-color: rgb(164, 71, 240);"><?php echo $row['St_Name'];?></div>
                        <?php } ?>
                        
                        <div class="card-body">
                            <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number'] ?>">
                            <div class="product_code">รหัสสินค้า <span class="code"><?php echo $row['P_Number'] ?></span></div>
                            <p class="text-info"><?php echo $row["P_Name"]; ?></p>
                            <h5 class="text"><?php echo '฿ '.$row["P_Price"]; ?></h5>
                            <!-- <h5 class="text"><?php // echo 'มีสินค้า '.$row["P_Unit"].' ชิ้น'; ?></h5> -->
                            <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>">
                            <input type="hidden" name="quantity" id="quantity" class="form-control" value="1"
                                style="width:40px; position: relative; text-align: center; ">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>"> <br>
                            <div class="buttons">
                            <?php if($row['P_Status'] == 1){ ?> 
                            <?php if($row['P_Unit'] > 0){ ?>
                            <?php if ($_SESSION['login'] == ""){ ?>
                            <a class="btn btn-success" href="./login/login.php" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> เพื่มเข้าตระกร้า
                            </a>
                            <?php } ?><!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1){ ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
                            <?php } ?><!-- end if session log   in = 1 -->
                            <?php }?>
                            <?php if($row['P_Unit'] == 0){ ?>
                              <p class="card-text text-danger">สินค้าหมด</p>
                        <?php } ?>
                        <?php } ?>
                        <?php if($row['P_Status'] == 2){ ?> 
                            <?php if ($_SESSION['login'] == ""){ ?>
                            <a class="btn btn-success" href="./login/login.php" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> เพิ่มเข้าตระกร้า
                            </a>
                            <?php } ?><!-- End if session login-->
                            <?php if ($_SESSION['login'] == 1){ ?>
                            <input name="Save" type="submit" class="btn btn-success" value="เพิ่มเข้าตระกร้า"
                                onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
                            <?php } ?><!-- end if session log   in = 1 -->
                            
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                </form>
              
            </div>
            <?php
        } // while $row
        
    } // if mysqli_num_rows
    
} // if $list
if ($numrow == "")
{
    echo "<div>";
    echo '<p class="textp">ขออภัยสินค้ายังไม่เข้า</p>';
    echo "</div>";
}

?>

        </div>

    </div> <!-- contrinner-->
    <div class="numpage">
        <?php
if ($list == "")
{
    $pr_query = "select * from product ";
    $pr_reqult = mysqli_query($conn, $pr_query);
    $total = mysqli_num_rows($pr_reqult);
    $total_page = ceil($total / $num_per_page) + 1;

    for ($i = 1;$i < $total_page;$i++)
    {
        echo "<a href='index.php?page=" . $i . "'class='btn btn-primary'>$i</a>";
    }
}
if ($list <> "")
{
    $pr_query = "select * from product where P_Group = '$list' ";
    $pr_reqult = mysqli_query($conn, $pr_query);
    $total = mysqli_num_rows($pr_reqult);
    $total_page = ceil($total / $num_per_page) + 1;

    for ($i = 1;$i < $total_page;$i++)
    {
        echo "<a href='index.php?page=" . $i . "&list=" . $list . "' class='btn btn-primary'>$i</a>";
    }
} ?>
    </div>         

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Power BY &copy; Nititad 2020</p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
