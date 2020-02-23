<?php
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session
 $sqlre = "SELECT user.U_UserName,product.P_Name,P_ID,orderdetail.OD_Unit,product.P_Price,send_tb.Sn_Price,bank_tb.Bk_Name,Bk_Number,
 slip_tb.Sp_Price,slip_tb.Sp_Frombank,Sp_LastNum,slip_tb.Sp_Tobank,slip_tb.Sp_Time,slip_tb.Sp_Date,slip_tb.Sp_Img
 FROM orders
 INNER JOIN user ON user.U_ID = orders.U_ID
 INNER JOIN product ON product.P_Number = orders.P_Number
 INNER JOIN orderdetail ON orderdetail.O_ID = orders.O_ID
 INNER JOIN send_tb ON send_tb.Sn_id = orders.Sn_id
 INNER JOIN bank_tb ON bank_tb.Bk_id = orders.Bk_id 
 INNER JOIN slip_tb ON slip_tb.O_ID = orders.O_ID
 WHERE orders.O_ID = ".$_GET['O_ID'];
 $query = mysqli_query($conn,$sqlre);
 $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
 $SumPrice = ($result['P_Price']*$result['OD_Unit'])+ $result['Sn_Price'];
 if(isset($_POST['submit'])){
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
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link rel="stylesheet" href="./css/formSlip.css">
  <title>Shop</title>
</head>

<body>
  <div class="contriner">
    <div class="topmenu">
      <div class="row-home">
        <!-- โลโก้ -->
        <div class="col-md-3" id="homeicon" style="margin-left:px5;">
          <a href="./MainProduct.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
        </div>
      </div>
    </div> <!-- topmenu -->
    <div class="maimMenu">
      <p>asds</p>
      <div class="row">
        <div class="col-md-5">
          <div class="input">
              <input type="hidden" id="P_ID" name="P_ID" value="">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">รหัสรายการสินค้า</label>
                <div class="col-sm-4">
                  <?php echo $_GET['O_ID'] ;?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">ชื่อสินค้า</label>
                <div class="col-sm-4">
                  <?php echo $result['P_Name'];?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">จำนวน</label>
                <div class="col-sm-4">
                  <?php echo $result['OD_Unit'] ;?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">ราคาสินค้า</label>
                <div class="col-sm-4">
                  <?php echo $result['P_Price']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">ค่าจัดส่ง</label>
                <div class="col-sm-4">
                  <?php echo $result['Sn_Price']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-4 col-form-label">รวม</label>
                <div class="col-sm-4">
                  <?php echo $SumPrice ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">โอนจากธนคาร</label>
                <div class="col-sm-6">
                  <?php echo $result['Sp_Frombank'].' xxx-x-xx '.$result['Sp_LastNum']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">ไปยัง</label>
                <div class="col-sm-6">
                  <?php echo $result['Sp_Tobank'].' '.$result['Bk_Number'] ;?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">จำนวน</label>
                <div class="col-sm-3">
                  <?php echo $result['Sp_Price'];?> บาท
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">เวลที่โอน</label>
                <div class="col-sm-4">
                  <?php echo $result['Sp_Time']; ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-4 col-form-label">วันที่โอน</label>
                <div class="col-sm-4">
                  <?php echo $result['Sp_Date'];?>
                </div>
              </div>
          </div>
        </div>
        <form action="./checkSlip.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="O_ID" value=" <?php echo $_GET['O_ID'];?>">
          <input type="hidden" name="P_Unit" value="<?php echo $result['OD_Unit']; ?>">
          <input type="hidden" name="P_ID" value="<?php echo $result['P_ID']; ?>">
        <div class="col-md-5">
          <div class="photo-img">
            <img src="<?php echo '../photo/Slip/'.$result['Sp_Img'];?>">
          </div>
          <div class="lable">
            <select id="cars" name="cars">
              <option  value="เตรียมจัดส่ง">ยืนยันการชำระเงิน</option>
              <option  value="ปฏิเสธการชำระเงิน">ปฏิเสธการชำระเงิน</option>
            </select>
          </div>
          <div class="Note">
            <label for="Note">หมายเหตุ <p id="not"></p></label> <br>
            <textarea name="Note" id="Note" cols="20" rows="2" value=""></textarea>
          </div>
          <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">[ยืนยันการชำระเงิน]</button> <a
              class="btn btn-primary" herf="./admin.php"> ย้อนกลับ</a>
          </div>
        </div>
      </div>
    </div>
    </form>
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
