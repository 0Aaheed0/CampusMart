<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | CampusMart</title>
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
            overflow-x: hidden;
            position: relative;
        }

        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.15;
            top: -100px;
            right: -100px;
        }

        .blob-2 {
            bottom: -100px;
            left: -100px;
            background: linear-gradient(135deg, #a78bfa 0%, #8b5cf6 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 40px;
            padding: 50px 40px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px;
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            color: #8b5cf6;
            font-size: 1.8rem;
        }

        h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
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
            padding: 14px 15px 14px 55px;
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 18px;
            outline: none;
            font-size: 0.9rem;
            transition: all 0.3s;
            color: #1e293b;
        }

        input:focus {
            background: white;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }

        input:focus + i {
            color: #8b5cf6;
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
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 18px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);
            margin-top: 15px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(139, 92, 246, 0.6), 0 15px 20px -3px rgba(139, 92, 246, 0.4);
            filter: brightness(1.05);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.85rem;
            color: #64748b;
        }

        .footer-links a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 700;
            transition: 0.3s;
        }

        .footer-links a:hover {
            text-shadow: 0 0 10px rgba(139, 92, 246, 0.3);
            text-decoration: underline;
        }

        .error-container {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            padding: 15px;
            border-radius: 18px;
            margin-bottom: 25px;
            font-size: 0.8rem;
            text-align: left;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
    </style>
</head>
<body>

<div class="blob"></div>
<div class="blob blob-2"></div>

<div class="glass-card">
    <div class="icon-circle">
        <i class="fas fa-user-plus"></i>
    </div>
    <h2>Create Account</h2>

    @if ($errors->any())
        <div class="error-container">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group">
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            <i class="fas fa-user"></i>
        </div>

        <div class="input-group">
            <input type="email" name="email" placeholder="Email Address (@aust.edu)" value="{{ old('email') }}" required>
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Create Password" required>
            <i class="fas fa-lock"></i>
            <i class="fas fa-eye password-toggle" onclick="togglePass('password')"></i>
        </div>

        <div class="input-group">
            <input type="password" id="confirm" name="password_confirmation" placeholder="Confirm Password" required>
            <i class="fas fa-shield-alt"></i>
            <i class="fas fa-eye password-toggle" onclick="togglePass('confirm')"></i>
        </div>

        <button type="submit">SIGN UP</button>
    </form>

    <div class="footer-links">
        Already have an account? <a href="{{ route('login') }}">Login instead</a>
    </div>
</div>

<script>
    function togglePass(id) {
        const field = document.getElementById(id);
        const icon = field.nextElementSibling.nextElementSibling;
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

</body>
</html>
