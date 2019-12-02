<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <style>
               h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
                .w3-bar-block .w3-bar-item {padding:20px}
            body{
                background-repeat : no-repeat;
                background-size: cover;
            }                              
        </style>
<body background="https://img.freepik.com/free-vector/blue-abstract-acrylic-brush-stroke-textured-background_53876-86373.jpg?size=626&ext=jpg">
<?php 
include './conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
if($_SESSION['login'] == ""){
  
  $_SESSION['login'] = 0;
}
// แสดงจำนวนที่ค้าอยู่ในสต้อกของลูกค้า แสดงใน button ตระกร้าสินค้า
$sqlN ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ' ";
   $queryN = mysqli_query($conn,$sqlN);
  $rowN = mysqli_num_rows($queryN);
$sqlU= "SELECT `U_ID`,`U_Img`,'' FROM `user` WHERE U_ID = '".$_SESSION['User']."' ";  
$queryU = mysqli_query($conn, $sqlU);   // ใช้ในการติดต่อฐานข้อมูลแล้วทำการ QUERY
$resultU = mysqli_fetch_array($queryU);


?>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="z-index:2;width:300px;min-width:100px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">ปิดเมนู</a>
  <img src="<?php echo $resultU["U_Img"];?>" style="width:180px;" class="w3-round"><br><br>
    <h4><b>PORTFOLIO</b></h4>
    <p>Template by W3.CSS</p>
  <a href="#food" onclick="w3_close()" class="w3-bar-item w3-button">Food</a>
  <?php if($_SESSION['login'] == ""){?>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">About</a>
  <?php } if($_SESSION['login'] == 1 ){ ?>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">Logout</a>
  <?php } ?>

</nav>


<!-- Top menu -->
<div class="w3-top">
  <div class="w3-white w3-xlarge" style="max-width:100%;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-right w3-padding-16"style="padding:10px"><a href="./login/login.php"><button type="button" class="btn btn-success">Login</button></a></div>
    <div class="w3-center w3-padding-16"><a href="./main/user.php"><button type="button" class="btn btn-outline-dark">ตระกร้าสินค้า &nbsp;<span class="badge badge-primary badge-pill"><?php echo $rowN;?></span></button></a></div>
  </div>
</div>
  
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:100%;margin-top:100px">

           <div class="container" style="width: 1080px;">  <!-- กำหนดขนาด หน้าต่าง ของ แถวกลางข่้อมูล-->
                <?php  
                include './conn/conn.php';
                $sql = "SELECT * FROM Product ORDER BY P_ID ASC";  
                $result = mysqli_query($conn, $sql);   // ใช้ในการติดต่อฐานข้อมูลแล้วทำการ QUERY
                if(mysqli_num_rows($result) > 0)  // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
                {  
                     while($row = mysqli_fetch_array($result))  // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป     
                     {  
                ?>  
                <div class="col-md-4">  
                         <form method="post" action="./order/InsertOrder.php">  
                          <div class="card" style="width:100% ;background-color:#D8FFFB; padding:10px;" align="center">
                                <img src="<?php echo $row["P_Photo"];?>" class="img-responsive">
                                <div class="card-body">
                                <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number']?>">
                                <h4 class="text-info"><?php echo $row["P_Name"]; ?></h4>  
                                <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>" />
                                <input type="hidden" name="P_Photo" value="<?php echo $row["P_Photo"]; ?>" />
                                <input type="text" name="quantity" id="quantity" class="form-control" value="1" style=" width: 10% ; "/>
                                <p class="card-text">1/6</p>
                                <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>" />  
                                <?php if($_SESSION['login'] == ""){ ?>
                                   <a href="./login/login.php"> <input name="add_to_cart" class="btn btn-success" value="เพื่มเข้าตระกร้า" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> </a>
                                <?php } ?>         <!-- End if session login-->
                                <?php if($_SESSION['login']== 1){ ?>   
                                <input name="Save"  type="submit" class="btn btn-success" value="เพื่มเข้าตระกร้า" onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
                                <?php }?> <!-- end if session login = 1 -->
                            </div>
                        </div>
                     </form>  
                     <br>
                </div>  
                <?php  
                     }   // while $row
                }        // if $result
                
                ?> 
                </div>
                <!-- Pagination -->
                <div class="w3-center w3-padding-32">
                    <div class="w3-bar">
                         <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
                         <a href="#" class="w3-bar-item w3-black w3-button">1</a>
                         <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
                         <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
                         <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
                         <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>
  

  
  <hr id="about">

  <!-- About Section -->
  <div class="w3-container w3-padding-32 w3-center">  
    <h3>About Me, The Food Man</h3><br>
    <img src="/w3images/chef.jpg" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
    <div class="w3-padding-32">
      <h4><b>I am Who I Am!</b></h4>
      <h6><i>With Passion For Real, Good Food</i></h6>
      <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    </div>
  </div>
  <hr>
  
  <!-- Footer -->
  <footer class="w3-row-padding w3-padding-32">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third w3-serif">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dinner</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Salmon</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">France</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Drinks</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Flavors</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Cuisine</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Chicken</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Dressing</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fried</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fish</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Duck</span>
      </p>
    </div>
  </footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
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
