<!DOCTYPE html>
<html>

<head>
    <title>Custom Throttle</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            margin: 0;
            padding: 0;
            color: white;
        }

        .container {
            max-width: 700px;
            margin: 80px auto;
            background: white;
            color: black;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #7c3aed;
        }

        .info {
            background: #ede9fe;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .danger {
            color: red;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #7c3aed;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #6d28d9;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>⚡ Custom Rate Limit Test</h2>

        <div class="info">
            {{ $message }}
        </div>

        <p>⏱ Limit: <b>3 requests per minute</b></p>

        <p class="danger">After limit → 429 Error</p>

        <a href="/custom-limited" class="btn">Try Again</a>

    </div>

</body>

</html>