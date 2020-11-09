<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="login-page" style="background-image: url({{ asset('images/admin.jpg') }})">
<div class="login-box">
    <div class="login-box-body">
        <form action="{{ route('admin.login') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group has-feedback">
                <input type="text" name="email" class="form-control" placeholder="Email"/>
                <i class="fa fa-envelope form-control-feedback"></i>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
                <i class="fa fa-lock fa-fw"></i>
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>
