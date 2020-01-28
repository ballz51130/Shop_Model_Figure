<?php 
include '../conn/conn.php';
session_start();
$b = $_GET['ID'];
$sql = "SELECT * FROM product WHERE P_ID=".$b;
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query);
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
    <div class="photo">
        <img src="<?php echo '../photo/Order/'.$result['U_Photo'] ;?>" width="300px" height="400px">
    </div>         
    <div class="contriner" style="width:900px;">
    <form action="./CheckEdit.php" method="POST">
    <input type="hidden" name="U_ID" value="<?php echo $result['U_ID'];?>">
 
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสสินค้า</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputEmail3" name="U_UserName" value="<?php echo $result['U_UserName'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">ชื่อสินค้า</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputPassword3" name="U_Password" value="<?php echo $result['U_Password'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">รายระเอียดสินค้า</label>
    <div class="col-sm-3">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="P_Detel" placeholder="<?php echo $result['P_Detel'];?>" value="<?php echo $result['P_Detel'];?>"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">จำนวน</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputEmail3" name="P_Unit" value="<?php echo $result['P_Unit'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">ราคาสินค้า</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputEmail3" name="P_Price" value="<?php echo $result['P_Price'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">สถานะสินค้า</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputEmail3" name="P_Status" value="<?php echo $result['P_Status'];?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">ประเภทสินค้า(กลุ่ม)</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="inputEmail3" name="P_Group" value="<?php echo $result['P_Group'];?>">
    </div>
  </div>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">[บันทึก]</button>
    </div>
  </div>
  
</form>
    </div>
</body>
</html>