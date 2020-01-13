<?php 
include './conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
if($_SESSION['login'] == ""){
  $_SESSION['login'] = 0;
  $_SESSION['User'] = 0 ;
  $rowN = 0;
}
// แสดงจำนวนที่ค้าอยู่ในสต้อกของลูกค้า แสดงใน button ตระกร้าสินค้า
if($_SESSION["User"] !=0){
$sqlN ="SELECT orders.O_ID,orders.P_Number,orders.U_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo,user.U_FName,user.U_LName,orders.O_Status FROM orders
   INNER JOIN product ON product.P_Number = orders.P_Number
   INNER JOIN user ON user.U_ID = orders.U_ID
   WHERE user.U_ID = '".$_SESSION['User']."' AND orders.O_Status ='รอการชำระ' ";
   $queryN = mysqli_query($conn,$sqlN);
  $rowN = mysqli_num_rows($queryN);
$sqlU= "SELECT `U_ID`,`U_Img`,'' FROM `user` WHERE U_ID = '".$_SESSION['User']."' ";  
$queryU = mysqli_query($conn, $sqlU);  
$resultU = mysqli_fetch_array($queryU);
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
     <link rel="stylesheet" href="./style.css">
     <title>Shop</title>
</head>
<body>
    <div class="menubar">
          <div class="contriner">
               <div class="logo">
               <div id="mySidenav" class="sidenav">
               <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
               <a href="#">About</a>
               <a href="#">Services</a>
               <a href="#">Clients</a>
               <a href="#">Contact</a>
               </div>
                 <h1><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span></h1>
               </div>
              
               <ul class="menu">
                    
                    <li>
                        <a href=""> <button>Logout</button></a>
                    </li>
                    
                 </ul> 

          </div>
    </div>
     <section class="info1">
          <div class="contriner1">
              <?php include './homepage.php' ;?>
          </div>
     </section> 
     <footer>
          <p> 2019-2020 </p>
     </footer>
     <script>
               function openNav() {
               document.getElementById("mySidenav").style.width = "350px";
               }

               function closeNav() {
               document.getElementById("mySidenav").style.width = "0";
               }
               </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
            
</body>
</html>