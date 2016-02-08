
<!DOCTYPE html>
<html>
    <head>


        <title>Login Form - Authentication</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="/css/style.css" rel="stylesheet" />

    </head>
    <body>

        <!-- resources/views/auth/login.blade.php -->
        <div style="border:solid; border-width:thin; border-color:silver; margin-bottom:10px width:100%">
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
        </div>

        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


        <!-- Jquery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    </body>
</html>