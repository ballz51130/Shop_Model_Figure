
<?php
require '../vendor/autoload.php';
include '../conn/conn.php';
// QUERY ADD USER
$sqladd ="SELECT * FROM user WHERE U_ID= '".$_GET['U_ID']."'";
$queryadd = mysqli_query($conn,$sqladd);
$resultadd = mysqli_fetch_array($queryadd);
// QUERY ADDRESS SHOP
$sqlshop ="SELECT * FROM user WHERE U_ID= '7'";
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
$T_Districtshop = $resultshop['T_District'];
$A_Districtshop = $resultshop['A_District'];
$Provinceshop = $resultshop['Province'];
$Zipshop = $resultshop['zip'];
// User ADDRESS
$name = $resultadd['U_Name'];
$Phone = $resultadd['U_Phone'];
$Home = $resultadd['Home'];
$T_District = $resultadd['T_District'];
$A_District = $resultadd['A_District'];
$Province = $resultadd['Province'];
$Zip = $resultadd['zip'];
// OrderNO
$Orderno = (string)$resultorder['O_ID']; 
$PickDate = date("d-m-Y", strtotime($resultorder['O_Date']));

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 18,
	'default_font' => 'sarabun'
]);

$mpdf->SetDocTemplate('../photo/report.pdf',true);
$mpdf->AddPage();
// TO ADDRESS
$mpdf->WriteHTML( '<div style="top:150px;left:100px;position:absolute;width:300px">'.$name.'</div>');
$mpdf->WriteHTML( '<div style="top:192px;left:100px;position:absolute;width:300px">'.$Phone.'</div>');
$mpdf->WriteHTML( '<div style="top:240px;left:110px;position:absolute;width:300px">'.$Home.'</div>');
$mpdf->WriteHTML( '<div style="top:265px;left:110px;position:absolute;width:300px">'.'ตำบล'.'&nbsp;'.$T_District.'</div>');
$mpdf->WriteHTML( '<div style="top:287px;left:110px;position:absolute;width:300px">'.'อำเภอ'.'&nbsp;'.$A_District.'</div>');
$mpdf->WriteHTML( '<div style="top:313px;left:110px;position:absolute;width:300px">'.'จังหวัด'.'&nbsp;'.$Province.'&nbsp;'.$Zip.'</div>');
// FROM ADDRESS
$mpdf->WriteHTML( '<div style="top:148px;left:470px;position:absolute;width:300px">'.$nameshop.'</div>');
$mpdf->WriteHTML( '<div style="top:182px;left:495px;position:absolute;width:300px">'.$Homeshop.'</div>');
$mpdf->WriteHTML( '<div style="top:208px;left:495px;position:absolute;width:300px">'.'ตำบล'.'&nbsp;'.$T_Districtshop.'</div>');
$mpdf->WriteHTML( '<div style="top:233px;left:495px;position:absolute;width:300px">'.'อำเภอ'.'&nbsp;'.$A_Districtshop.'</div>');
$mpdf->WriteHTML( '<div style="top:260px;left:495px;position:absolute;width:300px">'.'จังหวัด'.'&nbsp;'.$Provinceshop.'&nbsp;'.$Zipshop.'</div>');
// ORDER NO 
$mpdf->WriteHTML( '<div style="top:390px;left:130px;position:absolute;width:300px">'.$Orderno.'</div>');
$mpdf->WriteHTML( '<div style="top:424px;left:140px;position:absolute;width:300px">'.$PickDate.'</div>');
$mpdf->WriteHTML( '<div style="top:453px;left:140px;position:absolute;width:300px">'.'</div>');
//Payment
$mpdf->WriteHTML( '<div style="top:450px;left:470px;position:absolute;width:300px">'.''.'</div>');


$mpdf->Output();
?>