<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Speak2 Impact Academy</title>
        <!-- css link  -->
        <link rel="stylesheet" href="{{asset('/css/membership2.css')}}">
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'></script>
    </head>
    <script>
$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function () {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function () {
        return false;
    })

});
    </script>

    <body>

        <header>
            <div class="container">
                <div class="header">
                    <div class="logo">
                        <h1>Speak2Impact Academy</h1>
                    </div>
                    @if(auth()->check())
                    <div class="login-action">
                        {{auth()->user()->first_name}}
                    </div>
                    @else
                    <div class="login-action">
                        <button class="start-learning">Login</button>
                    </div>
                    @endif
                </div>

            </div>
        </header>

        <!-- MultiStep Form -->



        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
            <div class="row">
                <div class="col-md-12 mx-0">
                    <form id="msform" method="post" enctype="multipart/form-data" action="{{route('savePaymentDetail')}}">
                        @csrf
                        <input type="hidden" name='user_id' value ='{{Crypt::encrypt($data['user_id'])}}'>
                        <input type="hidden" name='subscription_id' value ='{{Crypt::encrypt($data['subscription_id'])}}'>
                        <!-- progressbar -->
                        <ul id="progressbar" style="display: flex; justify-content: center;">
                            <li onclick="history.go(-1);" class="active" id="account"><strong style="float: left; margin-left: -8%;">Select
                                    membership</strong></li>
                            <li class ='active' id="confirm"><strong style="float: right;  margin-right: -8%;">Payment details</strong></li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card col-sm-12 col-md-6 col-lg-6">
                                <div class="membership-payment">
                                    <h1>Payment details</h1>
                                    <form method="post" enctype="multipart/form-data" action="{{route('savePaymentDetail')}}">
                                        @csrf
                                        <div class="membership-field">
                                            <label for="exampleInputEmail1" class="form-label">Card number</label>
                                            <input type="text" class="form-control f-img"
                                                   placeholder="Enter credit card name" name='card_number' required>
                                            <img src="./images/credit_card.svg" alt="">
                                            <div class="master-card">
                                                <a href="#"><img src="./images//visa.svg" alt=""></a>
                                                <a href="#"><img src="./images/m-card.svg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="membership-field m-half">
                                                <label for="exampleInputEmail1" class="form-label">Expiry date</label>
                                                <input name='card_expiry' type="text" class="form-control" placeholder="DD/MM/YYYY" required>
                                            </div>
                                            <div class="membership-field m-half">
                                                <label for="exampleInputEmail1" class="form-label">CVV</label>
                                                <input type="text" class="form-control" placeholder="Enter CVV">
                                            </div>
                                        </div>

                                        <div class="devider-line"></div>
                                        <div class="row" style="margin-bottom: 5%;">
                                            <div class="membership-field m-half">
                                                <span for="exampleInputEmail1"
                                                      style="font-weight: bold; color: black; font-size: 18px;"
                                                      class="form-label">Total</span>

                                            </div>
                                            <div class="membership-field m-half">
                                                <span for="exampleInputEmail1"
                                                      style="float: right; font-weight: bold; color: #1C1C1C; font-size: 18px;"
                                                      class="form-label">£1200 per year</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="m-payment"
                                                style="background-color: #1C1C1C; color: #fff;"> Start membership</button>

                                        <button style="margin-top: 5%;" type="submit" class="m-payment"><img
                                                src="./images/pp.svg" alt=""> Pay with
                                            Paypal</button>
                                    </form>
                                </div>
                            </div>

<!--                            <input type="button" name="previous" onclick="history.go(-1);" class="previous action-button-previous" value="Previous" />-->
                        </fieldset>
                    </form>


                </div>
            </div>
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
                        <a href="#"><img src="./images/icons8-instagram.svg" alt=""></a>
                        <a href="#"><img src="./images/icons8-facebook.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </footer>
    </body>

</html>