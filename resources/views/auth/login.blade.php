<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | CampusMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.15;
            top: -100px;
            left: -100px;
        }

        .blob-2 {
            bottom: -100px;
            right: -100px;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            top: auto;
            left: auto;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 40px;
            padding: 50px 40px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            color: #2563eb;
            font-size: 2rem;
        }

        h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: 0.3s;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 55px;
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            outline: none;
            font-size: 0.95rem;
            transition: all 0.3s;
            color: #1e293b;
        }

        input:focus {
            background: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        input:focus + i {
            color: #3b82f6;
        }

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            transition: 0.3s;
        }

        button {
            width: 100%;
            padding: 16px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            margin-top: 10px;
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.6), 0 15px 20px -3px rgba(37, 99, 235, 0.4);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #64748b;
        }

        .footer-links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: #1d4ed8;
            text-decoration: underline;
            text-shadow: 0 0 10px rgba(37, 99, 235, 0.2);
        }

        .alert {
            padding: 15px;
            border-radius: 18px;
            margin-bottom: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
    </style>
</head>
<body>

<div class="blob"></div>
<div class="blob blob-2"></div>

<div class="glass-card">
    <div class="icon-circle">
        <i class="fas fa-user-shield"></i>
    </div>
    <h2>Login</h2>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group">
            <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}">
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <i class="fas fa-lock"></i>
            <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
        </div>

        <button type="submit">LOG IN</button>
    </form>

    <div class="footer-links">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </div>
</div>

<script>
    function togglePassword() {
        const pass = document.getElementById('password');
        const icon = document.querySelector('.password-toggle');
        if (pass.type === 'password') {
            pass.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pass.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

</body>
</html>
