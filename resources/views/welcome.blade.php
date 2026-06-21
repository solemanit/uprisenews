<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - Under Construction</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #fff;
            text-align: center;
        }

        .container {
            max-width: 500px;
            padding: 20px;
        }

        h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255,255,255,0.2);
            border-top-color: #ffffff;
            border-radius: 50%;
            margin: 20px auto;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            opacity: 0.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🚧 Under Construction</h1>

        <div class="spinner"></div>

        <p>
            We're working hard to bring something awesome for you.<br>
            Please check back soon.
        </p>

        <div class="footer">
            © {{ date('Y') }} {{ config('app.name', 'Laravel') }}
        </div>
    </div>
</body>
</html>
