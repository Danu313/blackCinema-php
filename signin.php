<?php
session_start();
include 'config/conn.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_GET['action'] == "signin") {
        $user_email = mysqli_real_escape_string($conn, $_POST['email']);
        $query = "SELECT * FROM user WHERE user_email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($_POST['password'], $row['user_password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_username'] = $row['user_username'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_image'] = $row['user_image'];
                $_SESSION['user_role'] = $row['user_role'];

                if ($row['user_role'] == "admin") {
                    header("Location: admin");
                    exit();
                } elseif ($row['user_role'] == "user") {
                    header("Location: user");
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid role assigned to user.";
                    header("Location: signin.php");
                    exit();
                }
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid action.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link href="assets/css/style.css" rel="stylesheet">
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
                    <h1 class="text-2xl xl:text-3xl font-extrabold text-black">Masuk</h1>
                    <div class="w-full flex-1 mt-8">
                        <?php if (!empty($error)) : ?>
                            <div class="mb-4 text-red-500">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="?action=signin" onsubmit="return validateLoginForm()">
                            <div class="mx-auto text-black max-w-xs">
                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="email" name="email" placeholder="Email" required>
                                <div class="relative mt-5">
                                    <input class="w-full px-8 py-4 text-black rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="password" name="password" placeholder="Password" required>
                                </div>
                                <p class="mt-2 text-right text-sm text-gray-600">
                                    <a href="app/reset_password/reset_password.php" class="text-indigo-500 font-semibold">Lupa password?</a>
                                </p>
                                <button class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" type="submit">
                                    <span class="ml-3">Masuk</span>
                                </button>
                                <p class="mt-6 text-xs text-gray-600 text-center">
                                    Saya setuju untuk mematuhi Ketentuan Layanan Binema Dan Kebijakan Privasinya
                                </p>
                                <p class="mt-6 text-sm text-gray-600 text-center">
                                    Belum punya akun? <a href="signup.php" class="text-indigo-500 font-semibold">Daftar</a>
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
        function validateLoginForm() {
            var email = document.getElementsByName('email')[0].value.trim();
            var password = document.getElementsByName('password')[0].value.trim();

            if (email === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Email tidak boleh kosong',
                });
                return false;
            }

            if (password === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Password tidak boleh kosong',
                });
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
