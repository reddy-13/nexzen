<?php 
if(isset($student_detail)):

	?>
	<!DOCTYPE html>
	<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>ID Genrator</title>
		<meta http-equiv="cache-conrol" content="no-cache">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
		</script>
  <!--   <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
  </script> -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<style media="screen">
	h1,h2.h3,h4{
		margin: 0px;
		padding: 0px;
	}

	body {
		font-family: 'Roboto', sans-serif;
		color: #2D354A;;

	}

	.cnt{
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 1%;
	}
	#htmlContent{
		background: white;
		display: flex;
		width: 350px;
		height: 550px;
	}

	.card {
		/*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);*/
		/*max-width: 300px;*/
		margin: auto !important;
		text-align: center !important;
		font-family: 'Roboto', sans-serif !important;
		width: 100% !important;
		height: 100% !important;
		background: linear-gradient(-155deg,#850d23 0%,#c1224f 36%, #fff 30.5%, #fff 100%) !important;
		border: 2px solid #850d23 !important;

	}

	button:hover, a:hover {
		opacity: 0.7;
	}
	.details{
		display: block;
		width: 100%;
		text-align: left;
		/*text-transform: uppercase;*/
		font-size: 15px;
	}
	.left{
		float: left;
		width: 50%;
		text-align: left;

	}
	.details p {
		padding-inline-start :30px;
		margin: 5px 0px;

		line-height: 1.5rem;

	}
	.details ul{
		margin: 0px;
		list-style: none;
		padding-inline-start :30px;

	}
	.details ul li{
		margin: 5px 0px;
	}
	span{
		color: #850d23	;
		font-weight: 500;
	}
	.right{
		float: right;
		width: 50%;
		text-align: left;
	}


	a{
		background-color: #468ebc;
		color: #fff;
		padding: 10px;
		border: none;
		text-decoration: none;
		cursor: pointer;

	}
</style>
<body onload = "autoClick();">

	<?php 
  	// echo "<pre>";
  		// print_r($student_detail);
  		// exit;
	?>
	<a href="<?php echo site_url('student/student_detail/'.$student_detail->student_id);?>">back</a>
	<a href="<?php echo site_url('student/edit_student/'.$student_detail->student_id);?>">Edit</a>
	<a href="<?php echo site_url('student/list_student');?>">LIST STUDENTS</a>
	<div class="cnt">
		<div id = "htmlContent">

			<div class="card">
				<div class="card-header">
					<h2 style="color:#fff;">MY REDEEMER MISSION SCHOOL</h2>
					<img src="<?php echo !isset($student_detail->student_photo) === '' ? base_url('uploads/studentphoto/'.$student_detail->student_photo) : base_url('uploads/studentphoto/').'default.jpg';?>" alt="John" style="width:150px;
						height: 150px;
						border-radius:
						50%;margin-top: 5%;
						border: 4px solid #850d23;
						">
					</div>
					<h2><?php echo $student_detail->student_name; ?></h2>
					<div class="details">

						<p ><span>Father's Name</span> : <?=$student_detail->student_father_name;?></p>

						<div class="left">
							<ul>
								<li><span>Class </span>:<?=$student_detail->standard_title;?></li>
								<li><span>Bloog Group </span> :<?php echo $student_detail->student_blood_group;?></li>
							</ul>
						</div>
						<div class="right">
							<ul>
								<li><span>Roll no</span> : <?=$student_detail->student_roll_no;?></li>
								<li><span>DOB</span>: <?=$student_detail->student_birthdate?></li>
							</ul>
						</div>
						<p><span>Mobile </span>: <?=$student_detail->student_parent_phone?></p>
						<p><span>Address</span>: <?=$student_detail->student_address;?></p>
					</div>

				</div>
			</div>
		</div>
		<div style="display:block; margin-top: 10px; text-align: center;">	
			<a id="download">Download</a>
		</div>

		<script type="text/javascript">
			function autoClick(){
				$("#download").click();
			}

			$(document).ready(function(){
				var element = $("#htmlContent");

				$("#download").on('click', function(){

					html2canvas(element.get(0)).then(function(canvas) {
						var imageData = canvas.toDataURL("image/jpg");
						var newData = imageData.replace(/^data:image\/jpg/, "data:application/octet-stream");
						$("#download").attr("download", "<?php echo str_replace(' ','_',$student_detail->student_name);?>.jpg").attr("href", newData);
					});

				});
			});
		</script>
	</body>
	</html>

<?php else: ?>

	<?php echo "No Data found" ?>

	<?php endif; ?>