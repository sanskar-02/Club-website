<!DOCTYPE HTML>
<html>

<head>
	<title>CLUB</title>
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- font CSS -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons -->
	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
	<!--webfonts-->
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<!--//webfonts-->
	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->
	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include_once('includes/sidebar.php'); ?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<?php include_once('includes/header.php'); ?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">View Enquiry</h3>



					<div class="table-responsive bs-example widget-shadow">


						<table class="table table-bordered mg-b-0" style="font-size: 20px;">

							<tr style="color: blue;font-size: 30px;text-align: center;">
								<td colspan="4">View Enquiry</td>
							</tr>

							<tr>
								<th>Name</th>
								<td>SSSSS</td>
								<th>Email</th>
								<td>AAAAAAAAA</td>

							</tr>
							<tr>
								<th>Contact No.</th>
								<td>111111111</td>
								<th>Query Date</th>
								<td>11111111111</td>
							</tr>
							<tr>

								<th>Message</th>
								<td colspan="4">aaaaaaaaaa ggggggggggg hhhhhhhhhh</td>
							</tr>
						</table><?php
								//    $cnt=$cnt+1;} 
								?>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- Classie -->
	<script src="js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById('cbp-spmenu-s1'),
			showLeftPush = document.getElementById('showLeftPush'),
			body = document.body;

		showLeftPush.onclick = function() {
			classie.toggle(this, 'active');
			classie.toggle(body, 'cbp-spmenu-push-toright');
			classie.toggle(menuLeft, 'cbp-spmenu-open');
			disableOther('showLeftPush');
		};

		function disableOther(button) {
			if (button !== 'showLeftPush') {
				classie.toggle(showLeftPush, 'disabled');
			}
		}
	</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
</body>

</html>