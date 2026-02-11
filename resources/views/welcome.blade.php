<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Travel App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 60px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            opacity: 0.9;
        }

        .btn {
            margin-top: 30px;
            padding: 12px 30px;
            background: white;
            color: #2a5298;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>WELCOME</h1>
        <p>Welcome to your Traveling App 🚀</p>
        <a href="{{ url('/login') }}" class="btn">Get Started</a>
    </div>

</body>
</html>
