<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
    @toastifyCss
    <style>
    body {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgb(234, 208, 200);

    }

    .form-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 16px;
        background-color: rgb(211, 163, 149);

    }

    .heading {
        color: #fff;
        margin: 0 auto;
        display: block;
        text-align: center;
    }

    .form-label {
        color: #fff;
    }

    .form-text {
        color: #fff;
    }

    .form-check-label {
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-6">
                <div class="form-container">
                    <h1 class="heading">Đăng nhập</h1>
                    <form action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                placeholder="Nhập mật khẩu">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                placeholder="Nhập lại mật khẩu">
                        </div> -->
                        <button type="submit" class="btn btn-dark">Đăng nhập</button>
                        <a style="color:black;" href="/forget/password">Quên mật khẩu</a>&nbsp; &nbsp;
                        <a style="color:black;" href="/regis">Đăng ký</a>
                    </form>
                </div>

            </div>
            <div class="col-3">

            </div>
        </div>

    </div>
</body>

</html>
@toastifyJs