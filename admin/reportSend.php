
<?php
include '../vendor/autoload.php';
include '../conn/conn.php';
$sqladd ="SELECT * FROM user WHERE U_ID= '".$_GET['U_ID']."'";
$queryadd = mysqli_query($conn,$sqladd);
$resultadd = mysqli_fetch_array($queryadd);

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 18,
	'default_font' => 'sarabun'
]);
$stylesheet = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
$mpdf->WriteHTML($stylesheet,1);
$name = "";
$phone = $resultadd['U_Phone'];
$mpdf->WriteHTML('
<table>
<tr>
<th style="border: solid 0.5px black; width:500px; height:100px; padding:40px;margin-top:50px;">asd</th>
<th style="border: solid 0.5px black; width:500px; height:100px; padding:40px;margin-top:50px;">asda</th>
</tr>  
<tr>
<td>asd</td>
</tr>  
</table>
');

$mpdf->Output();
?>