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
  <link rel="stylesheet" href="./css/addProduct.css">
  <title>Shop</title>
</head>

<body>
  <div class="head_bar">
    <div class="manu_login">
      <ul>
        <li> <?php if ($_SESSION['login'] == "")
{ ?>
          <a href="../login/login.php">Login</a>
          <?php
}
if ($_SESSION['login'] == 1)
{ ?>
        <li><?php echo $resultU['U_FName']; ?></li>
        <li> <a href="">MY ACCOUNT </a></li>
        <li><a href="../login/logout.php">Logout</a></li>
        <?php
} ?>
        </li>
      </ul>
    </div>
  </div>
  <div class="contriner">
    <div class="topmenu">
      <div class="row-home">
        <!-- โลโก้ -->
        <div class="col-md-3" id="homeicon" style="margin-left:px5;">
          <a href="./MainProduct.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
        </div>

      </div>
      <div class="list">
        <ul class="list">
          <a href="../index.php" class="btn btn-primary">หน้าแรก</a>
          <a href="" class="btn btn-primary">Home</a>
          <a href="#" class="btn btn-primary">Home</a>
        </ul>
      </div>
    </div> <!-- topmenu -->
    <div class="maimMenu">
      <div class="input">
        <form action="./checkadd.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="P_ID" name="P_ID" value="">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสสินค้า</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_Number" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">ชื่อสินค้า</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputPassword3" name="P_Name" value="">
            </div>
          </div>
          <div class="inputphoto">
            <label for="Name">รายระเอียดสินค้า</label>
            <div>
              <textarea id="text" cols="40" rows="4" name="image_text" placeholder="รายระเอียดสินค้า"></textarea>
            </div>
           
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">รูปหลักสินค้า</label>
            <div class="col-sm-2">
            <input type="file" name="image"> 
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">รูปรายระเอียด1</label>
            <div class="col-sm-2">
            <input type="file" name="image1"> 
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">รูปรายระเอียด2</label>
            <div class="col-sm-2">
            <input type="file" name="image2"> 
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">รูปรายระเอียด3</label>
            <div class="col-sm-2">
            <input type="file" name="image3"> 
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">น้ำหนัก</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_weight" value="">
            </div>
          </div>
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_Unit" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ราคาสินค้า</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_Price" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะสินค้า</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_Status" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ประเภทสินค้า(กลุ่ม)</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="inputEmail3" name="P_Group" value="">
            </div>
          </div>
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">[บันทึก]</button>
          </div>
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