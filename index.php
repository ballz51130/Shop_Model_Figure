
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Main</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <a href="./main/user.php"><button type="button" class="btn btn-outline-dark">เช็คตระกร้าสินค้า</button></a><br>
           <div class="container" style="width:700px;">  
           
                <?php  
                include './conn/conn.php';
                session_start(); // คำสั่ง เปิดใช้งาน session 
                $query = "SELECT * FROM Product ORDER BY P_ID ASC";  
                $result = mysqli_query($conn, $query);   // ใช้ในการติดต่อฐานข้อมูลแล้วทำการ QUERY
                if(mysqli_num_rows($result) > 0)  // เป็น function ที่ บอก ว่า ผลของการ query ของ คำสั่ง sql ของเรา มีกี่แถวข้อมูล
                {  
                     while($row = mysqli_fetch_array($result))  // ใช้คืนค่า ค่าข้อมูล ของ result ในแถวที่ชี้อยู่ และเก็บไว้ที่ array และเลื่อนไปตัวชี้ชี้ไปยังตำแหน่งถ้ดไป     
                     {  
                ?>  
                <div class="col-md-4">  
                         <form method="post" action="./order/InsertOrder.php">  
                          <div class="card" style="width: 100% ;background-color:#D8FFFB; padding:10px;" align="center">
                                <img src="<?php echo $row["P_Photo"];?>" class="img-responsive">
                                <div class="card-body">
                                <input name="P_Number" type="hidden" id="P_Number" value="<?php echo $row['P_Number']?>">
                                <h4 class="text-info"><?php echo $row["P_Name"]; ?></h4>  
                                <input type="hidden" name="hidden_name" value="<?php echo $row["P_Name"]; ?>" />
                                <input type="hidden" name="P_Photo" value="<?php echo $row["P_Photo"]; ?>" />
                                <input type="text" name="quantity" id="quantity" class="form-control" value="1" style="width: 100px ; "/>  
                                <p class="card-text">1/6</p>
                                <input type="hidden" name="hidden_price" value="<?php echo $row["P_Price"]; ?>" />  
                                <?php if($_SESSION['login'] == ""){ ?>
                                   <a href="./login/login.php"> <input name="add_to_cart" class="btn btn-success" value="Save" onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')"> </a>
                                <?php } ?>         <!-- End if session login-->
                                <?php if($_SESSION['login']== 1){ ?> 
                                   
                                <input name="Save"  type="submit" class="btn btn-success" value="Save" onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
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