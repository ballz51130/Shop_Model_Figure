<?php 
include '../conn/conn.php';
session_start();
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
	<link rel="stylesheet" href="../product/css/showProduct.css">
	<title>Document</title>
</head>

<body>
</body>

<body>
	<div class="head_bar">
	</div>
	<div class="contriner">
		<div class="topmenu">
			<div class="row">
				<!-- โลโก้ -->
				<div class="col-md-3" id="homeicon" style="margin-left:px5;">
					<a href="../index.php"><img src="../photo/home.png" alt="" width="40px" hight="40px"></a>
				</div>

			</div>
		</div> <!-- topmenu -->
		<div class="maimMenu">
			<div class="container-fluid" style="margin-top:100px;padding:50px">
				<div class="content-wrapper">
					<div class="item-container">
						<div class="container">
							<div class="col-md-12">
								<div class="product col-md-3 service-image-left">


									<img src="<?php echo '../photo/Order/'.$result['P_Photo']; ?>" alt=""
										style="width:350px;height:321px;"> </img>

								</div>


							</div>
                            <form action="./UpdateOrder.php" method="post">
                            <input type="hidden" name="O_ID" value="<?php echo $_GET['O_ID']; ?>">
                            <input type="hidden" name="P_Number" value="<?php echo $_GET['P_Number']; ?>">
								<div class="col-md-7">
									<div class="product-title">ชื่อสินค้า</div>
									<div class="product-desc"><?php echo $result['P_Name'] ?></div>
									<br>
									<hr>
									<div class="product-price">฿ <?php echo$result['P_Price'] ?></div>
									<?php if($result['P_Unit']==0) {  ?>
									<?php if($result['P_Status'] == 1){ ?>
									<p class="card-text text-danger">สินค้าหมด</p>
									<?php } else {  ?>
									<div class="product-stock"><?php echo $result['St_Name'] ?></div>
									<?php } ?>
									<?php } else { ?>
									<div class="product-stock"><?php echo $result['St_Name'] ?></div>
									<?php } ?>
									<label for="">จำนวน</label>
									<?php if($result["P_Status"]==1){ ?>
									<input type="number" name="quantity" class="form-control" value="1" min="1"
										max="<?php echo $result['P_Unit']; ?>" style="width:80px">
									<?php } if($result["P_Status"]==2){ ?>
									<input type="number" name="quantity" class="form-control" value="1" min="1"
										style="width:80px">
									<?php  }?>
									<hr>
									<input type="hidden" name="P_Status" value="<?php echo $result["P_Status"]; ?>">
									<input name="P_Number" type="hidden" id="P_Number"
										value="<?php echo $result['P_Number']?>">
									<div class="btn-group cart">
										<?php if($result['P_Status']==1){ ?>
										<?php if($result['P_Unit'] > 0){ ?>
										<?php if ($_SESSION['login'] == ""){ ?>
										<a class="btn btn-success" href="../login/login.php"
											onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')">
											เพื่มเข้าตระกร้า</a>
										<?php } ?>
										<!-- End if session login-->
										<?php if ($_SESSION['login'] == 1){ ?>
										<input name="Save" type="submit" class="btn btn-success"
											value="เพื่มเข้าตระกร้า"
											onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
										<?php } ?>
										<!-- end if session log   in = 1 -->
										<?php }?>
										<?php if($result['P_Unit'] == 0){ ?>
										<p class="card-text text-danger">สินค้าหมด</p>
										<?php } ?>
										<?php } ?>
										<?php if($result['P_Status']==2){ ?>
										<?php if ($_SESSION['login'] == ""){ ?>
										<a class="btn btn-success" href="../login/login.php"
											onclick="return confirm('กรุณา Login ก่อนทำหารสั่งซื้อ')">
											เพื่มเข้าตระกร้า</a>
										<?php } ?>
										<!-- End if session login-->
										<?php if ($_SESSION['login'] == 1){ ?>
										<input name="Save" type="submit" class="btn btn-success"
											value="เพื่มเข้าตระกร้า"
											onclick="return confirm('คุณต้องการซื้อรายการนี้หรือไม่')">
										<?php } ?>
										<!-- end if session log   in = 1 -->
										<?php } ?>
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

					</div>
					<br>
					<div class="DetailPhoto">
						<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image1']; ?>" ></img>
						<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image2']; ?>" ></img>
						<img src="<?php echo '../photo/Order/orderdetail/'.$result['Pd_image3']; ?>" ></img>

					</div>
					<hr>
				</div>
			</div>

		</div>
	</div>
	<footer>
		<p> Power By Harumyx </p>
	</footer>
	</div>
	</div> <!-- contrinner-->


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
		integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
	</script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
		integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
	</script>

	<script>
		var mysrc = "";

		function changeImage() {
			if (mysrc == "mars.jpg") {
				document.images["pic"].src = "http://www.fluidoweb.com/images/SoloLearn/mars.jpg";
				document.images["pic"].alt = "Mars";
				mysrc = "earth.jpg";
			} else {
				document.images["pic"].src = "http://www.fluidoweb.com/images/SoloLearn/earth.jpg";
				document.images["pic"].alt = "Earth";
				mysrc = "mars.jpg";
			}
		}
	</script>
</body>

</html>