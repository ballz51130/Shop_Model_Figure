<?php
include '../conn/conn.php';
$O_status=$_GET['O_status'];
$user = $_GET['user'];
echo $O_status;
echo "<br>";
echo $user;

$sql = "SELECT orders.O_ID, orders.P_Number,product.P_Name,user.U_ID,user.U_FName,orders.O_Unit,product.P_Price,orders.O_Status FROM orders
INNER JOIN product ON orders.P_Number = product.P_Number
INNER JOIN user ON orders.U_ID = user.U_ID WHERE orders.U_ID= '$user' AND orders.O_Status='รอตรวจสอบ' ";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_array($query)

?>
<form name='EditMem' method='POST' action='UpdateMem.php'>
<center><h3>Update Mem</h3>
<table>
    <tbody>
        <tr>
            <td width="125"> &nbsp;Name</td>
            <td widrh="180">
                <input name="txtName"type="text" id="txtName" value="<?php echo $result['O_ID'];?>">
               
        </tbody>
        </table>
        <br>
            <center>
                <input type="submit" name="Submit" value="Save">
                </center>
    </form>