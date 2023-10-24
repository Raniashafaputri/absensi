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
            background:turquoise;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 450px;
            background: teal;
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
        <form action="<?php echo base_url('auth/process_register_karyawan'); ?>" method="post"> 
        <h1>Register karyawan</h1>
                <div class="input-box"> 
                    <label for="username">Username</label> 
                    <input type="text" id="username" placeholder="Masukkan username" class="form-control" 
                        name="username" required> 
                </div> 
                <div class="input-box"> 
                    <label for="email">Email</label> 
                    <input type="email" id="email" placeholder="Masukkan email Anda" class="form-control" name="email" 
                        required> 
                </div> 
                <div class="input-box"> 
                    <label for="nama_depan">Nama Depan</label> 
                    <input type="text" id="nama_depan" placeholder="Masukkan nama depan Anda" class="form-control" 
                        name="nama_depan" required> 
                </div> 
                <div class="input-box"> 
                    <label for="nama_belakang">Nama Belakang</label> 
                    <input type="text" id="nama_belakang" placeholder="Masukkan nama belakang Anda" class="form-control" 
                        name="nama_belakang" required> 
                </div> 
                <div class="input-box"> 
                    <label for="password">Password</label> 
                    <input type="password" id="password" placeholder="Masukkan kata sandi Anda" class="form-control" 
                        name="password" required> 
                    <small class="text-danger">Kata sandi minimal harus 8 karakter!</small> 
                </div> 
               
                <button type="submit" class="btn">Register</button>
            </form>
        
            <div class="register_link">
                <p>sudah punya akun?<a href='<?php echo base_url('auth'); ?>' style=color:black> Login</a>
                </p>
            </div>

    </div>
</body>
</html>
