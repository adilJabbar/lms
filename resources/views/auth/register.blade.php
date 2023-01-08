


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Speek2Impact</title>
    <!-- css link  -->
    <link rel="stylesheet" href="{{url('css/')}}/signup.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header">
                <div class="logo"><h1>Speak2Impact Academy</h1></div>
                <div class="login-action">
                    <a href="{{route('login')}}""><button class="start-learning">Login</button></a>
                </div>
            </div>

        </div>
    </header>
    <div class="signup-area">
            <h1>Sign up</h1>
            <span>Get started by filling up details below</span>
            <div class="signup-option">
                <button type="button">   <a href="{{ url('login/google') }}"> <img src="{{url('images/')}}/google.svg" alt="" />  Log in with Google </a></button>
                <button><img src="{{url('images/')}}/fb.svg" alt=""> Log in with Facebook</button>
            </div>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="signup-field">
            <label for="exampleInputEmail1" class="form-label">First Name</label>
            <input type="text" class="form-control f-img" name="first_name" required="required" placeholder="Enter First name">
            <img src="{{url('images/')}}/person.svg" alt="">
             </div>
             <div class="signup-field">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                <input type="text" class="form-control f-img" name="last_name" required="required" placeholder="Enter last name">
                <img src="{{url('images/')}}/person.svg" alt="">
                 </div>
                 <div class="signup-field">
                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                    <input type="text" class="form-control f-img" name="phone_number" required="required" placeholder="Enter phone number">
                    <img src="{{url('images/')}}/call.svg" alt="">
                     </div>
                 <div class="signup-field">
                    <label for="exampleInputEmail1" class="form-label">Email id</label>
                    <input type="email" class="form-control" name="email" required="required" placeholder="Enter email id">
                    <img src="{{url('images/')}}//mail.svg" alt="">
                     </div>
             <div class="signup-field">
                <label for="exampleInputEmail1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required="required" placeholder="Enter password">
                 </div>
                 <div class="signup-field">
                    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required="required" placeholder="Confirm Password">
                     </div>
                     <div class="signup-field">
                        <label for="exampleInputEmail1" class="form-label">City</label>
                        <input type="text" class="form-control f-img" name="city" placeholder="City">
                        <img src="{{url('images/')}}/location_on.svg" alt="">
                         </div>
            <button type="submit" class="signup-m">Register</button>
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
