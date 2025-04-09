<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .info {
        margin: 20px 0;
    }

    .info p {
        margin: 10px 0;
        font-size: 16px;
        color: #555;
    }

    .info p span {
        font-weight: bold;
        color: #333;
    }

    .actions {
        text-align: center;
        margin-top: 20px;
    }

    .actions a,
    .actions button {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        color: #fff;
        background-color: #4CAF50;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        border: none;
        cursor: pointer;
    }

    .actions a:hover,
    .actions button:hover {
        background-color: #45a049;
    }

    .change-password {
        margin-top: 30px;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .change-password h3 {
        margin-bottom: 15px;
        color: #333;
    }

    .change-password form input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .change-password form button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .change-password form button:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Thông tin tài khoản</h2>
        <div class="info">
            <p><span>Tên người dùng:</span> {{ $user->name }}</p>
            <p><span>Email:</span> {{ $user->email }}</p>
            <p><span>Số điện thoại:</span> {{ $user->phone }}</p>
            <p><span>Địa chỉ:</span> {{ $user->address }}</p>
            <p><span>Ngày tạo tài khoản:</span> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="change-password">

            <form action="{{route('user.changepass')}}">
                @csrf
                <input type="email" name="email_hidden" value="{{ $user->email }}" hidden>
                <button type="submit">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</body>

</html>