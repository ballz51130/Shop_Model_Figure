<?php 
include '../conn/conn.php';
session_start(); // คำสั่ง เปิดใช้งาน session 
 if(isset($_POST['form'])=="address"){

    }
    if(isset($_POST['form'])=="send"){
        echo "Send";
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
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="./stylePayment.css">
    <title>Shop</title>
</head>

<body>
    <div class="head_bar">
        <div class="manu_login">
            <ul>
                <li> <?php if($_SESSION['login'] == ""){ ?>
                    <a href="../login/login.php">Login</a>
                    <?php }  if($_SESSION['login'] == 1){?>
                <li><?php echo$resultU['U_FName'];?></li>
                <li> <a href="">MY ACCOUNT </a></li>
                <li><a href="../login/logout.php">Logout</a></li>
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
                    <a href=""><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
                </div>
               
            </div>
            <div class="list">
                <ul class="list">
                    <a href="../index.php" class="btn btn-primary">หน้าแรก</a>
                    <a href="#" class="btn btn-primary">Home</a>
                    <a href="#" class="btn btn-primary">Home</a>
                </ul>
            </div>
        </div> <!-- topmenu -->
        <div class="maimMenu">
            <div class="rowmenu">
                        <div class="col-md-8">
                            <?php 
                            $sqladd ="SELECT * FROM user WHERE U_ID= '".$_SESSION['User']."'";
                            $queryadd = mysqli_query($conn,$sqladd);
                            $resultadd = mysqli_fetch_array($queryadd)
                                ?>
                                <form action="" method="post">
                                <div>   
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                                <div class="form-row col-md-4">
                                                    <label for="inputEmail4">ชื่อ</label>
                                                    <input type="hidden" name="form" class="form-control" value="address">
                                                    <input type="text" name="U_FName" class="form-control" value="<?php echo $resultadd['U_FName'] ?>">
                                                </div>
                                                <div class="form-row col-md-4">    
                                                    <label for="inputPassword4">หมายเลขโทรศัพย์</label>
                                                    <input type="text" name="U_LName" class="form-control" value="<?php echo $resultadd['U_Phone'];?>">
                                                </div>
                                            </div>
                                        <div class="form-group col-md-12" style="margin-left:10px;">
                                        <label for="inputEmail4">ที่อยู่</label>
                                        <textarea id="U_add" name="Home" class="form-control" rows="5" style=" width:700px;"> <?php echo $resultadd['Home']; ?></textarea>
                                        </div>
                                        <div class="form-row col-md-12">
                                            <div class="form-group col-md-2">
                                                <label for="inputCity">ตำบล</label>
                                                <input type="text" name="T_District" class="form-control" id="inputCity" value="<?php echo $resultadd['T_District'];?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">อำเภอ</label>
                                                <input type="text" name="A_District" class="form-control" id="inputZip" value="<?php echo $resultadd['A_District'];?>">
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label for="inputZip">จังหวัด</label>
                                                    <input type="text" name="Province" class="form-control" id="inputZip" value="<?php echo $resultadd['Province'];?>">
                                                </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">ไปรษณีย์</label>
                                                <input type="text" name="zip" class="form-control" id="inputZip" value="<?php echo $resultadd['zip'];?>">
                                            </div>
                                            </div>
                                            <div class="form-row col-md-12">
                                            
                                                
                                        </div>
                                        <div class="form-group col-md-12" style="padding-top:50px; margin-right:200px;">
                                            <button type="submit" class="btn btn-primary" style="float:right; margin-right:50px">[บันทึกที่อยู่]</button>
                                        </div>
                                    
                                </div>
                                
                                </form>
                        </div>
                        <div class="send">
                        </div>
                        </div>
                        <div class="col-md-4"style="width:700px;margin-left:50px;border: 2px solid navy;">
                                <?php 
                                    $sqlproduct="SELECT  orders.O_ID,orders.O_Unit,product.P_Number,product.P_Name,product.P_Price,product.P_Photo FROM orders 
                                         INNER JOIN product ON product.P_Number = orders.P_Number
                                         WHERE O_ID='".$_GET['O_ID']."'";
                                    $queryproduct = mysqli_query($conn,$sqlproduct);
                                    $resultproduct = mysqli_fetch_array($queryproduct);
                                ?>
                            <form action="" method="post">
                                <input type="hidden" name="form" value="send">
                                    <div class="form-group">
                                    <div class="rowp">
                                        <div class="col-md-4">
                                            <img src="<?php echo '../photo/Order/'.$resultproduct['P_Photo'] ;?>" width="200px" height="200px">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                         <label for="" style="margin-top:20px;">ชื้อสินค้า : <?php echo $resultproduct['P_Name'] ;?></label> <br>
                                         <label for="" style="margin-top:20px;">จำนวน : <?php echo $resultproduct['O_Unit'] ;?> ชื้น</label> <br>
                                         <label for="" style="margin-top:20px;">ราคาต่อชิ้น : <?php echo $resultproduct['P_Price'] ;?> </label> <br>
                                         <label for="" style="margin-top:20px;">รวม : <?php  $price=$resultproduct['P_Price']*$resultproduct['O_Unit']; echo$price ;?></label>

                                        </div>
                                        <div class="form-group col-md-12" style="padding-top:50px; margin-right:200px;">
                                            <button type="submit" class="btn btn-primary" style="float:right; margin-right:50px">[ถัดไป]</button>
                                        </div>
                                    </div>     
                               
                            </form>
                        </div>
                        
 
            
        </div>
        </div>

    </div> <!-- contrinner-->



    <!-- <footer>
        <p> Power By Harumyx </p>
    </footer> -->

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