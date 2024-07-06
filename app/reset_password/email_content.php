<!DOCTYPE html>
<html>
<head>
    <title>Kode Verifikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            padding: 80px;
            border: 2px solid #4A4A4A;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
        }
        .content {
            text-align: center;
            font-size: 1.2em;
            color: #333333;
        }
        .code {
            display: inline-block;
            padding: 15px 30px;
            color: #333333;
            font-weight: 600;
            font-size: 2em;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://res.cloudinary.com/dutlw7bko/image/upload/v1716618897/Cinema/Logo/Cuplikan_layar_2024-05-14_083355_jr8lu6_1_wc2vsh.png" alt="Logo">
        </div>
        <div class="content">
            <h2>Kode Verifikasi Anda:</h2>
            <div class="code"><?php echo $code; ?></div>
        </div>
    </div>
</body>
</html>
