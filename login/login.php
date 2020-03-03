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
    <link rel="stylesheet" href="./styleLogin.css">
    <title>Login</title>
</head>

<body>
    <div class="login">
        <div class="container">
            <div class="wrap-login">
                <form class="login-form" method="POST" action="./check_login.php">
                    <div class="login-form1">
                        เข้าสู่ระบบ
                    </div>
                    <div class="txtuser">
                        ชื่อผู้ใช้งาน
                    </div>
                    <div class="wrap-inputuser" data-validate="Username is required">
                        <input class="input100" type="text" name="username">
                        <div class="focus-input"></div>
                    </div>
                    <div class="txtpass">
                        รหัสผ่าน
                    </div>
                    <div class="wrap-inputpass" data-validate="Password is required">
                        <div class="btn-show-pass">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input class="input100" type="password" name="pass">
                        <div class="focus-input100"></div>
                    </div>
                    <div class="flex-forgot">
                        <div>
                            <a href="./forgotpass.php" class="txt3">
                                ลืมรหัสผ่าน ?
                            </a>
                        </div>
                    </div>
                    <div class="flex-register">
                        <div>
                            <a href="../user/addUser.php" class="txt3">
                                สมัครสมาชิก
                            </a>
                        </div>
                    </div>
                    <div class="container-login">
                        <button class="login-form-btn">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>