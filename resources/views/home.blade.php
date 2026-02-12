<!DOCTYPE html>
<html>
<head>
    <title>Home | CampusMart</title>
</head>
<body style="font-family: Arial; text-align:center; margin-top:100px;">

    <h1>Welcome to CampusMart 🎓</h1>

    <p>You are successfully logged in.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
