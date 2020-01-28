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
    <title>Login</title>
</head>
<body>
<div class="contriner">
<form name="login" method="POST" action="check_login.php" >
<div class="login_grup">
<label>ชื่อผู้ใช้งาน</label>
<input name="UserName" id="UserName" type="text" class="form-control" placeholder="Username" required autofocus>
</div>
<div class="form-group">
<label>รหัสผ่าน</label>
<input name="password" id="password" type="password" class="form-control" placeholder="password" require>
</div>
<button type="submit"  class="btn btn-primary btn-sm btn-block">เข้าสู่ระบบ</button>
</form>
</div>
</body>
</html>

