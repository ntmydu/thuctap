<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Quên mật khẩu</title>
    @toastifyCss
    <style>
    body {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgb(1, 38, 12);
        background: #faeade;
    }

    .form-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 16px;

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
                <form action="{{route('send.request')}}" method="POST">
                    <div style="border: 2px  solid #000; background-color: #dfcec1 " class="form-container">
                        <h1 style="color: #000;" class="heading">Quên mật khẩu</h1>
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label style="color: #000;" for="exampleInputEmail1" class="form-label">Email đã đăng
                                    ký</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>

                            <button type="submit" class="btn btn-dark">Lấy mã xác nhận</button>


                    </div>
                </form>

            </div>
            </form>
            <div class="col-3">

            </div>
        </div>

    </div>
</body>

</html>
@toastifyJs