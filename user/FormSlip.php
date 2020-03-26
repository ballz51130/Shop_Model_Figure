<?php
include '../conn/conn.php';
$sqlproduct="SELECT *  FROM orders 
INNER JOIN product ON product.P_Number = orders.P_Number
INNER JOIN orderdetail ON orders.O_ID = orderdetail.O_ID
INNER JOIN send_tb ON send_tb.Sn_id = orders.Sn_id
INNER JOIN bank_tb ON bank_tb.Bk_id = orders.Bk_id
WHERE orders.C_ID='".$_GET['C_ID']."'";
$queryproduct = mysqli_query($conn,$sqlproduct);
$queryproduct2 = mysqli_query($conn,$sqlproduct);
$resultbk = mysqli_fetch_array($queryproduct2);
 $sqlbk= "SELECT * FROM bank_tb";
 $querybk = mysqli_query($conn,$sqlbk);//  เอาไว้แสดง option ช่องที่1
 $sqlbk2= "SELECT * FROM bank_tb where Bk_id = '".$resultbk['Bk_id']."' ";
 $querybk2 = mysqli_query($conn,$sqlbk2); //  เอาไว้แสดง option ช่องที่2
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
    <link rel="stylesheet" href="./css/style.css">
    <title>Shop</title>
</head>

<body>
    <div class="contriner">
        <div class="topmenu">
            <div class="row-home">
                <!-- โลโก้ -->
                <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                    <a href="./Market.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>
            </div>
        </div> <!-- topmenu -->
        <div class="maimMenu">
            <div class="menu">
                <form action="./CheckSlip.php" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="ID" value="<?php echo $_GET['O_ID']?>">
                    <div class="form-group">
                        <div class="row">
                        <h3>สรุปรายการสั่งซื้อ</h3>
                        <?php
                $unit = 0;
                $sumproduct = 0;
                while($result = mysqli_fetch_array($queryproduct)){
                    $unit = $unit + $result['OD_Unit'];
                    $Sn_id = $result['Sn_id'];
                    $sumproduct = $sumproduct+($result['P_Price']*$result['OD_Unit']);
              ?>
                        <div class="form-group">
                            <input type="hidden" name="check[]" value="<?php echo $result['O_ID']?>">
                            <div class="col-md-3">
                            
                            <a href="../product/ShowProduct.php?P_Number=<?php  echo $result['P_Number'] ;?>" target="_blank"><img src="<?php echo '../photo/Order/'.$result['P_Photo'] ;?>" width="80px"
                                    height="80px"> </a>
                            </div>
                            <div class="col-md-9" style="padding:3px;">
                                <label for="" style="margin-top:2px;">ชื้อสินค้า :
                                    <?php echo $result['P_Name'] ;?></label> <br>
                                    <input type="hidden" name="product[]" value="<?php echo $result['P_Number'] ;?>">
                                    <input type="hidden" name="unit[]" value="<?php echo $result['OD_Unit'] ;?>">
                                    <input type="hidden" name="status[]" value="<?php echo $result['P_Status'] ;?>" >
                                <label for="" style="margin-top:2px;"> X <?php echo $result['OD_Unit'] ;?></label>
                                <br>
                                <label for="" style="margin-top:2px;">THB <?php echo $result['P_Price'] ;?> </label>
                            </div>
                        </div>
                        <?php 
                        
                                }
                    ?>
                    <?php 
                        $sqlsends="SELECT Sn_Price FROM send_tb WHERE Sn_id= '".$Sn_id."' ";
                        $querysends = mysqli_query($conn,$sqlsends);
                        $reslutsen = mysqli_fetch_array($querysends);
                        $sumsends = $unit*$reslutsen['Sn_Price']
                    ?>
                        <div class="detailsum">
                                <ul>
                                <li>ค่าส่ง(ชิ้น) : <span><?php  echo $reslutsen['Sn_Price']; ?></span>  </li>
                                <li>รวมค่าส่ง : <span><?php echo $sumsends  ;?></span> </li>
                                <li> รวมสินค้า : <span><?php echo$sumproduct ; ?></span> </li>
                                <li>รวม : <span><?php echo $sumsends+$sumproduct;  ?></span> </li>
                                </ul>
                      </div>
                        <div class="form-group col-md-12">
                            <div class="inputphoto">
                                <label for="Name">รูปสลิป</label>
                                <div class="">
                                    <input type="hidden" id="text" cols="40" rows="4" name="image_text"></input>
                                </div>
                                <div>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" required oninvalid="this.setCustomValidity('กรุณาเพิ่มรูปสลิปหลักฐาน')" oninput="this.setCustomValidity('')">
                                </div>
                                <p > *เพื่อความรวดเร็วในการตรวจสอบ</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">จากธนคาร</label>
                                    <select id="FormBank" name="FormBank" class="form-control" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
                                        <option class="form-control" value="">
                                            <?php while($rowbk= mysqli_fetch_array($querybk)) {?>
                                        <option class="form-control" value="<?php echo $rowbk['Bk_Name'];?>">
                                            <?php echo $rowbk['Bk_Name'];?>
                                        </option>
                                        <?php } ?>
                                        <option class="form-control" value="อื่นๆ"> อื่นๆ
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                <br>
                                    <label for="inputZip">ถึงธนคาร</label>
                                            <?php while($rowbk2= mysqli_fetch_array($querybk2)) {?>
                                            <input type="hidden" name="ToBank" value="<?php echo $resultbk['Bk_Name']; ?>">
                                        <label for=""> <?php echo $rowbk2['Bk_Name'] ?></label> <br>
                                        <label for=""> <?php echo 'ชื่อ&nbsp;'.$rowbk2['U_Name'] ?></label>
                                        <label for=""> <?php echo 'เลขบัณชี&nbsp;'.$rowbk2['Bk_Number'] ?></label>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="margin-top:35px;position: absolute;margin-left:200px">*เพื่อใช้ในการตรวจสอบ</h5>
                            <div class="form-row col-md-6">
                                <label for="inputEmail4">เลขท้ายบัญชี4ตัวสุดท้าย</label>
                                <input type="text" pattern="\d*" maxlength="4" name="Sp_LastNum" class="form-control" value="" style="width:150px">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">จำนวน</label>
                                <input type="number" pattern="^\d*(\.\d{0,2})?$"name="Sp_Price" class="form-control" value="" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <h5 style="margin-top:30px;position: absolute;margin-left:220px"> AM = ก่อนเที่ยงวัน<br>PM =
                                หลังเที่ยงวัน </h5>
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">เวลาที่โอน</label>
                                <input name="time" class="form-control" type="time" ng-model="time"
                                    ng-change="ChangeTime()" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-row col-md-4">
                                <label for="inputEmail4">วันที่โอน</label>
                                <input type="date" name="date" class="form-control" value=""  required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">[ยืนยันการชำระเงิน]</button>
                    <a href="./Market.php" class="btn btn-primary">ย้อนหลับ</a>  
                </div>
                </form>
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