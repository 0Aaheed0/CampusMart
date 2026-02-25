<!DOCTYPE html>
<html lang="en">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg w-1/3">
            <h3 class="text-2xl font-bold text-center text-blue-600">Login</h3>
            <form id="loginForm" action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mt-4">
                    <div>
                        <label class="block" for="email">Email</label>
                        <input type="email" placeholder="Email"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            id="email" name="email" required>
                    </div>
                    <div class="mt-4">
                        <label class="block" for="password">Password</label>
                        <input type="password" placeholder="Password"
                            class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                            id="password" name="password" required>
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button type="submit"
                            class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                        <a href="/register" class="text-sm text-blue-600 hover:underline">Don't have an account?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/js/app.js'], 'build')
</body>
</html>