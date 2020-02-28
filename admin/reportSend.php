


<?php
include '../vendor/autoload.php';
include '../conn/conn.php';

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 18,
	'default_font' => 'sarabun'
]);
$sss ="asdsd";
$mpdf->WriteHTML('<h1>Hello  สวะสหพworld!'.$sss);
$mpdf->Output();
?>