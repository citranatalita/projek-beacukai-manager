<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Customer</title>
    <style>
        body {
            font-family: 'Playfair Display', sans-serif;
            background-color: #eebdbdff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #c55454fff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #c55454ff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c55454ff;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #366494ff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>☰ Register Customer</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('customer.register.submit') }}">
    @csrf
    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" name="name" required value="{{ old('name') }}">
    </div>

    <div class="form-group">
        <label for="email">✉︎ Email</label>
        <input type="email" name="email" required value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label for="password">🔑 Password</label>
        <input type="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">🔐 Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <button type="submit">Daftar ⌯⌲</button>
    </div>
</form>

<div class="login-link">
    Sudah punya akun? <a href="{{ route('customer.login.form') }}">Login di sini</a>
</div>

</body>
</html>
