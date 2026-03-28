<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome | CampusMart</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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

/* glow background blobs */

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

/* floating academic icons */

.icon{
position:absolute;
font-size:40px;
opacity:0.15;
animation:float 6s infinite alternate ease-in-out;
}

.icon1{top:12%;left:10%;}
.icon2{bottom:18%;left:15%;animation-delay:1s;}
.icon3{top:18%;right:12%;animation-delay:2s;}
.icon4{bottom:12%;right:18%;animation-delay:3s;}

@keyframes float{
from{transform:translateY(0)}
to{transform:translateY(25px)}
}

/* glass card */

.glass-box{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(25px);
border:1px solid rgba(255,255,255,0.15);
border-radius:30px;
padding:60px 45px;
width:90%;
max-width:520px;
text-align:center;
box-shadow:0 40px 80px rgba(0,0,0,0.4);
transition:0.4s;
}

.glass-box:hover{
transform:translateY(-8px);
box-shadow:0 60px 100px rgba(0,0,0,0.5);
}

/* logo */

.logo-box{
width:90px;
height:90px;
margin:auto;
margin-bottom:25px;
background:white;
border-radius:20px;
display:flex;
align-items:center;
justify-content:center;
padding:10px;
}

.logo-box img{
width:100%;
}

/* title */

h1{
font-size:3rem;
font-weight:800;
letter-spacing:1px;
margin-bottom:8px;
}

.subtitle{
font-size:1.2rem;
color:#93c5fd;
margin-bottom:10px;
font-weight:600;
}

.desc{
font-size:1rem;
color:#cbd5f5;
margin-bottom:35px;
line-height:1.6;
}

/* button */

.btn-main{
background:linear-gradient(135deg,#2563eb,#3b82f6);
border:none;
padding:16px 35px;
border-radius:15px;
font-weight:700;
font-size:1rem;
color:white;
cursor:pointer;
width:100%;
transition:0.3s;
box-shadow:0 10px 25px rgba(37,99,235,0.5);
}

.btn-main:hover{
transform:scale(1.05);
box-shadow:0 0 20px rgba(59,130,246,0.9);
}

/* modal */

.modal{
position:fixed;
inset:0;
background:rgba(0,0,0,0.6);
backdrop-filter:blur(10px);
display:flex;
align-items:center;
justify-content:center;
opacity:0;
pointer-events:none;
transition:0.3s;
}

.modal.active{
opacity:1;
pointer-events:auto;
}

.modal-box{
background:rgba(255,255,255,0.95);
color:#1e293b;
padding:40px;
border-radius:25px;
text-align:center;
width:320px;
transform:scale(0.85);
transition:0.3s;
}

.modal.active .modal-box{
transform:scale(1);
}

.modal-box h2{
margin-bottom:20px;
font-weight:800;
}

.modal-btn{
display:block;
padding:13px;
border-radius:12px;
margin:10px 0;
font-weight:700;
text-decoration:none;
}

.login{
background:#2563eb;
color:white;
}

.signup{
background:#f1f5f9;
color:#1e3a8a;
border:1px solid #cbd5f5;
}

.modal-btn:hover{
transform:scale(1.05);
}

.cancel{
margin-top:10px;
font-size:0.9rem;
cursor:pointer;
color:#64748b;
}

.cancel:hover{
color:#0f172a;
}

</style>
</head>

<body>

<!-- background blobs -->

<div class="blob blob3"></div>
<div class="blob"></div>
<div class="blob blob2"></div>

<!-- floating icons -->

<i class="fa-solid fa-book icon icon1"></i>
<i class="fa-solid fa-pencil icon icon2"></i>
<i class="fa-solid fa-cart-shopping icon icon3"></i>
<i class="fa-solid fa-graduation-cap icon icon4"></i>

<!-- main glass card -->

<div class="glass-box">

<div class="logo-box">
<img src="{{ asset('images/logo.png') }}" alt="CampusMart Logo">
</div>

<h1>CampusMart</h1>

<div class="subtitle">
Buy • Sell • Exchange
</div>

<div class="desc">
The student marketplace where you can buy and sell books,
notes, and stationery within your campus community.
</div>

<button class="btn-main" onclick="openModal()">
Get Started
</button>

</div>

<!-- modal -->

<div class="modal" id="modal">

<div class="modal-box">

<h2>Join CampusMart</h2>

<a href="{{ route('login') }}" class="modal-btn login">
LOGIN
</a>

<a href="{{ route('register') }}" class="modal-btn signup">
SIGN UP
</a>

<div class="cancel" onclick="closeModal()">
Cancel
</div>

</div>

</div>

<script>

function openModal(){
document.getElementById('modal').classList.add('active');
}

function closeModal(){
document.getElementById('modal').classList.remove('active');
}

</script>

</body>
</html>