<?php 
include '../conn/conn.php';
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
$sqlCheckUser="SELECT U_UserName FROM user WHERE U_UserName='".$_POST['U_UserName']."'";
$queryCheckUser = $conn->query($sqlCheckUser);
$resultCheckUser = mysqli_fetch_array($queryCheckUser,MYSQLI_ASSOC);
if($resultCheckUser > 0){
    echo "<script type='text/javascript'>alert('ชื่อผู้ใช้บัญชีมีการใช้งานแล้ว กรุณาใช้ชื่ออื่น');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL=../index.php'>";
}
else{
// แปลงตัวเลข ตำบล อำเภอ จังหวัด ให้เป็น ชื่อ ค่าที่ POST มาเป็นตัวเลข
$sqlHome = "SELECT * FROM district 
INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."'";
$queryHone = mysqli_query($conn,$sqlHome);
$row = mysqli_fetch_array($queryHone);
// Get text
$image_text = mysqli_real_escape_string($conn, $_POST['image_text']);
// image file directory
$target = "../photo/User/".basename($image);

$sql ="INSERT INTO  user( U_UserName, U_Password, U_Name,Home, T_District, A_District, Province, zip, U_Phone, U_Photo, U_Status, U_Email) VALUES 
        ('".$_POST['U_UserName']."','$pass','".$_POST['U_Name']."','".$_POST['Home']."','".$row['DISTRICT_NAME']."','".$row['AMPHUR_NAME']."','".$row['PROVINCE_NAME']."','".$_POST['zip']."','".$_POST['U_Phone']."','$image','user','".$_POST['Email']."') ";
move_uploaded_file($_FILES['image']['tmp_name'], $target);
$query = mysqli_query($conn,$sql);

if ($query){
  echo "<script type='text/javascript'>alert('สมัครสมาชิกสำเร็จ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.phpp'>";
    
  }else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด ไม่สามารถเพอ่มข้อมูลได้ ');</script>";
    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '0;URL= ../login/login.php'>";
  }
}


?>