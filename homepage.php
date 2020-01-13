<?php  
                include './conn/conn.php';
                $sql = "SELECT * FROM Product ORDER BY P_ID ASC";  
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
                }        // if $result
                
                ?> 
 