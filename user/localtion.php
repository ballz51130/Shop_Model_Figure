<?php
    include "../conn/conn.php";
session_start();
$sqluser="SELECT * FROM user WHERE U_ID='".$_SESSION['User']."'";
$queryuser = mysqli_query($conn,$sqluser);
$resultuser = mysqli_fetch_array($queryuser,MYSQLI_ASSOC);

    header("content-type: text/html; charset=utf-8");
    header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    $data = $_GET['data'];
    $val = $_GET['val'];


         if ($data=='province') { 
              echo "<select class='form-control' name='Province' onChange=\"dochange('amphur', this.value)\">";
              if(!$_SESSION['User']){
               echo "<option value='1'>- เลือกจังหวัด -</option>\n";
              }
              else{
              echo "<option value='0'>" ?> <?php echo $resultuser['Province']; ?> <?php echo "</option>\n";
              }
              $result=mysqli_query($conn,"select * from province order by PROVINCE_NAME");
              while($row = mysqli_fetch_array($result)){
                   echo "<option value='$row[PROVINCE_ID]' >$row[PROVINCE_NAME]</option>" ;
              }
         } else if ($data=='amphur') {
              echo "<select class='form-control' name='A_District' onChange=\"dochange('district', this.value)\">";
              echo "<option value='0'>- เลือกอำเภอ -</option>\n";                             
              $result=mysqli_query($conn,"SELECT * FROM amphur WHERE PROVINCE_ID= '$val' ORDER BY AMPHUR_NAME");
              while($row = mysqli_fetch_array($result)){
                   echo "<option value=\"$row[AMPHUR_ID]\" >$row[AMPHUR_NAME]</option> " ;
              }
         } else if ($data=='district') {
              echo "<select class='form-control' name='T_District'>\n";
              echo "<option value='0'>- เลือกตำบล -</option>\n";
              $result=mysqli_query($conn,"SELECT * FROM district WHERE AMPHUR_ID= '$val' ORDER BY DISTRICT_NAME");
              while($row = mysqli_fetch_array($result)){
                   echo "<option class='form-control' value=\"$row[DISTRICT_ID]\" >$row[DISTRICT_NAME]</option> \n" ;
              }
         }
         echo "</select>\n";

  
?>