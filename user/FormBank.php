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
        <link rel="stylesheet" href="./css/bank.css">
        <title>Shop</title>
    </head>
    
    <body>
        <div class="head_bar">
        </div>
        <div class="contriner">
            <div class="topmenu">
                <div class="row">
                    <!-- โลโก้ -->
                    <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                        <a href=""><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                    </div>

                </div>
            </div> <!-- topmenu -->
            <div class="maimMenu">
                <div class="rowmenu">
                    <div class="col-md-8">
                        <form action="../order/UserConfSends.php" id="SendForm" method="post" enctype="multipart/form-data">
                            <H4>ช่องทางการชำระเงิน</H4>
                            <?php 
                            $sql = "SELECT * FROM bank_tb WHERE BK_Type ='1' ";  
                            $result = mysqli_query($conn, $sql);   
                         while($row = mysqli_fetch_array($result)){ ?>
                            <div class="bank">
                                <label><input type="radio" name="bank" value="<?php echo $row['Bk_id']; ?>">
                                    โอนผ่านบัญชีธนคาร</label><br>
                                <div class="col-md-1">
                                    <img src="<?php echo '../photo/'.$row['Bk_img'] ;?>" width="50px" height="50px">
                                </div>
                                <div class="col-md-10">
                                    <h4><?php echo $row['Bk_Name'].'<br>เลขบัญชี &nbsp;'; echo $row['Bk_Number']?> <p1
                                            style="margin-left:50px"><?php echo $row['U_Name']; ?></p1>
                                    </h4>
                                </div>
                            </div> <!--  bank-->
                            <?php } ?>

                    </div>
                    <div class="col-md-4" style="width:500px;margin-left:100px;border: 1px solid black;">
                        <h3>สรุปรายการสั่งซื้อ</h3>
                        <?php
                $price = 0;
                $sunmend = 0;
                $numsend = 0;
                for($i = 0; $i < count($_POST['check']); $i++){
                $num = $_POST['check'][$i];
                $sql = "SELECT orders.O_ID,orderdetail.OD_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo FROM orders 
                INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
                INNER JOIN product ON product.P_Number = orderdetail.P_Number
                WHERE orders.O_ID='$num'";
                $query = mysqli_query($conn,$sql);
                $result = mysqli_fetch_array($query);
                $sql2 = "SELECT sum(OD_Unit) as sumsend from orderdetail WHERE O_ID='$num'";
                $query2 = mysqli_query($conn,$sql2);
                $result2 = mysqli_fetch_array($query2);
                $numsend = $numsend + $result2['sumsend'];
              ?>
                        <div class="form-group">
                            <input type="hidden" name="check[]" value="<?php echo $result['O_ID']?>">
                            <div class="col-md-3">
                            <a href="../product/ShowProduct.php?P_Number=<?php echo $result['P_Number'] ;?>" target="_blank"><img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>" width="80px"
                                    height="80px"> </a>
                            </div>
                            <div class="col-md-9" style="padding:3px;">
                                <label for="" style="margin-top:2px;">ชื้อสินค้า :
                                    <?php echo $result['P_Name'] ;?></label> <br>
                                <label for="" style="margin-top:2px;"> X <?php echo $result['OD_Unit'] ;?></label>
                                <br>
                                <label for="" style="margin-top:2px;">THB <?php echo $result['P_Price'] ;?> </label>
                                
                            </div>
                        </div>
                        <?php 
                        $price = $price + ($result['OD_Unit'] * $result['P_Price']); //sum Price Product
                        } // for loop 
                    ?>
                    <?php 
                     $sqlsn = "SELECT * from send_tb where sn_id = '".$_POST['gender']."' ";
                     $querysn = mysqli_query($conn,$sqlsn);
                     $resultsn = mysqli_fetch_array($querysn);
                    ?>
                        <div class="detailsum">
                            <input type="hidden" name="gender" value="<?php echo $_POST['gender'] ?>">
                            <h4>จำนวน(ชิ้น) :<span> &emsp;
                                    <?php echo $numsend; ?> </span></h4>
                            <h4>ค่าส่ง(ชิ้น) :<span>&emsp;&nbsp;&nbsp;&nbsp;<?php  echo $resultsn['Sn_Price'] ?> </span>
                            </h4>
                            <h4><span> รวมค่าส่ง :&emsp;&emsp;
                                    <?php  $sumsend = ($numsend*$resultsn['Sn_Price']) ;echo $sumsend ; ?></span></h4>
                            <h4>รวมสินค้า :<span>&emsp;&emsp;<?php  echo $price ; ?></span>
                            </h4>
                            <h4>รวม&emsp;&emsp;&nbsp;:<span>&emsp;&emsp;<?php echo $price+$sumsend; ?></span></h4>
                        </div>
                        <div class="form-group col-md-12" style="padding-top:50px; margin-right:150px;">
                        <span id="alert" style="color: red;"></span>
                            <button type="button" class="btn btn-primary"
                                style="float:right; margin-right:50px">[บันทึก]</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div> <!-- contrinner-->
        <footer>
            <p> Power By Harumyx </p>
        </footer>
        <script>
        $(document).ready(function () {
            $("button[type='button']").click(function () {
                var r = confirm('คุณต้องการบันทึกรายการสินค้าตามนี้หรือไม่');
                var radioValue = $("input[name='bank']:checked").val();
                var txt;
                if (r == true) {
                    if (!radioValue) {
                        txt = "กรุณาเลีอกช่องทางการชำระเงิน";
                        //ta
                        document.getElementById("alert").innerHTML = txt;
                    }
                    if (radioValue) {
                        //form id 
                        document.getElementById("SendForm").submit();
                    }
                }
            });
        });
    </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>

    </html>
</body>

</html>