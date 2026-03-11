<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | CampusMart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

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

        /* Decorative Background Elements */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.2;
            animation: move 20s infinite alternate;
        }

        .blob-2 {
            bottom: -100px;
            right: -100px;
            background: linear-gradient(135deg, #a78bfa 0%, #8b5cf6 100%);
            animation-delay: -10s;
        }

        @keyframes move {
            from { transform: translate(-10%, -10%) rotate(0deg); }
            to { transform: translate(10%, 10%) rotate(360deg); }
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 40px;
            padding: 60px 40px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            transform: translateY(0);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 35px 60px -15px rgba(59, 130, 246, 0.2);
            background: rgba(255, 255, 255, 0.5);
        }

        .logo-container {
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 15px;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: #1e40af;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        p {
            color: #475569;
            font-size: 1.1rem;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .btn-primary {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 16px 40px;
            border-radius: 20px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.4);
            cursor: pointer;
            border: none;
            font-size: 1rem;
            width: 100%;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: scale(1.02);
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.6), 0 15px 20px -3px rgba(37, 99, 235, 0.5);
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(30, 58, 138, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 35px;
            width: 350px;
            text-align: center;
            transform: scale(0.9) translateY(20px);
            transition: 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 1px solid white;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1) translateY(0);
        }

        .modal-btn {
            display: block;
            padding: 14px;
            margin: 12px 0;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-btn {
            background: #2563eb;
            color: white;
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2);
        }

        .login-btn:hover {
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.6);
            transform: scale(1.05);
        }

        .signup-btn {
            background: white;
            color: #1e40af;
            border: 1px solid #bfdbfe;
        }

        .signup-btn:hover {
            box-shadow: 0 0 20px rgba(191, 219, 254, 0.6);
            transform: scale(1.05);
            background: #f8fafc;
        }

        .cancel-btn {
            color: #94a3b8;
            font-size: 0.9rem;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .cancel-btn:hover {
            color: #64748b;
            text-shadow: 0 0 10px rgba(148, 163, 184, 0.4);
        }
    </style>
</head>
<body>

<div class="blob"></div>
<div class="blob blob-2"></div>

<div class="glass-box">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-auto">
    </div>
    <h1>WELCOME</h1>
    <p>Your Campus Marketplace for everything.</p>
    <button class="btn-primary" onclick="openModal()">Get Started</button>
</div>

<div class="modal-overlay" id="modal">
    <div class="modal-content">
        <h2 class="text-2xl font-black text-blue-900 mb-6">Join Us</h2>
        <a href="{{ route('login') }}" class="modal-btn login-btn">LOGIN</a>
        <a href="{{ route('register') }}" class="modal-btn signup-btn">SIGN UP</a>
        <div class="cancel-btn font-bold" onclick="closeModal()">Cancel</div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modal').classList.remove('active');
    }
</script>

</body>
</html>
