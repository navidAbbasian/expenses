<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ساخت کاربر</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2c2c2c;
            color: #ffffff;
            direction: rtl;
        }
        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
        }
        .information {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-container {
            background-color: #3c3c3c;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: right;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ffcc00;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 2px solid #444;
            border-radius: 5px;
            background-color: #555;
            color: #fff;
            text-align: right;
        }
        .form-group input:focus {
            outline: none;
            border-color: #ffcc00;
        }
        .btn {
            padding: 12px 20px;
            color: white;
            background-color: #ff8c00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            float: left;
        }
        .btn:hover {
            background-color: #ff7000;
        }
        .link {
            display: block;
            margin-bottom: 20px;
            color: #ffcc00;
            text-align: center;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="information">
        <h2>اکانت خود را بسازید و وارد پنل مدیریتی هزینه ها شوید</h2>
        <h3>ما تو هزینه ها تراکنش هایی که شما ثبت میکنید رو بررسی میکنیم و بهتون میگیم که توی هر دوره زمانی چقدر خرج چی کردید</h3>
    </div>
    <div class="form-container">
        <h2>فرم ساخت کاربر</h2>
        <form action="/create-user" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">نام:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="number">تلفن:</label>
                <input type="text" id="number" name="number" required>
            </div>
            <div class="form-group">
                <label for="email">ایمیل:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-footer">
                <a href="/admin/login" class="link">اگر حساب دارید وارد شوید</a>
                <button type="submit" class="btn">ساخت کاربر</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
