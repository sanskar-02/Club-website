<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Collect form data
    $fname = $_POST['Name'];
    $mobile = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $people = $_POST['People'];
    $message = $_POST['Message'];
    // $checkin = $_POST['checkIn'];
    // $message = $_POST['message'];
    // $option = $_POST['selectOption']; // Get selected option from form

    // Format email content in HTML
    $html = "
        <table>
            <tr><td>Name</td><td>$fname</td></tr>
            <tr><td>Email</td><td>$email</td></tr>
            <tr><td>Mobile</td><td>$mobile</td></tr>
            <tr><td>Time</td><td>$people</td></tr>
            <tr><td>Message</td><td>$message</td></tr>
        </table>";


    include('smtp/PHPMailerAutoload.php');
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
	$mail->Username="sanskarpss02@gmail.com";
    $mail->Password="ffsl ckav qsbv mdca";
	$mail->SetFrom("sanskarpss02@gmail.com");
	$mail->addAddress("sanskarpss02@gmail.com");
    $mail->IsHTML(true);
    $mail->Subject = "New Enquiry";
    $mail->Body = $html;
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    
    if ($mail->send()) {
		//echo "Mail send";
        echo json_encode(['success' => true ]);
	} else {
		echo json_encode(['success' => false, 'error' => 'Message not Sent']);
	}

}
