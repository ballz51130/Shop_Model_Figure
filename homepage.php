
<?php 
include './conn/conn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<!--    ไฟล์ทดสอบนี้ใช้ css ของ boostrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!--    มีการใช้งาน ajax ของ jquery-->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>  
</head>
<body>
 
 
<div class="container" style="width:300px;">
<br><br><br><br><br><br>
<table class="table table-striped" style="width:300px;">
   <tr class="active">
       <td colspan="2" class="text-center">
           จังหวัด อำเภอ ตำบล รหัสไปรษณีย์
       </td>
   </tr>
    <tr>
        <td width="100" class="text-right">
            จังหวัด
        </td>
        <td class="text-left">
            <select name="province_name" data-where="2" data-initval="1" class="ajax_address form-control input-sm">
                <option value="">-- เลือกจังหวัด --</option>
            </select>
        </td>        
    </tr>
    <tr>
        <td class="text-right">
            อำเภอ/เขต
        </td>
        <td class="text-left">
            <select name="amphur_name" data-where="3" data-initval="1"  class="ajax_address form-control input-sm">
                <option value="">-- เลือกอำเภอ/เขต --</option>
            </select>
        </td>        
    </tr>    
    <tr>
        <td class="text-right">
            ตำบล/แขวง
        </td>
        <td class="text-left">
            <select name="district_name" data-where="4" data-initval="100101"  class="ajax_address form-control input-sm">
                <option value="">-- เลือกตำบล/แขวง --</option>
            </select>
        </td>        
    </tr>   
    <tr>
        <td class="text-right">
            รหัสไปรษณีย์
        </td>
        <td class="text-left">
            <select name="zipcode_name" data-where="5"  data-initval="1"  class="ajax_address form-control input-sm">
                <option value="">-- เลือกรหัสไปรษณีย์ --</option>
            </select>
        </td>        
    </tr>           
</table>    
</div>        
     
<script type="text/javascript">
$(function(){
     
    // เมื่อโหลดขึ้นมาครั้งแรก ให้ ajax ไปดึงข้อมูลจังหวัดทั้งหมดมาแสดงใน
    // ใน select ที่ชื่อ province_name 
    // หรือเราไม่ใช้ส่วนนี้ก็ได้ โดยไปใช้การ query ด้วย php แสดงจังหวัดทั้งหมดก็ได้
    var IDSelected=$("select[name=province_name]").data("initval"); 
    $.post("getAddress.php",{
        IDSelected:IDSelected,
        IDTbl:1
    },function(data){
        $("select[name=province_name]").html(data);    
        $("select[name=province_name]").trigger("change");
    });
     
    // สร้างตัวแปร สำหรับเก็บค่าข้อความให้เลือกรายการ เช่น เลือกจังหวัด
    // เราจะเก็บค่านี้ไว้ใช้กรณีมีการรีเซ็ต หรือเปลี่ยนแปลงรายการใหม่
    var chooseText=[];
    $(".ajax_address").each(function(i,k){
        var initObj=$(".ajax_address").eq(i).find("option:eq(0)")[0];
        chooseText[i]=initObj;
    });
     
    // ส่วนของการตรวจสอบ และดึงข้อมูล ajax สังเกตว่าเราใช้ css คลาสชื่อ ajax_address
    // ดังนั้น css คลาสชื่อนี้จำเป็นต้องกำหนด หรือเราจะเปลี่ยนเป็นชื่ออื่นก็ได้ แต่จำไว้ว่า
    // ต้องเปลี่ยนในส่วนนี้ด้วย
    $(".ajax_address").on("change",function(){
        var indexObj = $(".ajax_address").index(this); // เก็บค่า index ไว้ใช้งานสำหรับอ้างอิง
        // วนลูปรีเซ็ตค่า select ของแต่ละรายการ โดยเอาค่าจาก array ด้านบนที่เราได้เก็บไว้
        $(".ajax_address").each(function(i,k){
            if(i>indexObj){ // รีเซ็ตค่าของรายการที่ไม่ได้เลือก
                $(".ajax_address").eq(i).html(chooseText[i]);
            }
        });
         
        var obj=$(this);        
        var IDCheck=obj.val();  // ข้อมูลที่เราจะใช้เช็คกรณี where เช่น id ของจังหวัด
        var IDWhere=obj.data("where"); // ค่าจาก data-where ค่าน่าจะเป็นตัวฟิลด์เงื่อนไขที่เราจะใช้
        var targetObj=$("select[data-where='"+(IDWhere+1)+"']"); // ตัวที่เราจะเปลี่ยนแปลงข้อมูล
        var IDSelected=targetObj.data("initval");           
        if(targetObj.length>0){ // ถ้ามี obj เป้าหมาย
            targetObj.html("<option>.. กำลังโหลดข้อมูล.. </option>");  // แสดงสถานะกำลังโหลด  
            setTimeout(function(){ // หน่วงเวลานิดหน่อยให้เห็นการทำงาน ตัดเออกได้
                // ส่งค่าไปทำการดึงข้อมูล option ตามเงื่อนไข
                 $.post("getAddress.php",{
                    IDTbl:IDWhere,
                    IDCheck:IDCheck,
                    IDSelected:IDSelected,
                    IDWhere:IDWhere-1
                },function(data){
                    targetObj.html(data);   // แสดงค่าผลลัพธ์
                    targetObj.trigger("change");
                });    
            },1500);
        }
    });
     
});
</script>    
 
     
</body>
</html>