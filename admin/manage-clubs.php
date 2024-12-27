<?php


session_start();
include_once 'includes/dbconnection.php';

// Delete functionality
if (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $query = mysqli_query($con, "DELETE FROM Clubs WHERE Id='$delid'");

    if ($query) {
        echo "<script>alert('Club has been deleted successfully.');</script>";
        echo "<script>window.location.href='manage-clubs.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
}

$query = mysqli_query($con, "SELECT * FROM Clubs");
?>



<!DOCTYPE HTML>
<html>

<head>
	<title>Club</title>

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
					<h3 class="title1">Manage Clubs</h3>



					<div class="table-responsive bs-example widget-shadow">
						<h4>Updated Clubs:</h4>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Club Name</th>
									<th>Club Price</th>
									<th>Club Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$cnt = 1; // Counter for serial number
								while ($row = mysqli_fetch_assoc($query)) {
								?>
									<tr>
										<th scope="row"><?php echo $cnt++; ?></th>
										<td><?php echo htmlspecialchars($row['ClubName']); ?></td>
										<td><?php echo htmlspecialchars($row['Cost']); ?></td>
										<td><img src="images/<?php echo htmlspecialchars($row['Image']); ?>" alt="Club Image" style="width: 100px; height: auto;"></td>
										<td>
											<a href="edit-clubs.php?editid=<?php
																			echo $row['Id']; ?>" class="btn btn-primary">Edit</a>
											<a href="manage-clubs.php?delid=<?php
																			 echo $row['Id']; 
																			?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
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
<?php
// }  
?>