<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="./css/add.css">
  <title>Document</title>
</head>
<script language=Javascript>
        function Inint_AJAX() {
           try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
           try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
           try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
           alert("XMLHttpRequest not supported");
           return null;
        };

        function dochange(src, val) {
             var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
                            document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                       } 
                  }
             };
             req.open("GET", "localtion.php?data="+src+"&val="+val); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า
        }

        window.onLoad=dochange('province', -1);     
</script>
<body>
  <div class="container register-form">
    <div class="form">
      <div class="note">
        <p>สมัครสมาชิก</p>
      </div>
      
      <div class="form-content">
        <form action="./checkAddUser.php" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="inputEmail4">ชื่อผูใช้</label>
              <input type="text" name="U_UserName" class="form-control"   required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
              <label for="inputPassword4">รหัสผ่าน</label>
              <input type="password" name="U_Password" class="form-control" id="inputPassword4" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
              <label for="inputEmail4">ชื่อ-นามสกุล</label>
              <input type="text" name="U_Name" class="form-control"  required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
            </div>
            <div class="form-group">
              <label for="inputEmail4">อีเมล์</label>
              <input type="email" name="Email" class="form-control" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
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
            <input type="text" name="Home" class="form-control" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')" oninput="this.setCustomValidity('')">
          </div>
  
          <div class="form-group col-md-3">
              <label for="inputZip">จังหวัด</label>
              <span id="province">
                    <select class="form-control" name="Province" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')">
                        <option value="" >- เลือกจังหวัด -</option>
                    </select>
                </span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip">อำเภอ</label>
              <span id="amphur" >
                    <select class='form-control' name="A_District" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')"> 
                        <option value="">- เลือกอำเภอ -</option>
                    </select>
                </span>
            </div>
  
              <div class="form-group col-md-3">
              <label for="inputCity">ตำบล</label>
              <span id="district">
                    <select class='form-control' name="T_District" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')">
                        <option value="">- เลือกตำบล -</option>
                    </select>
                </span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip">ไปรษณีย์</label>
              <input type="text" name="zip" class="form-control" id="inputZip" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')">
            </div>
  
          <div class="form-group">
            <label for="inputEmail4">เบอร์โทรศัพย์</label>
            <input type="text" name="U_Phone" class="form-control" id="inputEmail4" required oninvalid="this.setCustomValidity('กรุณากรอกข้อมูลในช่องนี้')">
          </div>
          <br>
          <div align="right" style="padding-top:50px;">
            <button type="submit" class="btn btn-primary">สมัคร</button> <a href="../login/login.php" class="btn btn-primary"
              style="margin-left:50px;">ย้อนกลับ</a>
          </div>
      </div>
      </form>
    </div>
</body>

</html>