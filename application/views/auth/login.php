<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            width: 420px;
            background: slateblue;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
       }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50%;
            margin: 30px 0;
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

        .input-box i {
            position: absolute;
            right: 20px;
            top: 60%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
           display: flex;
           justify-content: space-between;
           font-size: 14.5px;
           margin: -15px 0 15px;
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
            height: 35px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
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
        <form action="">
            <h1>Login</h1>
            <div class="input-box">
                <label for="email">email</label>
                <input type="text" id="email" placeholder="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="">password</label>
                <input type="password" placeholder="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
            <label for="">role</label>
                <input type="role" placeholder="role" required>
            </div>
            <div class="remember-forgot">
                 <label><input type="checkbox"> Remember me</label>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register_link">
                <p>sudah punya akun?<a href="register" style="color:white"> register</a>

            </div>


        </form>

    </div>
</body>

</html>