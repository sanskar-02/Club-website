<?php
session_start();
include_once 'includes/dbconnection.php';

if (isset($_POST['submit'])) {
    $clubname = $_POST['clubname'];
    $clubdesc = $_POST['clubdesc'];
    $cost = $_POST['cost'];
    $opens = $_POST['opens'];
    $closes = $_POST['closes'];
    $image = $_FILES["image"]["name"]; // Correct way to get file name

    // Get the image extension
    $extension = substr($image, strrpos($image, '.'));
    
    // Allowed extensions
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

    // Validate the image file extension
    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif formats are allowed.');</script>";
    } else {
        // Rename the image file
        $newimage = md5($image) . time() . $extension;

        // Move the uploaded file to the "images/" directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $newimage)) {
            // Corrected SQL query to include all columns
            $query = mysqli_query($con, "INSERT INTO Clubs (ClubName, ClubDescription, Cost, Opens_at, Closed_at, Image) 
                                         VALUES ('$clubname', '$clubdesc', '$cost', '$opens', '$closes', '$newimage')");

            if ($query) {
                echo "<script>alert('Club has been added.');</script>";
                echo "<script>window.location.href = 'manage-clubs.php'</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the image. Please try again.');</script>";
        }
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
					<h3 class="title1">Add Clubs</h3>
					<div class="form-grids row widget-shadow" data-example-id="basic-forms">
						<div class="form-title">
							<h4>Clubs:</h4>
						</div>
						<div class="form-body">
							<form method="post" enctype="multipart/form-data">																																			
								<div class="form-group"> <label for="exampleInputEmail1">Club Name</label> <input type="text" class="form-control" id="clubname" name="clubname" placeholder="Club Name" value="" required="true"> </div>
								<div class="form-group"> <label for="exampleInputEmail1">Club Description</label> <textarea type="text" class="form-control" id="clubname" name="clubdesc" placeholder="Club Details" value="" required="true"></textarea> </div>
								<div class="form-group"> <label for="exampleInputPassword1">Cost</label> <input type="text" id="cost" name="cost" class="form-control" placeholder="Cost" value="" required="true"> </div>
								<div class="form-group"> <label for="exampleInputPassword1">Opens at</label> <input type="text" id="cost" name="opens" class="form-control" placeholder="Opens at" value="" required="true"> </div>
								<div class="form-group"> <label for="exampleInputPassword1">Closed at</label> <input type="text" id="cost" name="closes" class="form-control" placeholder="Closed at" value="" required="true"> </div>
								<div class="form-group"> <label for="exampleInputEmail1">Images</label> <input type="file" class="form-control" id="image" name="image" value="" required="true"> </div>
								<button type="submit" name="submit" class="btn btn-default">Add</button>
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
<?php
//  } 
?>