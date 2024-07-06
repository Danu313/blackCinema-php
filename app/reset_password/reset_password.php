<?php
session_start();
include '../../config/conn.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == "reset_password") {
        // Validasi dan bersihkan input email
        $email = trim($_POST['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Periksa apakah email sudah terdaftar di database
        $query = "SELECT * FROM user WHERE user_email = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $code = rand(100000, 999999);
                $_SESSION['code'] = $code;
                $_SESSION['email'] = $email;

                // Kirim email verifikasi menggunakan PHPMailer
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mw18804@gmail.com'; // Ganti dengan email Anda
                    $mail->Password = 'wzenxtdsmogysqvm'; // Ganti dengan kata sandi aplikasi email Anda
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // Port untuk TLS

                    // Penerima
                    $mail->setFrom('mw18804@gmail.com', 'Black Cinema');
                    $mail->addAddress($email);

                    // Konten email dalam format HTML dari file email_content.php
                    ob_start();
                    include 'email_content.php';
                    $mailContent = ob_get_clean();

                    $mail->isHTML(true);
                    $mail->Subject = 'Kode Verifikasi';
                    $mail->Body    = $mailContent;

                    $mail->send();
                    echo '<script>
                            window.onload = function() {
                                Swal.fire({
                                    icon: "success",
                                    text: "Kode verifikasi telah terkirim ke email Anda.",
                                    confirmButtonColor: "#3F51B5",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "verify_code.php";
                                    }
                                });
                            }
                          </script>';
                } catch (Exception $e) {
                    $error = "Gagal mengirim kode verifikasi. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $error = "Email tidak terdaftar!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "Database query error.";
        }
    } else {
        $error = "Invalid action.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-no-repeat bg-center min-h-screen" style="background-image: url('https://image.cnbcfm.com/api/v1/image/107198349-1677094004134-gettyimages-1413907398-img_9361.jpeg?v=1706809419&w=740&h=416&ffmt=webp&vtcrop=y'); overflow: hidden;">
    <div class="flex justify-center items-center min-h-screen bg-opacity-50 bg-gray-900">
        <div class="max-w-screen-xl bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="w-20 mx-auto" alt="Logo">
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold text-black">Reset Password</h1>
                    <div class="w-full flex-1 mt-8">
                        <?php if (!empty($error)) : ?>
                            <div class="mb-4 text-red-500">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="action" value="reset_password">
                            <div class="mx-auto text-black max-w-xs">
                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="email" name="email" placeholder="Masukkan Email" required>
                                <button class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" type="submit">
                                    <span class="ml-3">Kirim</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-indigo-100 text-center hidden lg:flex rounded-tr-lg rounded-br-lg">
                <div class="w-full bg-cover bg-center bg-no-repeat rounded-lg" style="background-image: url('https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bW92aWV8ZW58MHx8MHx8fDA%3D')"></div>
            </div>
        </div>
    </div>
</body>

</html>