<?php
// Include the database connection
// include_once 'admin/includes/dbconnection.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
//     $email = mysqli_real_escape_string($con, $_POST['email']);

//     // Generate unique token
//     $nameInitials = strtoupper(substr($email, 0, 2)); // First two letters of the email
//     $dateToken = date('Hs'); // Today's HHSS
//     $token = $dateToken . $nameInitials;

//     // Update reservation with payment details
//     $query = "UPDATE club_bookings 
//               SET Payment_Status = 'completed', Pay_Id = '$payment_id', Token_id = '$token' 
//               WHERE Email = '$email' AND Payment_Status = 'pending'";

//     if (mysqli_query($con, $query)) {
//         echo json_encode(['success' => true, 'token' => $token]);
//     } else {
//         echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
//     }
// } else {
//     echo json_encode(['success' => false, 'error' => 'Invalid request method']);
// }

// Include the database connection
include_once 'admin/includes/dbconnection.php';
include('smtp/PHPMailerAutoload.php'); // Include PHPMailer

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Generate unique token
    $nameInitials = strtoupper(substr($email, 0, 2)); // First two letters of the email
    $dateToken = date('dmh'); // Today's HHSS
    $token = $dateToken . $nameInitials;

    // Update reservation with payment details
    $query = "UPDATE club_bookings 
              SET Payment_Status = 'completed', Pay_Id = '$payment_id', Token_id = '$token' 
              WHERE Email = '$email' AND Payment_Status = 'pending'";

    if (mysqli_query($con, $query)) {
        // Send email with token
        $html = "
            <h2>Payment Confirmation</h2>
            <p>Thank you for completing your payment. Here are your details:</p>
            <table>
                <tr><td><strong>Email:</strong></td><td>$email</td></tr>
                <tr><td><strong>Payment ID:</strong></td><td>$payment_id</td></tr>
                <tr><td><strong>Token ID:</strong></td><td><strong style='color: green;'>$token</strong></td></tr>
            </table>
            <p>Please present this token when you arrive at the club. We look forward to seeing you!</p>";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username="sanskarpss02@gmail.com";
            $mail->Password="ffsl ckav qsbv mdca";
            $mail->SetFrom("sanskarpss02@gmail.com"); // Sender email and name
            $mail->addAddress($email); // Send email to the user
            $mail->IsHTML(true);
            $mail->Subject = "Your Payment Confirmation and Token ID";
            $mail->Body = $html;

            // SMTP Options to allow self-signed certificates
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                    'allow_self_signed' => false,
                ),
            );

            // Send email
            $mail->send();
            echo json_encode(['success' => true, 'token' => $token]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => 'Email not sent. Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
