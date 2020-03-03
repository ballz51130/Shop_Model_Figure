<?php 
include '../conn/conn.php';
$sql = "SELECT * FROM product
        INNER JOIN status_tb ON status_tb.St_Number = product.P_Status
		INNER JOIN productdetail ON productdetail.P_Number = product.P_Number
        WHERE product.P_Number='".$_GET['P_Number']."'";
   	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="./css/showProduct.css">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
				<div class="col-md-12">
					<div class="product col-md-3 service-image-left">
            
						
							<img id="item-display" src="<?php echo '../photo/Order/'.$result['P_Photo']; ?>" alt="" style="width:350px;height:321px;"> </img>
						
					</div>
					
					<div class="container service1-items col-sm-2 col-md-2 pull-left">
						<center>
							<a id="item-1" class="service1-item">
								<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image1']; ?>" alt=""></img>
							</a>
							<a id="item-2" class="service1-item">
								<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image2']; ?>" alt=""></img>
							</a>
							<a id="item-3" class="service1-item">
								<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image3']; ?>" alt=""></img>
							</a>
						</center>
					</div>
				</div>
				<form action="../order/InsertOrder.php" method="post">	
				<div class="col-md-7">
					<div class="product-title">ชื่อสินค้า</div>
					<div class="product-desc"><?php echo $result['P_Name'] ?></div>
					<br>
					<hr>
					<div class="product-price">฿ <?php echo$result['P_Price'] ?></div>
					<div class="product-stock"><?php echo $result['St_Name'] ?></div>
					<label for="">จำนวน</label>
					<input type="text" name="quantity" class="form-control" value="1" style="width:50px">
					<hr>
					<input type="hidden" name="P_Status" value="<?php echo $result["P_Status"]; ?>">
					<input name="P_Number" type="hidden" id="P_Number" value="<?php echo $result['P_Number']?>">
					<div class="btn-group cart">
						<button type="submit" class="btn btn-success">เพิ่มเข้าตระกร้า
						</button>
					</form>
					
					</div>
				</div>
			</div> 
		</div>
		<div class="container-fluid">		
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">รายระเอียด</a></li>
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
						 
							<section class="container product-info">
								<h3><?php echo $result['P_Name']; ?></h3>
								<li>รายระเอียด : <?php echo $result['P_Detel']; ?></li>
								<li>ราคา : <?php echo $result['P_Price']; ?></li>
								<li> แบรนด์ : <?php echo $result['P_Brand']; ?></li>
								<li>น้ำหนัก : <?php echo $result['P_weight']; ?> กรัม</li>
								<li>จำนวน : <?php echo $result['P_Unit']; ?> ชิ้น</li>
								<li>ประเภท : <?php echo $result['P_Group']; ?></li>
								<li>สถานะ : <?php echo $result['St_Name']; ?> </li>
							</section>
										  
						</div>
					<div class="tab-pane fade" id="service-two">
						
						<section class="container">
								
						</section>
						
					</div>
					<div class="tab-pane fade" id="service-three">
												
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>  
</body>
</html>