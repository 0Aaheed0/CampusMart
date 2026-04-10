<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up | CampusMart</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Google One Tap SDK -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'Poppins',sans-serif;
background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
overflow:hidden;
position:relative;
color:white;
}

/* glow blobs */

.blob{
position:absolute;
width:500px;
height:500px;
background:#3b82f6;
filter:blur(140px);
opacity:0.25;
border-radius:50%;
animation:move 20s infinite alternate;
}

.blob2{
right:-150px;
bottom:-150px;
background:#22c55e;
}

.blob3{
left:-150px;
top:-150px;
background:#60a5fa;
}

@keyframes move{
from{transform:translate(0,0)}
to{transform:translate(80px,60px)}
}

/* glass card */

.glass-card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(25px);
border:1px solid rgba(255,255,255,0.15);
border-radius:30px;
padding:50px 40px;
width:90%;
max-width:480px;
box-shadow:0 40px 80px rgba(0,0,0,0.4);
text-align:center;
}

/* icon */

.icon-circle{
width:70px;
height:70px;
background:white;
border-radius:20px;
display:flex;
align-items:center;
justify-content:center;
margin:0 auto 20px;
color:#2563eb;
font-size:1.6rem;
}

/* title */

h2{
font-size:1.8rem;
font-weight:800;
margin-bottom:25px;
}

/* inputs */

.input-group{
position:relative;
margin-bottom:15px;
}

.input-group i:not(.password-toggle){
position:absolute;
left:18px;
top:50%;
transform:translateY(-50%);
color:#94a3b8;
}

input{
width:100%;
padding:14px 15px 14px 50px;
border-radius:14px;
border:none;
outline:none;
background:rgba(255,255,255,0.15);
color:white;
font-size:0.9rem;
}

input::placeholder{
color:#cbd5f5;
}

input:focus{
background:rgba(255,255,255,0.25);
}

/* password toggle */

.password-toggle{
position:absolute;
right:18px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
color:#cbd5f5;
}

/* button */

button{
width:100%;
padding:15px;
background:linear-gradient(135deg,#2563eb,#3b82f6);
border:none;
border-radius:14px;
color:white;
font-weight:700;
font-size:1rem;
cursor:pointer;
margin-top:15px;
transition:0.3s;
box-shadow:0 10px 25px rgba(37,99,235,0.5);
}

button:hover{
transform:scale(1.05);
box-shadow:0 0 20px rgba(59,130,246,0.9);
}

/* footer */

.footer-links{
margin-top:20px;
font-size:0.85rem;
color:#cbd5f5;
}

.footer-links a{
color:#93c5fd;
font-weight:700;
text-decoration:none;
}

.footer-links a:hover{
text-decoration:underline;
}

/* error */

.error-container{
background:rgba(239,68,68,0.15);
padding:15px;
border-radius:12px;
margin-bottom:20px;
text-align:left;
font-size:0.8rem;
color:#fecaca;
}

</style>
</head>

<body>

<div class="blob blob3"></div>
<div class="blob"></div>
<div class="blob blob2"></div>

<div class="glass-card">

<div class="icon-circle">
<i class="fas fa-user-plus"></i>
</div>

<h2>Create Account</h2>

@if ($errors->any())
<div class="error-container">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<!-- Google One Tap Container -->
<div id="g_id_onload"
     data-client_id="{{ config('google.client_id') }}"
     data-callback="handleCredentialResponse">
</div>
<div class="g_id_signin" data-type="standard" data-size="large" data-theme="dark" data-text="signup_with" data-shape="rectangular" data-logo_alignment="left"></div>

<div style="display: flex; align-items: center; margin: 25px 0; gap: 12px;">
    <div style="flex: 1; height: 1px; background: rgba(255, 255, 255, 0.2);"></div>
    <span style="font-size: 0.75rem; color: #cbd5f5; font-weight: 600;">OR</span>
    <div style="flex: 1; height: 1px; background: rgba(255, 255, 255, 0.2);"></div>
</div>

<form method="POST" action="{{ route('register') }}">
@csrf

<div class="input-group">
<input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" autocomplete="name" required>
<i class="fas fa-user"></i>
</div>

<div class="input-group">
<input type="email" name="email" placeholder="Email Address (@aust.edu)" value="{{ old('email') }}" autocomplete="email" required>
<i class="fas fa-envelope"></i>
</div>

<div class="input-group">
<input type="password" id="password" name="password" placeholder="Create Password" autocomplete="new-password" required>
<i class="fas fa-lock"></i>
<i class="fas fa-eye password-toggle" onclick="togglePass('password')"></i>
</div>

<div class="input-group">
<input type="password" id="confirm" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" required>
<i class="fas fa-shield-alt"></i>
<i class="fas fa-eye password-toggle" onclick="togglePass('confirm')"></i>
</div>

<button type="submit">
SIGN UP
</button>

</form>

<div class="footer-links">
Already have an account?
<a href="{{ route('login') }}">Login instead</a>
</div>

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
        auto_select: false,
    });
    
    // Display One Tap UI
    google.accounts.id.renderButton(
        document.querySelector('.g_id_signin'),
        { theme: 'dark', size: 'large', text: 'signup_with' }
    );
};

function togglePass(id){
    const field = document.getElementById(id);
    const icon = field.nextElementSibling.nextElementSibling;

    if(field.type === "password"){
        field.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        field.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}

</script>

</body>
</html>