
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <!-- css link  -->.
    <link rel="stylesheet" href="{{url('css/')}}/login.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header">
                <div class="logo"><h1>Speak2Impact Academy</h1></div>
                <div class="login-action">
                    <a href="{{route('register')}}"><button class="start-learning">Sign Up</button></a>
                </div>
            </div>

        </div>
    </header>
    <div class="login-area">
            <h1>Log In</h1>
            <span>Get started by filling up details below</span>
            <div class="login-option">
                <button><img src="{{url('images/')}}/google.svg" alt=""> Log in with Google</button>
                <button><img src="{{url('images/')}}/fb.svg" alt=""> Log in with Facebook</button>
            </div>
            <form method="POST" action="{{ route('Signin') }}">
                @csrf
            <div class="login-field">
            <label for="exampleInputEmail1" class="form-label">Email id</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email id">
            <img src="{{url('images/')}}//mail.svg" alt="">
             </div>
             <div class="login-field">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
                 </div>
            <button type="submit" class="login-m">Log In</button>
          </form>
    </div>


    <footer>
        <div class="container">
         <div class="footer">
             <div class="footer-top">
             <div class="footer-logo"><span>Speak2Impact Academy</span></div>
             <div class="footer-link">
                 <a href="#">Contact US</a>
                 <a href="#">Speak2impact</a>
                 <a href="#">Sign up</a>
                 <a href="#">Login</a>
             </div>
         </div>
         <div class="social-icon">
             <a href="#"><img src="{{url('images/')}}/icons8-instagram.svg" alt=""></a>
             <a href="#"><img src="{{url('images/')}}/icons8-facebook.svg" alt=""></a>
         </div>
         </div>
        </div>
     </footer>
 </body>
 </html>
