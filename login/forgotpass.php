<?php
include '../conn/conn.php';
if ( isset( $_POST['submit'] ) ) {
 $sqlquery="SELECT * FROM user WHERE U_UserName='".$_POST['UserName']."' AND U_Phone='".$_POST['Phone']."' AND U_Email='".$_POST['Email']."'";
 $query = mysqli_query($conn,$sqlquery);
 $result = mysqli_fetch_array($query);
  if($result){
      if($_POST['password'] == $_POST['confirmpassword']){
        $pass = md5($_POST['password']."harumyx");
        $sql = "UPDATE user SET U_Password='$pass' where U_ID= '".$result['U_ID']."' ";
        $query= mysqli_query($conn,$sql);
        if($query){
        echo "<script type='text/javascript'>alert('สำเร็จ');</script>";
        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./login.php'>";
        }
        else{
            echo "<script type='text/javascript'>alert('Error');</script>";
        }
      }
      else{
        echo "<script type='text/javascript'>alert('รหัสผ่านไม่ตรงกัน');</script>";
      }
  }
  else{
    echo "<script type='text/javascript'>alert('ข้อมูลไม่ถูกต้อง');</script>";
  }
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
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="./styleforgot.css">
    <title>Shop</title>
</head>
<body>
        <div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>ลืมรหัสผ่าน ?</p>
                </div>
                <div class="form-content">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <input type="text" class="form-control" name="UserName"  placeholder="UserName / ชื่อผู้ใช้ *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Phone" placeholder="เบอร์โทรศัพย์ *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="Email" class="form-control" name="Email" placeholder="อีเมล์ *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่านใหม่ *" value="" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirmpassword" placeholder="ยืนยันรหัสผ่าน *" value="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btnSubmit">ยืนยัน</button>
                    <a href="./login.php"><button type="button" name="button" id="button" class="btnSubmit">ย้อนกลับ</button></a>
                    </form>
                </div>
            </div>
    </div> <!-- contrinner-->

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