<!-- resources/views/user-detail.blade.php -->
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل کاربر</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2D3748;
            color: #E2E8F0;
            direction: rtl;
            text-align: right;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
        }
        .nav ul li {
            display: inline;
        }
        .nav ul li a {
            text-decoration: none;
            color: #63B3ED;
        }
        .card {
            background-color: #1A202C;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 {
            margin-top: 0;
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #4A5568;
        }
        table th {
            background-color: #4A5568;
        }
    </style>
</head>
<body>
<div class="container">
{{--    <div class="header">--}}
{{--        <h1>پروفایل کاربر</h1>--}}
{{--        <nav class="nav">--}}
{{--            <ul>--}}
{{--                <li><a href="{{ route('dashboard') }}">داشبورد</a></li>--}}
{{--                <li><a href="{{ route('user-detail', ['id' => auth()->user()->id]) }}">پروفایل</a></li>--}}
{{--                <li><a href="{{ route('banks.index') }}">بانک‌ها</a></li>--}}
{{--                <li><a href="{{ route('tags.index') }}">برچسب‌ها</a></li>--}}
{{--                <li><a href="{{ route('transactions.index') }}">تراکنش‌ها</a></li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}

    <div class="card">
        <h2>اطلاعات کاربر</h2>
        <table>
            <tr>
                <th>نام</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>ایمیل</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>شماره</th>
                <td>{{ $user->number }}</td>
            </tr>
            <tr>
                <th>موجودی</th>
                <td>{{ $user->user_balance }}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
