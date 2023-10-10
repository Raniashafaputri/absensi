<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: slategray;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 450px;
            background: slateblue;
            color: #fff;
            border-radius: 10px;
            padding: 20px 40px;
        }

        .wrapper h1 {
            font-size: 20px;
            text-align: center;
        }

        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 40%;
            margin: 20px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .remember-forgot label input {
            accent-color: #fff;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 30px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
            cursor: pointer;
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin-top: 20px 0 10px;
        }

        .register-link p a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: white;
        }
    </style>
</head>

<body>

    <div class="wrapper">
    <form action="<?php echo base_url(); ?>auth/Aksi_Register_admin" method ="post">
            <h1>Register admin</h1>
            <div class="input-box">
                <input type="text" name="nama" placeholder="nama" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="input-box">
                <input type="nama_depan" name="nama_depan"placeholder="nama_depan" required>
            </div>
            <div class="input-box">
                <input type="nama_belakang" name="nama_belakang"placeholder="nama_belakang" required>
            </div>
            <div class="input-box">
                <input type="password" nama="password" placeholder="password" required>
            </div>
            <div class="input-box">
                <input type="role" nama="role" placeholder="role" required>
            </div>
            <button type="submit" class="btn">Register</button>

            <div class="Login_link">
                <p>sudah punya akun?<a href="register" style=color:white> registerq</a></p>
            </div>

        </form>

    </div>
</body>

</html>