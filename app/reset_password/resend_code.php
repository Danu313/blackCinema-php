<?php
session_start();
include '../../config/conn.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "resend_code") {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mw18804@gmail.com';
            $mail->Password = 'wzenxtdsmogysqvm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('mw18804@gmail.com', 'Black Cinema');
            $mail->addAddress($email);

            // Konten email dalam format HTML
            $mail->isHTML(true);
            $mail->Subject = 'Kode Verifikasi';
            ob_start();
            include 'email_content.php';
            $mail->Body = ob_get_clean();

            $mail->send();
            $_SESSION['success_message'] = "Kode verifikasi telah terkirim ke email Anda.";
        } catch (Exception $e) {
            $_SESSION['resend_error'] = "Gagal mengirim kode verifikasi. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['resend_error'] = "Email tidak ditemukan.";
    }
}

header("location: verify_code.php");
exit();
