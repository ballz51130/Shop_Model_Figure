<?php 
include './conn/conn.php';
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
     <link rel="stylesheet" href="./style.css">
     <title>Shop</title>
</head>

<body>
     <div class="head_bar">
          <div class="manu_login">
               <ul>
                    <li> <?php if($_SESSION['login'] == ""){ ?>
                         <a href="./login/login.php">Login</a>
                         <?php }  if($_SESSION['login'] == 1){?>
                    <li><?php echo$resultU['U_FName'];?></li>
                    <li> <a href="">MY ACCOUNT </a></li>
                    <li><a href="./login/logout.php">Logout</a></li>
                    <?php } ?>
                    </li>
               </ul>
          </div>
     </div>
     <div class="contriner">
          <div class="topmenu">
               <div class="row">
                    <!-- โลโก้ -->
                    <div class="col-md-3" id="homeicon" style="margin-left:px5;">
                         <a href="./index.php?list=<?php echo "" ?>"><img src="./photo/home.png" alt="" width="40px"
                                   hight="40px"></a>
                    </div>
                    <!-- ส่วนของ ค้นหา  -->
                    <div class="col-md-5" id="serch">
                         <input id="search" type="text" name="q" value="" class="input-text form-control"
                              maxlength="128" placeholder="ค้นหาที่นี่..." role="combobox" aria-expanded="true"
                              aria-haspopup="false" aria-autocomplete="both" autocomplete="off">
                         <button type="submit" title="ค้นหา" class="button"> ค้นหา </button>
                    </div>
                    <!-- ตระกร้าสินค้า -->
                    <div class="col-md-4">
                         <ul class="social">
                              <li class="so"><a href="http://"><img src="./photo/facebook_1_.png" alt=""></a></li>
                              <li class="so"><a href="http://"><img src="./photo/instagram.png" alt=""></a></li>
                              <li class="so"><a href="http://"><img src="./photo/line.png" alt=""></a></li>
                              <li class="market_u"><a href="./user/user.php">|<img src="./photo/supermarket.png"
                                             width="30px" hight="30px">|<span
                                             class="badge badge-primary badge-pill"><?php echo $rowN;?></span></a></li>
                         </ul>
                    </div>
               </div>
               <div class="list">
                    <ul class="list">
                         <a href="./index.php?list=<?php echo "" ;?>" class="btn btn-primary">หน้าแรก</a>
                         <a href="#" class="btn btn-primary">สินค้าPreOrder</a>
                         <a href="#" class="btn btn-primary">แจ้งชำระเงิน</a>
                    </ul>
               </div>
          </div> <!-- topmenu -->

          <div class="product">
               <div class="sidebar">
                    <h3 class="w3-bar-item">Menu</h3>
                    <a href="./index.php?list=Vocaloid"> <img src="./photo/model/Miku.jpg"></a> <br>
                    <a href="./index.php?list=Gundum"> <img src="./photo/model/kh.jpg"></a> <br>
                    <a href="./index.php?list=asd"> <img src="./photo/model/ms.jpg"></a> <br>
                    <a href="./index.php?list=Gundum"> <img src="./photo/model/p7.jpg"></a> <br>
                    <a href="./index.php?list=Gundum"> <img src="./photo/model/rt.jpg"></a> <br>
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