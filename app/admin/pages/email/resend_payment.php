<?php
// Include necessary files
include_once '../../../../config/conn.php';
require_once '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $paymentId = mysqli_real_escape_string($conn, $_GET['id']);

    $queryPayment = mysqli_query($conn, "SELECT * FROM payment WHERE id = $paymentId");
    $rowPayment = mysqli_fetch_assoc($queryPayment);

    if ($rowPayment) {
        $queryMovie = mysqli_query($conn, "SELECT * FROM movie WHERE id = {$rowPayment['movieId']}");
        $rowMovie = mysqli_fetch_assoc($queryMovie);

        $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = {$rowPayment['userId']}");
        $rowUser = mysqli_fetch_assoc($queryUser);

        if ($rowUser) {
            $email = $rowUser['user_email'];

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
                $mail->isHTML(true);
                $mail->Subject = 'Tiket Black Cinema';

                ob_start();
?>
                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Email Template</title>
                    <style>
                        body,
                        table,
                        td,
                        th {
                            font-family: Arial, sans-serif;
                            font-size: 16px;
                            line-height: 24px;
                            margin: 0;
                            padding: 0;
                            border: none;
                            border-collapse: collapse;
                        }

                        table {
                            width: 100%;
                            max-width: 37.5em;
                            margin: auto;
                        }

                        img {
                            max-width: 100%;
                            height: auto;
                            display: block;
                        }

                        .text-lg {
                            font-size: 24px;
                        }

                        .font-black {
                            font-weight: bold;
                        }

                        .bg-green-500 {
                            background-color: #34D399;
                        }

                        .text-white {
                            color: #ffffff;
                        }

                        .px-6 {
                            padding-left: 24px;
                            padding-right: 24px;
                        }

                        .py-4 {
                            padding-top: 16px;
                            padding-bottom: 16px;
                        }

                        .rounded-lg {
                            border-radius: 8px;
                        }

                        .h-auto {
                            height: auto;
                        }

                        .w-auto {
                            width: auto;
                        }
                    </style>
                </head>

                <body>
                    <table align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 3px; overflow: hidden;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <img src="<?= htmlspecialchars($rowMovie['backdrop_path']); ?>" width="620" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table align="center" style="padding: 20px;">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <h1 style="font-size: 32px; font-weight: bold; text-align: center;">Hi <?= htmlspecialchars($rowUser['user_username']); ?>,</h1>
                                                                    <h2 style="font-size: 26px; font-weight: bold; text-align: center;">Detail pemesanan tiket anda:</h2>
                                                                    <p><b>Waktu Mulai:</b> <?= date('d F Y H:i', strtotime($rowPayment['startTime'])); ?></p>
                                                                    <p><b>Waktu Selesai:</b> <?= date('d F Y H:i', strtotime($rowPayment['endTime'])); ?></p>
                                                                    <p><b>Lokasi:</b> Jogja</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="w-full h-auto flex flex-row items-center justify-center py-3">
                                        <span class="bg-green-500 font-bold text-white px-6 py-4 rounded-lg h-auto w-auto">Id pemesanan : <?= $rowPayment['id']; ?></span>
                                    </div>
                                    <p>Tunjukkan id pemesanan ini ke kasir!</p>
                                    <p>Tidak menerima pembatalan atau refund!</p>
                                    <p>Untuk informasi lebih lanjut silahkan hubungi customer service</p>
                                    <table align="center" style="padding: 45px 0 0 0;">
                                        <tbody>
                                            <tr>
                                                <td><img src="https://react-email-demo-dr9excyry-resend.vercel.app/static/yelp-footer.png" width="620" /></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </body>

                </html>
<?php
                $mail->Body = ob_get_clean();
                $mail->send();

                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => "User not found for payment ID: $paymentId"]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => "Payment not found with ID: $paymentId"]);
    }
} else {
    echo json_encode(['success' => false, 'error' => "Invalid request method or missing ID parameter"]);
}
