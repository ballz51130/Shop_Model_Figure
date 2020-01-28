<?php
  include '../conn/conn.php';
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
  <link rel="stylesheet" href="./css.css">
  <title>Document</title>
</head>

<body>
  <div class="contriner">
    <div class="input">
      <form action="./checkadd.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="P_ID" name="P_ID" value="">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสสินค้า</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputEmail3" name="P_Number" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">ชื่อสินค้า</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputPassword3" name="P_Name" value="">
          </div>
        </div>
        <div class="inputphoto">
          <label for="Name">รายระเอียดสินค้า</label>
          <div>
            <textarea id="text" cols="40" rows="4" name="image_text" placeholder="รายระเอียดสินค้า"></textarea>
          </div>
          <div>
            <input type="file" name="image">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputEmail3" name="P_Unit" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ราคาสินค้า</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputEmail3" name="P_Price" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะสินค้า</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputEmail3" name="P_Status" value="">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">ประเภทสินค้า(กลุ่ม)</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="inputEmail3" name="P_Group" value="">
          </div>
        </div>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">[บันทึก]</button>
        </div>
    </div>
  </div> <!-- div input -->
  </form>
</body>

</html>