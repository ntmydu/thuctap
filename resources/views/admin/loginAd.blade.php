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
        background: rgb(1, 38, 12);
        background: linear-gradient(162deg, rgba(1, 38, 12, 1) 0%, rgba(23, 77, 25, 1) 34%, rgba(1, 25, 1, 1) 100%);
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
            <div class="col-md-6">
                <div class="form-container">

                    <h1 class="heading">Đăng nhập Admin</h1>
                    <form action="{{route('admin.login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-success">Đăng nhập</button>
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