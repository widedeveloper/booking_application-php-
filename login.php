<!DOCTYPE html>
<html lang="en-US" class="no-js no-svg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Book your Experience | Login</title>
    <link type="text/css" rel="stylesheet" href="assets/css/booker.css" />
    <link rel="stylesheet" href="https://use.typekit.net/gub8scf.css">
</head>

<body id="BookAppointment">

    <div id="BookingSec" class="col-md-12 myaccount">
        <div class="container">


            <div class="col-md-7 col-sm-7 col-xs-12" id="LeftSec">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 HeaderBar noBorder">
                        <h4 class=" tk-garamond-premier-pro-display">First time here? Create an account</h4>
                    </div>
                    <!--HeaderBar-->

                    <form method="post" action="" id="register">
                        <input type="hidden" name="type" value="CreateCustomerAndUserAccount">
                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>* First Name</h5>
                                    <input name="firstName" type="text" placeholder="First Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper pull-right">
                                    <h5>* Last Name</h5>
                                    <input name="lastName" type="text" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper fullwidth">
                                    <h5>Email</h5>
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Phone</h5>
                                    <input name="phone" type="number" placeholder="Phone">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper pull-right">
                                    <h5>Birthday</h5>
                                    <input name="birthday" type="text" placeholder="Jan 01,2000">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Password</h5>
                                    <input name="password" type="password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper pull-right">
                                    <h5>Confirm Password</h5>
                                    <input name="confirmpassword" type="password" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>

                        <input name="submit" type="submit" value="Sign Up" class="button col-md-12 col-sm-12 col-xs-12">
                    </form>

                </div>
            </div>
            <!--LeftSec-->

            <div class="col-md-5 col-sm-5 col-xs-12 pull-right" id="RightSec">
                <div class="col-md-12 col-sm-12 col-xs-12 HeaderBar noBorder">
                    <h4 class=" tk-garamond-premier-pro-display">Log In</h4>
                </div>

                <div id="LoginFrm">
                    <form method="post" action="" id="login">
                        <input type="hidden" name="type" value="Login">
                        <div class="col-md-12 col-sm-12col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Email</h5>
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Password</h5>
                                    <input name="password" type="password" placeholder="Password">
                                    <a href="#" class="forgotLink">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                        <input name="submit" type="submit" value="Sign In" class="button col-md-12 col-sm-12 col-xs-12">
                    </form>
                </div>

                <div id="RecoverPwd" style="display:none;">
                    <h5>Reset Password</h5>
                    <form method="post" action="" id="ResetPwd">
                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>First Name</h5>
                                    <input name="firstname" type="text" placeholder="Firsts Name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Email</h5>
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <input name="submit" type="submit" value="Reset Password" class="button col-md-12 col-sm-12 col-xs-12">
                        <a href="#" class="cancelLink text-center" style="width:100%;">Cancel</a>
                    </form>


                </div>

            </div>
            <!--RightSec-->

        </div>
    </div>

    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".forgotLink").click(function() {
                $("#LoginFrm").hide(200);
                $('#RecoverPwd').fadeIn(500);
            });


            $(".cancelLink").click(function() {
                $("#RecoverPwd").hide(200);
                $('#LoginFrm').fadeIn(500);
            });
            
            $("#register").submit(function( event ) {
                
                event.preventDefault();
            
                $.ajax({
                  method: "POST",
                  url: "app/ajax_requests.php",
                  data: $(this).serialize()
                })
                .fail(function( msg ) {
                    console.log(msg)    
                })
                .done(function( msg ) {
                    // console.log(msg);
                });
                
            
            });
            
            $("#login").submit(function( event ) {
                
                event.preventDefault();
            
                $.ajax({
                  method: "POST",
                  url: "app/ajax_requests.php",
                  data: $(this).serialize()
                })
                .fail(function( msg ) {
                    console.log(msg)    
                })
                .done(function( msg ) {
                    var json = $.parseJSON(msg);
                    if (json.result == 'success') {
                        window.location.href = data.redirect;
                    }                    
                });  
            });

        });
        


    </script>
</body>

</html>
