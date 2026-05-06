<?php 
include '../conn/conn.php';
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
$u_username = mysqli_real_escape_string($conn, $_POST['U_UserName']);
$u_name = mysqli_real_escape_string($conn, $_POST['U_Name']);
$u_home = mysqli_real_escape_string($conn, $_POST['Home']);
$u_tdistrict = mysqli_real_escape_string($conn, $_POST['T_District']);
$u_adistrict = mysqli_real_escape_string($conn, $_POST['A_District']);
$u_province = mysqli_real_escape_string($conn, $_POST['Province']);
$u_zip = mysqli_real_escape_string($conn, $_POST['zip']);
$u_phone = mysqli_real_escape_string($conn, $_POST['U_Phone']);
$u_email = mysqli_real_escape_string($conn, $_POST['Email']);
$sqlCheckUser="SELECT U_UserName FROM user WHERE U_UserName='$u_username'";
$queryCheckUser = $conn->query($sqlCheckUser);
$resultCheckUser = mysqli_fetch_array($queryCheckUser,MYSQLI_ASSOC);
if($resultCheckUser > 0){
    echo "<script type='text/javascript'>alert('ชื่่อผู้ใช้บัญชีมีการใช้งานแล้ว กรุณาใช้ชื่ออื่น');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ./addUser.php'>";
}
else{
// แปลงตัวเลข ตำบล อำเภอ จังหวัด ให้เป็น ชื่อ ค่าที่ POST มาเป็นตัวเลข
// $sqlHome = "SELECT * FROM district 
// INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
// INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
// WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."'";

// $queryHone = mysqli_query($conn,$sqlHome);
// $row = mysqli_fetch_array($queryHone);
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/User/".basename($image);
$sql ="INSERT INTO  user( U_UserName, U_Password, U_Name,Home, T_District, A_District, Province,zip,U_Phone, U_Photo, U_Status, U_Email) VALUES 
        ('$u_username','$pass','$u_name','$u_home','$u_tdistrict','$u_adistrict','$u_province','$u_zip','$u_phone','$image','user','$u_email') ";
move_uploaded_file($_FILES['image']['tmp_name'], $target);
$query = mysqli_query($conn,$sql);
if ($query){
  echo "<script type='text/javascript'>alert('สมัครสมาชิกสำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
    
  }else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
  }
}


?>