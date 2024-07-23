<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه اصلی</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .bg {
            background-image: url('{{ asset('images/home-background.png') }}');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .content {
            color: white;
            font-size: 2em;
        }
        .button {
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 1em;
            color: white;
            background-color: #ff8c00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #ff7000;
        }
    </style>
</head>
<body>
<div class="bg">
    <div class="content">
        <h1>به هزینه ها خوش آمدید</h1>
        <a href="{{ url('/create-user') }}" class="button">شروع کنید</a>
    </div>
</div>
</body>
</html>
