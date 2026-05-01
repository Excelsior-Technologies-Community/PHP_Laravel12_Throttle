<!DOCTYPE html>
<html>

<head>
    <title>Throttle Test - Limited</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #2563eb;
            margin-bottom: 20px;
        }

        .box {
            background: #e0f2fe;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .warning {
            color: #dc2626;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>🚦 Laravel Throttle Test</h2>

        <div class="box">
            <p>{{ $message }}</p>
        </div>

        <p>⚡ Limit: <b>5 requests per minute</b></p>

        <p class="warning">After limit → 429 Too Many Requests</p>

        <a href="/limited" class="btn">Refresh Page</a>

    </div>

</body>

</html>