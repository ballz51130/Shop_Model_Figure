<?php
include '../conn/conn.php';
session_start();
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
$target = "../photo/User/".basename($image);

if($_POST['U_Password']==""){ // pass no change 
    if ($_POST['Province']== 0 ){
        $sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID='".$_SESSION['User']."'";   
        $query = mysqli_query($conn,$sqledit);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
            
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
           }
    
    }
    else {
        // แปลงตัวเลข ตำบล อำเภอ จังหวัด ให้เป็น ชื่อ ค่าที่ POST มาเป็นตัวเลข
    $sqlHome = "SELECT * FROM district 
    INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
    INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
    WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."'";
    $queryHone = mysqli_query($conn,$sqlHome);
    $row = mysqli_fetch_array($queryHone);
    $sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',T_District='".$row['DISTRICT_NAME']."',A_District='".$row['AMPHUR_NAME']."',Province='".$row['PROVINCE_NAME']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID='".$_SESSION['User']."'";
     move_uploaded_file($_FILES['image']['tmp_name'], $target);
     $query = mysqli_query($conn,$sqledit);
     move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
            
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
           }
     
    }


}
else{ //pass change

    if ($_POST['Province']== 0 ){
        $sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Password='$pass',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID='".$_SESSION['User']."'";   
        $query = mysqli_query($conn,$sqledit);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
            
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
           }
    
    }
    else {
    $sqlHome = "SELECT * FROM district 
    INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
    INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
    WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."'";
    $queryHone = mysqli_query($conn,$sqlHome);
    $row = mysqli_fetch_array($queryHone);
    $sqledit = "UPDATE user SET U_UserName='".$_POST['U_UserName']."',U_Password='$pass',U_Name='".$_POST['U_Name']."',Home='".$_POST['Home']."',T_District='".$row['DISTRICT_NAME']."',A_District='".$row['AMPHUR_NAME']."',Province='".$row['PROVINCE_NAME']."',zip='".$_POST['zip']."',U_Phone='".$_POST['U_Phone']."',U_Photo='$image',U_Email='".$_POST['Email']."' WHERE U_ID='".$_SESSION['User']."'";
     move_uploaded_file($_FILES['image']['tmp_name'], $target);
     $query = mysqli_query($conn,$sqledit);
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
            
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=./EditUser.php'>";
           }
     
    }

}

?>