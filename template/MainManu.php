<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
if($_SESSION['login'] == ""){
  $_SESSION['login'] = 0;
  $_SESSION['User'] = 0 ;
  $rowN = 0;
}
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
$num_per_page = 6;
$start_from = ($page-1)*$num_per_page;
// แสดงจำนวนที่ค้าอยู่ในสต้อกของลูกค้า แสดงใน button ตระกร้าสินค้า
if($_SESSION["User"] !=0){
$sqlN ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ' ";
   $queryN = mysqli_query($conn,$sqlN);
  $rowN = mysqli_num_rows($queryN);
$sqlU= "SELECT `U_ID`,`U_Img`,'' FROM `user` WHERE U_ID = '".$_SESSION['User']."' ";  
$queryU = mysqli_query($conn, $sqlU);  
$resultU = mysqli_fetch_array($queryU);
}
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
     <link rel="stylesheet" href="./style.css">
     <title>Shop</title>
</head>
<body>
   <div class="head_bar">
        <div class="manu_login">
            <ul>
                <li><a href="http://"> name </a></li>
                <li> <a href="">MY ACCOUNT </a></li>
                <li><a href="http://"> SIGN OUT </a></li>
            </ul>
        </div>
    </div>
        <div class="contriner">
            <div class="topmenu">
                    <div class="row">
                        <!-- โลโก้ -->
                        <div class="col-md-3">
                            Logo
                        </div>
                        <!-- ส่วนของ ค้นหา  -->
                            <div class="col-md-5" id="serch">
                            <input id="search" type="text" name="q" value="" class="input-text form-control" maxlength="128" placeholder="ค้นหาที่นี่..." role="combobox" aria-expanded="true" aria-haspopup="false" aria-autocomplete="both" autocomplete="off">
                            <button type="submit" title="ค้นหา" class="button"> ค้นหา </button>
                            </div>
                        <!-- ตระกร้าสินค้า -->
                            <div class="col-md-4">
                                temple    
                            </div>
                    </div>
                    <div class="list">
                        <ul class="list">
                            <a href="#"class="btn btn-primary">Home</a> 
                            <a href="#"class="btn btn-primary">Home</a>
                            <a href="#"class="btn btn-primary">Home</a>
                        </ul>
                    </div>
            </div>  <!-- topmenu --> 
            <div class="product">
                <?php 
                    $sql = "SELECT * FROM Product ORDER BY P_ID ASC limit $start_from,$num_per_page ";  
                    $result = mysqli_query($conn, $sql);   
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
                                    <input type="text" name="quantity" id="quantity" class="form-control" value="1" style=" width: 15% ; "/>
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
                    }        
                ?>
                        
            </div> 
            
        </div>  <!-- contriner -->
        <div class="numpage">
                            <?php 
                                $pr_query = "select * from Product ";
                                $pr_reqult = mysqli_query($conn,$pr_query);
                                $total = mysqli_num_rows($pr_reqult);
                                $total_page = ceil($total/$num_per_page)+1;

                            for($i=1;$i<$total_page;$i++){
                                    echo "<a href='MainManu.php?page=".$i."' class='btn btn-primary'>$i</a>";
                            }
                
                            ?>
                </div>
               
        <footer>
          <p> 2019-2020 </p>
     </footer>
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