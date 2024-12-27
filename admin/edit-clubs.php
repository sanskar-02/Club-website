<?php
// session_start();
error_reporting(0);
include('includes/dbconnection.php');
 // Fetch club details
 if (isset($_GET['editid'])) {
	$editid = $_GET['editid'];
	$query = mysqli_query($con, "SELECT * FROM Clubs WHERE ID = '$editid'");
	$row = mysqli_fetch_array($query);

	if (!$row) {
		echo "<script>alert('Invalid Club ID.');</script>";
		echo "<script>window.location.href = 'manage-clubs.php';</script>";
		exit;
	}
}

// handle form submission
if (isset($_POST['submit'])) {
	$clubname = $_POST['clubname'];
	$clubdesc = $_POST['clubdesc'];
	$cost = $_POST['cost'];
	$opens = $_POST['opens'];
	$closes = $_POST['closes'];
	$image = $_FILES["image"]["name"];

	$eid = $_GET['editid'];

	// Handle image upload if a new image is provided
	if ($image) {
		// Get file extension
		$extension = substr($image, strrpos($image, '.'));
		// Allowed extensions
		$allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

		if (!in_array($extension, $allowed_extensions)) {
			echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif formats are allowed.');</script>";
		} else {
			// Rename the image file
			$newimage = md5($image) . time() . $extension;
			move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $newimage);

			// Update with new image
			$query = mysqli_query($con, "UPDATE Clubs 
                                             SET ClubName = '$clubname', 
                                                 ClubDescription = '$clubdesc', 
                                                 Cost = '$cost', 
                                                 Opens_at = '$opens', 
                                                 Closed_at = '$closes', 
                                                 Image = '$newimage' 
                                             WHERE ID = '$eid'");
		}
	} else {
		// Update without changing the image
		$query = mysqli_query($con, "UPDATE Clubs 
                                         SET ClubName = '$clubname', 
                                             ClubDescription = '$clubdesc', 
                                             Cost = '$cost', 
                                             Opens_at = '$opens', 
                                             Closed_at = '$closes' 
                                         WHERE ID = '$eid'");
	}

	if ($query) {
		echo "<script>alert('Club details have been updated.');</script>";
		echo "<script>window.location.href = 'manage-clubs.php;</script>";
		exit;
	} else {
		echo "<script>alert('Something went wrong. Please try again.');</script>";
	}
}

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
				<div class="forms">
					<h3 class="title1">Update Clubs</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
						<div class="form-body">
							<form method="post" enctype="multipart/form-data"> <!-- Added enctype for file upload -->

								<?php
								$cid = $_GET['editid'];
								$ret = mysqli_query($con, "SELECT * FROM Clubs WHERE ID='$cid'"); // Adjusted the table name to `Clubs`
								$cnt = 1;
								while ($row = mysqli_fetch_array($ret)) {
								?>

									<div class="form-group">
										<label for="exampleInputEmail1">Club Name</label>
										<input type="text" class="form-control" id="clubname" name="clubname" placeholder="Club Name" value="<?php echo htmlspecialchars($row['ClubName']); ?>" required="true">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Club Description</label>
										<textarea type="text" class="form-control" id="clubdesc" name="clubdesc" placeholder="Club Description" required="true"><?php echo htmlspecialchars($row['ClubDescription']); ?></textarea>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Cost</label>
										<input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="<?php echo htmlspecialchars($row['Cost']); ?>" required="true">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Opens At</label>
										<input type="text" id="opens" name="opens" class="form-control" placeholder="Opens At" value="<?php echo htmlspecialchars($row['Opens_at']); ?>" required="true">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Closes At</label>
										<input type="text" id="closes" name="closes" class="form-control" placeholder="Closes At" value="<?php echo htmlspecialchars($row['Closed_at']); ?>" required="true">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Image</label>
										<img src="images/<?php echo htmlspecialchars($row['Image']); ?>" width="120" alt="Club Image">
										<a href="update-img.php?lid=<?php echo $row['Id']; ?>">Update Image</a>
									</div>
								<?php } ?>
								<button type="submit" name="submit" class="btn btn-default">Update</button>
							</form>

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