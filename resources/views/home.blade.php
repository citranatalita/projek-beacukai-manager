<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beacukai Manager - Welcome</title>
    <style>
        body {
            font-family: 'Playfair Display', sans-serif;
            background-color: #D2A6A0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            overflow: hidden;
        }

        .container {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transform: scale(0.95);
            animation: slideUp 1s ease-out forwards;
        }

        @keyframes slideUp {
            0% {
                transform: translateY(100px) scale(0.95);
                opacity: 0;
            }
            100% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        img {
            max-width: 50%;
            height: auto;
            border-radius: 12px;
            transition: transform 0.3s ease-in-out;
        }

        img:hover {
            transform: scale(1.05);
        }

        h1 {
            margin-top: 30px;
            font-size: 36px;
            color: #333;
            font-weight: bold;
            letter-spacing: 1px;
        }

        p {
            font-size: 18px;
            color: #777;
            margin-top: 10px;
        }

        .button {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background-color: #c55454ff;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #c55454ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Gambar -->
        <img src="https://i.pinimg.com/736x/7c/c1/5e/7cc15eb9251f08761c99545aa0276f67.jpg" alt="Welcome Image">
        
        <!-- Teks -->
        <h1>Hy, Welcome!</h1>
        <p>Welcome to the Beacukai Manager </p>
        
        <!-- Button -->
       <a href="{{ route('admin.login') }}" class="button">Get Started</a>
       
    </div>
</body>
</html>
