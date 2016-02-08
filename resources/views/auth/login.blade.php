
<!DOCTYPE html>
<html>
    <head>


        <title>Login Form - Authentication</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    </head>
    <body>

        <!-- resources/views/auth/login.blade.php -->

        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password" id="password">
            </div>

            <div>
                <input type="checkbox" name="remember"> Remember Me
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>


    </body>
</html>