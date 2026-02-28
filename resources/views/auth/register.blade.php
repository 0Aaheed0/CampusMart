<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | CampusMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;   /* Fix overflow issue */
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(to right, #edf6f9, #d8f3dc);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            background: white;
            width: 420px;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
        }

        .icon {
            font-size: 40px;
            color: #2d6a4f;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 25px;
            color: #1b4332;
        }

        input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .password-box {
            position: relative;
        }

        .password-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2d6a4f;
            border: none;
            color: white;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1b4332;
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #2d6a4f;
            text-decoration: none;
            font-weight: 500;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="icon">
        <i class="fas fa-graduation-cap"></i>
    </div>
    <h2>Create Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>

        <div class="password-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class="fas fa-eye" onclick="togglePass('password')"></i>
        </div>

        <div class="password-box">
            <input type="password" id="confirm" name="password_confirmation" placeholder="Confirm Password" required>
            <i class="fas fa-eye" onclick="togglePass('confirm')"></i>
        </div>

        <button type="submit">SIGN UP</button>
    </form>

    <div class="link">
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>

<script>
    function togglePass(id) {
        const field = document.getElementById(id);
        field.type = field.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>