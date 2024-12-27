<?php include_once 'header.php';
// Include the database connection
include_once 'admin/includes/dbconnection.php';

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input
    $query = mysqli_query($con, "SELECT * FROM Clubs WHERE id = $id");

    // Check if the club exists
    if ($row = mysqli_fetch_assoc($query)) {
        // Club details retrieved successfully
        $clubName = htmlspecialchars($row['ClubName']);
        $clubDescription = htmlspecialchars($row['ClubDescription']);
        $cost = htmlspecialchars($row['Cost']);
        $opensAt = htmlspecialchars($row['Opens_at']);
        $closesAt = htmlspecialchars($row['Closed_at']);
        $image = htmlspecialchars($row['Image']);
    } else {
        echo "<script>alert('Club not found!');</script>";
        echo "<script>window.location.href = 'clubs.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid club ID!');</script>";
    echo "<script>window.location.href = 'clubs.php';</script>";
    exit;
}
?>

<div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
    <div class="text-center">
        <h1 class="display-4 text-white  slideInDown mb-3"><?php echo $clubName; ?></h1>
    </div>
</div>
<div class="container club-details py-5">
    <div class="row py-4">
        <div class="col-md-7 col-sm-10 detail-img">
            <img src="admin/images/<?php echo $image; ?>" alt="Club Image" style="width: 100%; height: auto;">
        </div>
        <div class="col-lg-4 col-sm-10 detail-content">
            <p><?php echo $clubDescription; ?></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum animi id doloribus quo minima, aliquid, blanditiis minus illo nihil nulla saepe totam tenetur itaque. Officiis quisquam explicabo, recusandae accusantium quo id sapiente sunt quibusdam tempora nam velit eaque deserunt quasi?</p>
            <div class="time d-flex flex-column">
                <span>Door Opens At : <b><?php echo $opensAt; ?></b></span>
                <span>Door Closes At : <b><?php echo $closesAt; ?></b></span>
            </div>
            <div class="prize py-2">
                <span>Entry Cost : </span><b>₹<?php echo $cost; ?></b>
            </div>
            <button data-bs-toggle="modal" class="mt-5 " data-bs-target="#bookingModal"> <span class=" button_top"> RESERVE </span>
            </button>
        </div>
    </div>
</div>


<div class="modal fade bookingModal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="clubNameDisplay"><?php echo "$clubName" ?></h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-v3-content">
                    <form class="form-detail" id="booking-form">
                        <h2>RESERVE A TABLE</h2>
                        <p class="text">Fill all details to confirm booking for your club</p>
                        <div class="row">
                            <div class="col-6">
                                <label for="full-name">FULL NAME:</label>
                                <input type="text" name="full-name" id="full-name" class="input-text form-control" onkeydown="return/[a-z A-Z]/i.test(event.key)" required>
                            </div>
                            <div class="col-6">
                                <label for="your-number">YOUR PHONE NUMBER :</label>
                                <input type="text" name="your-number" id="your-number" class="input-text form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" required>
                            </div>
                            <div class="col-12">
                                <label for="your-email">YOUR EMAIL:</label>
                                <input type="email" name="your-email" id="your-email" class="input-text form-control" required>
                            </div>

                            <div class="col-4 date" id="datepicker">
                                <label>Date:</label>
                                <input class="form-control" type="date" name="date" id="date" required>
                            </div>
                            <div class="col-3 time" id="timepicker">
                                <label>Time:</label>
                                <input class="form-control" type="time" name="time" id="time" required>
                            </div>

                            <div class="col-3">
                                <label for="person">PERSON:</label>
                                <input type="text" id="person" class="input-text form-control" name="person" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="form-row-last row">
                            <button type="button" class="col-3" onclick="validateAndReserve()"> <span class="button_top"> BOOK </span>
                            </button>
                            <button type="button" class="col-3" id="pay-now" style="display: none;" onclick="pay_now()"> <span class="button_top"> PAY </span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function validateAndReserve() {
        var clubName = "<?php echo addslashes($clubName); ?>";
        var fullName = jQuery('#full-name').val().trim();
        var number = jQuery('#your-number').val().trim();
        var email = jQuery('#your-email').val().trim();
        var date = jQuery('#date').val();
        var time = jQuery('#time').val();
        var person = jQuery('#person').val();

        if (!fullName || !number || !email || !date || !time || person <= 0) {
            alert("Please fill in all details correctly.");
            return;
        }

        jQuery.ajax({
            type: 'POST',
            url: 'reserve_process.php',
            data: {
                clubName: clubName,
                fullName: fullName,
                number: number,
                email: email,
                date: date,
                time: time,
                person: person
            },
            success: function(response) {
                console.log("Reservation Response:", response);
                try {
                    const data = JSON.parse(response);
                    if (data.success) {
                        alert("Reservation ! You can proceed to payment.");
                        document.getElementById('pay-now').style.display = 'block';
                    } else {
                        alert("Reservation failed: " + data.error);
                    }
                } catch (error) {
                    console.error("Response Parsing Error:", error, response);
                    alert("Unexpected error occurred. Please try again.");
                }
            },
            error: function(err) {
                console.error("AJAX Error:", err);
                alert("Server error occurred. Please try again.");
            }
        });
    }

    // payment idd-----------------------

    function pay_now() {
        var fullName = jQuery('#full-name').val().trim();
        var number = jQuery('#your-number').val().trim();
        var email = jQuery('#your-email').val().trim();
        var person = jQuery('#person').val();
        var totalAmount = person * <?php echo $cost; ?>;

        var options = {
            "key": "rzp_test_L59AkrXLMEkkdc",
            "amount": totalAmount * 100,
            "currency": "INR",
            "name": "CLUB",
            "description": "Club Booking Payment",
            "handler": function(response) {
                console.log("Payment Success:", response);

                jQuery.ajax({
                    type: 'POST',
                    url: 'payment_updated.php',
                    data: {
                        payment_id: response.razorpay_payment_id,
                        email: email
                    },
                    success: function(response) {
                        console.log("Payment Update Response:", response);
                        const data = JSON.parse(response);
                        if (data.success) {
                            alert("Payment successful! Booking confirmed. Your token is: " + data.token);

                            // Clear form fields
                            clearForm();

                            // Redirect to index page
                            window.location.href = "index.php";
                        } else {
                            alert("Error updating booking: " + data.error);
                        }
                    },
                    error: function(err) {
                        console.error("AJAX Error:", err);
                        alert("Error updating booking. Please try again.");
                    }
                });
            },
            "prefill": {
                "name": fullName,
                "email": email
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    }

    // Helper function to clear form fields
    function clearForm() {
        jQuery('#full-name').val('');
        jQuery('#your-number').val('');
        jQuery('#your-email').val('');
        jQuery('#date').val('');
        jQuery('#time').val('');
        jQuery('#person').val(1);
        document.getElementById('pay-now').style.display = 'none';
    }
</script>

<?php include_once 'footer.php'


?>