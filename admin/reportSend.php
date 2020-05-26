
<?php
require '../vendor/autoload.php';
include '../conn/conn.php';
// QUERY ADD USER
$sqladd ="SELECT * FROM user 
INNER JOIN district ON district.DISTRICT_ID = user.T_District
INNER JOIN amphur ON amphur.AMPHUR_ID = user.A_District
INNER JOIN province ON province.PROVINCE_ID = user.Province
WHERE U_ID= '".$_GET['U_ID']."'";
$queryadd = mysqli_query($conn,$sqladd);
$resultadd = mysqli_fetch_array($queryadd);
// QUERY ADDRESS SHOP
$sqlshop ="SELECT * FROM user 
INNER JOIN district ON district.DISTRICT_ID = user.T_District
INNER JOIN amphur ON amphur.AMPHUR_ID = user.A_District
INNER JOIN province ON province.PROVINCE_ID = user.Province
WHERE U_ID= '7'";
$queryshop = mysqli_query($conn,$sqlshop);
$resultshop = mysqli_fetch_array($queryshop);
// QUERY ORDER
$sqlorder ="SELECT * FROM orders WHERE O_ID='".$_GET['O_ID']."'";
$queryorder = mysqli_query($conn,$sqlorder);
$resultorder = mysqli_fetch_array($queryorder);
// Admin ADDRESS
$nameshop = $resultshop['U_Name'];
$Phoneshop = $resultshop['U_Phone'];
$Homeshop = $resultshop['Home'];
$T_Districtshop = $resultshop['DISTRICT_NAME'];
$A_Districtshop = $resultshop['AMPHUR_NAME'];
$Provinceshop = $resultshop['PROVINCE_NAME'];
$Zipshop = '51130';
// User ADDRESS
$name = $resultadd['U_Name'];
$Phone = $resultadd['U_Phone'];
$Home = $resultadd['Home'];
$T_District = $resultadd['DISTRICT_NAME'];
$A_District = $resultadd['AMPHUR_NAME'];
$Province = $resultadd['PROVINCE_NAME'];
$Zip = $resultadd['zip'];

$order = $resultorder['O_ID'];
$date = $resultorder['O_Date'];
$newDate = date("d-m-Y", strtotime($date));

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 18,
	'default_font' => 'sarabun'
]);

$mpdf->SetDocTemplate('../photo/report2.pdf',true);
$mpdf->AddPage();
$mpdf->WriteHTML( '<div style="top:13px;left:650px;position:absolute;width:300px">'.'<b>'.$order.'</b>'.'</div>');
$mpdf->WriteHTML( '<div style="top:50px;left:660px;position:absolute;width:300px">'.'<b>'.$newDate.'</b>'.'</div>');
// FROM ADDRESS
$mpdf->WriteHTML( '<div style="top:310px;left:30px;position:absolute;width:300px">'.'<b>'.'ชื่อ'.'</b>'.'</div>'.'<div style="top:310px;left:70px;position:absolute;width:300px">'.$nameshop.'</div>');
$mpdf->WriteHTML( '<div style="top:355px;left:30px;position:absolute;width:300px">'.'<b>'.'เบอร์โทรศัพท์'.'</b>'.'</div>'.'<div style="top:355px;left:130px;position:absolute;width:300px">'.$Phoneshop.'</div>');
$mpdf->WriteHTML( '<div style="top:400px;left:30px;position:absolute;width:300px">'.'<b>'.'ที่อยู่'.'</b>'.'</div>'.'<div style="top:400px;left:80px;position:absolute;width:300px">'.$Homeshop.'</div>');
$mpdf->WriteHTML( '<div style="top:430px;left:80px;position:absolute;width:300px">'.'ตำบล'.'</div>'.'<div style="top:430px;left:130px;position:absolute;width:300px">'.$T_Districtshop.'</div>');
$mpdf->WriteHTML( '<div style="top:460px;left:80px;position:absolute;width:300px">'.'อำเภอ'.'</div>'.'<div style="top:460px;left:130px;position:absolute;width:300px">'.$A_Districtshop.'</div>');
$mpdf->WriteHTML( '<div style="top:490px;left:80px;position:absolute;width:300px">'.'จังหวัด'.'</div>'.'<div style="top:490px;left:130px;position:absolute;width:300px">'.$Provinceshop.'&nbsp;'.$Zipshop.'</div>');
// TO ADDRESS
$mpdf->WriteHTML( '<div style="top:310px;left:410px;position:absolute;width:300px">'.'<b>'.'ชื่อ'.'</b>'.'</div>'.'<div style="top:310px;left:450px;position:absolute;width:300px">'.$name.'</div>');
$mpdf->WriteHTML( '<div style="top:355px;left:410px;position:absolute;width:300px">'.'<b>'.'เบอร์โทรศัพท์'.'</b>'.'</div>'.'<div style="top:355px;left:510px;position:absolute;width:300px">'.$Phone.'</div>');
$mpdf->WriteHTML( '<div style="top:400px;left:410px;position:absolute;width:300px">'.'<b>'.'ที่อยู่'.'</b>'.'</div>'.'<div style="top:400px;left:460px;position:absolute;width:300px">'.$Home.'</div>');
$mpdf->WriteHTML( '<div style="top:430px;left:460px;position:absolute;width:300px">'.'ตำบล'.'</div>'.'<div style="top:430px;left:505px;position:absolute;width:300px">'.$T_District.'</div>');
$mpdf->WriteHTML( '<div style="top:460px;left:460px;position:absolute;width:300px">'.'อำเภอ'.'</div>'.'<div style="top:460px;left:505px;position:absolute;width:300px">'.$A_District.'</div>');
$mpdf->WriteHTML( '<div style="top:490px;left:460px;position:absolute;width:300px">'.'จังหวัด'.'</div>'.'<div style="top:490px;left:505px;position:absolute;width:300px">'.$Province.'&nbsp;'.$Zip.'</div>');


$mpdf->Output();
?>