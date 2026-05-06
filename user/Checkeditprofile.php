<?php
include '../conn/conn.php';
session_start();
$image = $_FILES['image']['name'];
$pass = md5($_POST['U_Password']."harumyx");
$target = "../photo/User/".basename($image);

$u_username = mysqli_real_escape_string($conn, $_POST['U_UserName']);
$u_name = mysqli_real_escape_string($conn, $_POST['U_Name']);
$u_home = mysqli_real_escape_string($conn, $_POST['Home']);
$u_tdistrict = mysqli_real_escape_string($conn, $_POST['T_District']);
$u_adistrict = mysqli_real_escape_string($conn, $_POST['A_District']);
$u_province = mysqli_real_escape_string($conn, $_POST['Province']);
$u_zip = mysqli_real_escape_string($conn, $_POST['zip']);
$u_phone = mysqli_real_escape_string($conn, $_POST['U_Phone']);
$u_email = mysqli_real_escape_string($conn, $_POST['Email']);
$u_id = mysqli_real_escape_string($conn, $_POST['U_ID']);

if($_FILES['image']['name']!=""){
if($_POST['U_Password']==""){ // pass no change 
    if ($_POST['Province'] == 0 ){
        $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";   
        $query = mysqli_query($conn,$sqledit);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($_SESSION['User'] == '1'){
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           }
        }
        else{
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
               }  
        }

    }
    else {
        // แปลงตัวเลข ตำบล อำเภอ จังหวัด ให้เป็น ชื่อ ค่าที่ POST มาเป็นตัวเลข
    // $sqlHome = "SELECT * FROM district 
    // INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
    // INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
    // WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."',zip='".$_POST['zip']."'";
    // $queryHone = mysqli_query($conn,$sqlHome);
    // $row = mysqli_fetch_array($queryHone);
    $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',T_District='$u_tdistrict',A_District='$u_adistrict',Province='$u_province',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";
     $query = mysqli_query($conn,$sqledit);
     move_uploaded_file($_FILES['image']['tmp_name'], $target);
     if($_SESSION['User'] == '1'){
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           }
        }
        else{
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
               }  
        }
     
    }

}
else{ //pass change

    if ($_POST['Province' ]== 0 ){
        $sqledit = "UPDATE user SET U_UserName='$u_username',U_Password='$pass',U_Name='$u_name',Home='$u_home',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";   
        $query = mysqli_query($conn,$sqledit);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        if($_SESSION['User'] == '1'){
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               }
            }
            else{
                if($query){
                    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                    
                   } 
                   else{
                       echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                       echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                   }  
            }
    
    }
    else {
    // $sqlHome = "SELECT * FROM district 
    // INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
    // INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
    // WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."',zip='".$_POST['zip']."'";
    // $queryHone = mysqli_query($conn,$sqlHome);
    // $row = mysqli_fetch_array($queryHone);
    $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',T_District='$u_tdistrict',A_District='$u_adistrict',Province='$u_province',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";
    $query = mysqli_query($conn,$sqledit);
     move_uploaded_file($_FILES['image']['tmp_name'], $target);
     $query = mysqli_query($conn,$sqledit);
     if($_SESSION['User'] == '1'){
        if($query){
            echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
            echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           } 
           else{
               echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
               echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
           }
        }
        else{
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
               }  
        }
     
    }

}
} // end if image != ""

else{ // image = ""
    if($_POST['U_Password']==""){ // pass no change 
        
        if ($_POST['Province']== 0 ){
            $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',zip='$u_zip',U_Phone='$u_phone',U_Email='$u_email' WHERE U_ID='$u_id'";   
            $query = mysqli_query($conn,$sqledit);
            if($_SESSION['User'] == '1'){
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               }
            }
            else{
                if($query){
                    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                    
                   } 
                   else{
                       echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                       echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                   }  
            }
    
        }
        else {
            // แปลงตัวเลข ตำบล อำเภอ จังหวัด ให้เป็น ชื่อ ค่าที่ POST มาเป็นตัวเลข
        // $sqlHome = "SELECT * FROM district 
        // INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
        // INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
        // WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."',zip='".$_POST['zip']."'";
        // $queryHone = mysqli_query($conn,$sqlHome);
        // $row = mysqli_fetch_array($queryHone);
        $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',T_District='$u_tdistrict',A_District='$u_adistrict',Province='$u_province',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";
         $query = mysqli_query($conn,$sqledit);
         if($_SESSION['User'] == '1'){
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               }
            }
            else{
                if($query){
                    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                    
                   } 
                   else{
                       echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                       echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                   }  
            }
         
        }
    
    }
    else{ //pass change
        if ($_POST['Province']== 0 ){
            $sqledit = "UPDATE user SET U_UserName='$u_username',U_Password='$pass',U_Name='$u_name',Home='$u_home',zip='$u_zip',U_Phone='$u_phone',U_Email='$u_email' WHERE U_ID='$u_id'";
            $query = mysqli_query($conn,$sqledit);
            if($_SESSION['User'] == '1'){
                if($query){
                    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
                   } 
                   else{
                       echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                       echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
                   }
                }
                else{
                    if($query){
                        echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                        echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                        
                       } 
                       else{
                           echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                           echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                       }  
                }
        
        }
        else {
        // $sqlHome = "SELECT * FROM district 
        // INNER JOIN amphur ON amphur.AMPHUR_ID = district.AMPHUR_ID
        // INNER JOIN province ON province.PROVINCE_ID = district.PROVINCE_ID
        // WHERE district.AMPHUR_ID='".$_POST['A_District']."' AND district.DISTRICT_ID = '".$_POST['T_District']."' AND district.PROVINCE_ID = '".$_POST['Province']."',zip='".$_POST['zip']."'";
        // $queryHone = mysqli_query($conn,$sqlHome);
        // $row = mysqli_fetch_array($queryHone);
        $sqledit = "UPDATE user SET U_UserName='$u_username',U_Name='$u_name',Home='$u_home',T_District='$u_tdistrict',A_District='$u_adistrict',Province='$u_province',zip='$u_zip',U_Phone='$u_phone',U_Photo='$image',U_Email='$u_email' WHERE U_ID='$u_id'";
         $query = mysqli_query($conn,$sqledit);
         if($_SESSION['User'] == '1'){
            if($query){
                echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               } 
               else{
                   echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                   echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=../admin/ManageUser.php'>";
               }
            }
            else{
                if($query){
                    echo '<script type="text/javascript">alert("บันทึกสำเร็จ");</script>';
                    echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                   } 
                   else{
                       echo '<script type="text/javascript">alert("เกิดข้อผิดพลาดขึ้น");</script>';
                       echo"<META HTTP-EQUIV ='Refresh' CONTENT = '1;URL=./EditUser.php'>";
                   }  
            }
         
        }
}
}

?>