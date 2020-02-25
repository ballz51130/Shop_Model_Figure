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
     <link rel="stylesheet" href="./css/add.css">
    <title>Document</title>
</head>
<body>
<div class="contriner">
<form action="./checkAddUser.php" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
      <label for="inputEmail4">UserName</label>
      <input type="text" name="U_UserName" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group">
      <label for="inputPassword4">Password</label>
      <input type="password" name="U_Password" class="form-control" id="inputPassword4">
    </div>
    <div class="form-group">
      <label for="inputEmail4">ชื่อ-นามสกุล</label>
      <input type="text" name="U_Name" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" name="Email" class="form-control" id="inputEmail4">
    </div>
    <div class="inputphoto">
        <label for="Name">รูป</label>
        <div class="">
            <input type="hidden" id="text" cols="40" rows="4" name="image_text"></input>
        </div>
        <div>
  	            <input type="file" name="image">
  	    </div>
          </div>
  </div>
  <br>
  <div class="form-group">
      <label for="inputEmail4">ที่อยู่</label>
      <input type="text" name="Home" class="form-control" id="inputEmail4">
    </div>
  <div class="form-row">
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputCity">ตำบล</label>
      <input type="text" name="T_District" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">อำเภอ</label>
    <input type="text" name="A_District" class="form-control" id="inputZip">
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">จังหวัด</label>
      <input type="text" name="Province" class="form-control" id="inputZip">
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">ไปรษณีย์</label>
      <input type="text" name="zip" class="form-control" id="inputZip">
    </div>
  </div>
  </div>
  <div class="form-group">
      <label for="inputEmail4">เบอร์โทรศัพย์</label>
      <input type="text" name="U_Phone" class="form-control" id="inputEmail4">
    </div>
  <br>
    <div align="right" style="padding-top:50px;">
    <button type="submit" class="btn btn-primary">สมัคร</button> <a href="http://"class="btn btn-primary" style="margin-left:50px;">ย้อนกลับ</a>
    </div>
</form>
</body>
</html>