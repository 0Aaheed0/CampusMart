<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | CampusMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google One Tap SDK -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            color: white;
        }

        /* glow blobs */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: #3b82f6;
            filter: blur(140px);
            opacity: 0.25;
            border-radius: 50%;
            animation: move 20s infinite alternate;
            z-index: 0;
        }

        .blob2 {
            right: -150px;
            bottom: -150px;
            background: #22c55e;
        }

        .blob3 {
            left: -150px;
            top: -150px;
            background: #60a5fa;
        }

        @keyframes move {
            from { transform: translate(0, 0) }
            to { transform: translate(80px, 60px) }
        }

        /* glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 30px;
            padding: 50px 40px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.4);
            text-align: center;
            position: relative;
            z-index: 1;
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
            color: #2563eb;
            font-size: 2rem;
        }

        h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i:not(.password-toggle) {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 55px;
            border-radius: 20px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 0.95rem;
        }

        input::placeholder {
            color: #cbd5f5;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.25);
        }

        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #cbd5f5;
        }

        button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: none;
            border-radius: 20px;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.5);
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.9);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #cbd5f5;
        }

        .footer-links a {
            color: #93c5fd;
            font-weight: 700;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
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
            background: rgba(239, 68, 68, 0.15);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #bbf7d0;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            gap: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .divider-text {
            font-size: 0.75rem;
            color: #cbd5f5;
            font-weight: 600;
        }

        #g_id_onload {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="blob blob3"></div>
<div class="blob"></div>
<div class="blob blob2"></div>

<div class="glass-card">
    <div class="icon-circle">
        <i class="fas fa-user-shield"></i>
    </div>
    <h2>Login</h2>

    <!-- Google One Tap Container -->
    <div id="g_id_onload"
         data-client_id="{{ config('google.client_id') }}"
         data-callback="handleCredentialResponse">
    </div>
    <div class="g_id_signin" data-type="standard" data-size="large" data-theme="dark" data-text="signin_with" data-shape="rectangular" data-logo_alignment="left"></div>

    <div class="divider">
        <span class="divider-text">OR</span>
    </div>

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
            <input type="email" name="email" placeholder="Email Address" required value="{{ old('email') }}" autocomplete="email">
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" required autocomplete="current-password">
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

    // Handle Google One Tap response
    function handleCredentialResponse(response) {
        // Send token to server
        fetch('{{ route("auth.google-one-tap") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({
                credential: response.credential
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect || '{{ route("home") }}';
            } else {
                alert('Authentication failed: ' + data.message);
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Authentication error');
        });
    }

    // Initialize Google Sign-In
    window.onload = function() {
        google.accounts.id.initialize({
            client_id: '{{ config('google.client_id') }}',
            callback: handleCredentialResponse,
        });
        
        // Display One Tap UI if not signed in
        google.accounts.id.renderButton(
            document.querySelector('.g_id_signin'),
            { theme: 'dark', size: 'large', text: 'signin_with' }
        );
    };
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
