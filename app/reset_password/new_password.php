<?php
session_start();
include '../../config/conn.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
    $confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : null;

    if ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } else {
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Gunakan hashing untuk keamanan

            $sql = "UPDATE user SET user_password='$hashed_password' WHERE user_email='$email'";
            if (mysqli_query($conn, $sql)) {
                unset($_SESSION['email']);
                unset($_SESSION['code']);
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                      <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Password berhasil diubah!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href = '../../signin.php';
                            });
                        }
                      </script>";
                // exit(); // Hentikan eksekusi PHP setelah menampilkan SweetAlert
            } else {
                $error = "Gagal mengubah password!";
            }
        } else {
            $error = "Sesi email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="bg-cover bg-no-repeat bg-center min-h-screen" style="background-image: url('https://image.cnbcfm.com/api/v1/image/107198349-1677094004134-gettyimages-1413907398-img_9361.jpeg?v=1706809419&w=740&h=416&ffmt=webp&vtcrop=y'); overflow: hidden;">
    <div class="flex min-h-screen justify-center items-center">
        <div class="max-w-screen-xl bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="w-[80px] mx-auto" alt="">
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold text-black">New Password</h1>
                    <div class="w-full flex-1 mt-8">
                        <?php if (!empty($error)): ?>
                            <div class="mb-4 text-red-500">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mx-auto text-black max-w-xs">
                                <input class="mb-5 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="password" name="password" placeholder="Password Baru" required>
                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
                                <button class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" type="submit">
                                    <span class="ml-3">Reset Password</span>
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
