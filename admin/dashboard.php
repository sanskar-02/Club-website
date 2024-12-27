<?php

error_reporting(0);
include('includes/dbconnection.php');
// if (strlen($_SESSION['bpmsaid']==0)) {
//   header('location:logout.php');
//   } 
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Club | Admin</title>

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
	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->
	<!--Calender-->
	<link rel="stylesheet" href="css/clndr.css" type="text/css" />
	<script src="js/underscore-min.js" type="text/javascript"></script>
	<script src="js/moment-2.2.1.js" type="text/javascript"></script>
	<script src="js/clndr.js" type="text/javascript"></script>
	<script src="js/site.js" type="text/javascript"></script>
	<!--End Calender-->
	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
</head>

<body class="cbp-spmenu-push">
	<div class="main-content">

		<?php include_once('includes/sidebar.php'); ?>

		<?php include_once('includes/header.php'); ?>
		<!-- main content start-->
		<div id="page-wrapper" class="row calender widget-shadow">
			<div class="main-page">
				<div class="row calender widget-shadow">
					<div class="row-one">
						<!-- Total Clubs -->
						<div class="col-md-4 widget">
							<?php
							// Query to count total clubs
							$query1 = mysqli_query($con, "SELECT COUNT(*) AS TotalClubs FROM clubs"); // Replace 'clubs_table' with your actual clubs table name
							$result1 = mysqli_fetch_assoc($query1);
							$totalClubs = $result1['TotalClubs'] ?? 0; // Default to 0 if null
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Clubs</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $totalClubs; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>

						<!-- Total Bookings -->
						<div class="col-md-4 widget states-mdl">
							<?php
							// Query to count total bookings
							$query2 = mysqli_query($con, "SELECT COUNT(*) AS TotalBookings FROM club_bookings"); // Replace 'club_bookings' with your bookings table name
							$result2 = mysqli_fetch_assoc($query2);
							$totalBookings = $result2['TotalBookings'] ?? 0; // Default to 0 if null
							?>
							<div class="stats-left">
								<h5>Total</h5>
								<h4>Bookings</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $totalBookings; ?></label>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
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