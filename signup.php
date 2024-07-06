<?php
session_start();
include 'config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = trim(mysqli_real_escape_string($conn, $_POST['email'])); // Trim whitespace from email
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate confirm password
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Password tidak cocok!";
        header("Location: signup.php");
        exit();
    }

    // Validate no leading or trailing whitespace in name and email
    if (trim($name) !== $name || trim($email) !== $_POST['email']) {
        $_SESSION['error'] = "Nama atau email tidak valid!";
        header("Location: signup.php");
        exit();
    }

    // Validate no spaces in password
    if (strpos($password, ' ') !== false) {
        $_SESSION['error'] = "Password tidak boleh mengandung spasi!";
        header("Location: signup.php");
        exit();
    }

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $sql_check = "SELECT * FROM user WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result_check = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_check) > 0) {
        $_SESSION['error'] = "Email sudah terdaftar!";
        header("Location: signup.php");
        exit();
    }

    // Insert user data
    $sql_insert = "INSERT INTO user (user_username, user_email, user_password, user_image, user_role)
                   VALUES (?, ?, ?, ?, 'user')";
    $user_image = "https://example.com/default_image.jpg";
    $stmt = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password_hashed, $user_image);
    $insert_result = mysqli_stmt_execute($stmt);

    if ($insert_result) {
        $_SESSION['success'] = "Akun berhasil dibuat. Silakan masuk.";
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "' . $_SESSION['success'] . '",
                        confirmButtonColor: "#3F51B5",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "signin.php";
                        }
                    });
                }
              </script>';
    } else {
        $_SESSION['error'] = "Gagal mendaftarkan pengguna!";
        header("Location: signup.php");
        exit();
    }
    
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body style="background-image: url('https://image.cnbcfm.com/api/v1/image/107198349-1677094004134-gettyimages-1413907398-img_9361.jpeg?v=1706809419&w=740&h=416&ffmt=webp&vtcrop=y'); background-size: cover; background-repeat: no-repeat;">
    <div class="flex min-h-screen justify-center items-center">
        <div class="max-w-screen-xl bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" class="w-[80px] mx-auto" alt="">
                </div>
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold text-black">Daftar</h1>
                    <div class="w-full flex-1 mt-8">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="mb-4 text-red-500">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                        <?php unset($_SESSION['error']);
                        endif; ?>
                        <form method="POST" action="?action=signup" onsubmit="return validateSignupForm()">
                            <div class="mx-auto text-black max-w-xs">
                                <input class="mb-5 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="text" name="name" placeholder="Masukkan Nama" required pattern="[^\s].{1,}">
                                <input class="mb-5 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="email" name="email" placeholder="Email" required>
                                <input class="mb-5 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="password" name="password" placeholder="Password" required pattern="[^\s].{1,}">
                                <input class="mb-5 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="password" name="confirmPassword" placeholder="Konfirmasi password" required>
                                <button class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" type="submit">
                                    <span class="ml-3">Daftar</span>
                                </button>
                                <p class="mt-6 text-xs text-gray-600 text-center">
                                    Saya setuju untuk mematuhi Ketentuan Layanan Binema Dan Kebijakan Privasinya
                                </p>
                                <p class="mt-6 text-sm text-gray-600 text-center">
                                    Sudah punya akun? <a href="signin.php" class="text-indigo-500 font-semibold">Masuk</a>
                                </p>
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

    <script>
        function validateSignupForm() {
            var password = document.getElementsByName('password')[0].value;
            var confirmPassword = document.getElementsByName('confirmPassword')[0].value;

            if (password === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'password tidak boleh kosong atau mengandung spasi',
                });
                return false;
            }
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password tidak cocok!',
                });
                return false;
            }
            return true;
        }
    </script>
</body>

</html>