<!DOCTYPE html>
<html lang="en-US" class="no-js no-svg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Book your Experience | Login</title>
    <link type="text/css" rel="stylesheet" href="assets/css/booker.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/custom.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/responsive.css" />
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap-datepicker/bootstrap-datepicker3.css" />
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
                        <div class="row  ">
                            <div class="col-md-6 FieldBlock">
                                    <div class="selectric-wrapper">
                                        <label for="FirstName">*First Name</label>
                                        <input name="firstName" type="text" placeholder="First Name" id="FirstName" required oninvalid="this.setCustomValidity('First Name is required')" oninput="setCustomValidity('')">
                                    </div>
                            </div>

                            <div class="col-md-6 FieldBlock">
                                    <div class="selectric-wrapper pull-right">
                                        <label for="LastName">*Last Name</label>
                                        <input name="lastName" type="text" placeholder="Last Name" id="LastName" required oninvalid="this.setCustomValidity('Last Name is required')" oninput="setCustomValidity('')">
                                    </div>
                            </div>
                        </div>
                        
                        <div class="row ">
                            <div class="col-md-12 FieldBlock">
                                <div class="selectric-wrapper fullwidth">
                                    <label for="Email">*Email</label>
                                    <input name="email" type="email" placeholder="Email" id="Email" required oninvalid="this.setCustomValidity('Email is required')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                        <div class="row phone_row">
                            <div class="col-md-6 FieldBlock">
                                    <div class="selectric-wrapper">
                                        <label for="Phone">*Phone</label>
                                        <input name="phone" type="number" placeholder="Phone" id="Phone" required oninvalid="this.setCustomValidity('Phone is required')" oninput="setCustomValidity('')">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" name="confirmMsg" value="on" id="confirmMsg" checked="" />
                                            <label for="Phone" class="smstext">                                        
                                                I accept text messages.
                                            </label>
                                            <input type="hidden" name="SMScheckedStatus" id="SMScheckedStatus" value="checked" />
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-6 FieldBlock">
                                    
                                    <div class="selectric-wrapper pull-right">

                                        <div class="selectric-wrapper">
                                            <label for="birthday">*Birthday</label>
                                            <input name="birthday" type="text" placeholder="mm/dd/yyyy" id="birthday" required="" oninvalid="this.setCustomValidity('Birthday is required')" oninput="setCustomValidity('')"/>
                                        </div>

                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 FieldBlock">                            
                                    <div class="selectric-wrapper">
                                        <label for="Password">*Password</label>
                                        <input name="password" type="password" placeholder="Password" id="Password" required oninvalid="this.setCustomValidity('Password is required and must contain one number.')" oninput="setCustomValidity('')">
                                    </div>
                            </div>

                            <div class="col-md-6 FieldBlock">
                                    <div class="selectric-wrapper pull-right">
                                        <label for="ConfirmPassword">*Confirm Password</label>
                                        <input name="confirmpassword" type="password" placeholder="Confirm Password" id="ConfirmPassword" required oninvalid="this.setCustomValidity('Confirm Password is required')" oninput="setCustomValidity('')">
                                    </div>
                            </div>
                        </div>
                        <ul class="errorMessages"></ul>
                        <ul class="errorMessages1"></ul>
                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <input name="submit" type="submit" value="Sign Up" class="button col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </div> 
                        
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
                                    <label for="LoginEmail">Email</label>
                                    <input name="email" type="email" id="LoginEmail" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <label for="LoginPassword">Password</label>
                                    <input name="password" type="password" id="LoginPassword" placeholder="Password">
                                    <a href="#" class="forgotLink">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                        <ul class="errorMessages2"></ul>

                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <input name="submit" type="submit" value="Sign In" class="button col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </div> 
                        
                    </form>
                </div>

                <div id="RecoverPwd" style="display:none;">
                    <h5>Reset Password</h5>
                    <form method="post" action="" id="ResetPwd">
                        <input type="hidden" name="type" value="ForgotPassword">
                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <label for="ForgotPasswordFirstName">First Name</label>
                                    <input name="firstname" type="text" placeholder="First Name" id="ForgotPasswordFirstName" >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <label for="ForgotPasswordEmail">Email</label>
                                    <input name="email" type="email" id="ForgotPasswordEmail" placeholder="Email" >
                                </div>
                            </div>
                        </div>
                        <ul class="errorMessages3"></ul>
                        <div class="col-md-12 col-sm-12 col-xs-12 FieldBlock">
                            <div class="row">
                                <input name="submit" type="submit" value="Reset Password" class="button col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </div> 
                        
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
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/booker.js"></script>
	<script type="text/javascript" src="assets/js/jquery.inputmask.bundle.min.js"></script>	
	<script type="text/javascript" src="assets/js/form-input-mask.js"></script>	
    <script>
        $(document).ready(function() {

            $(".selectric").click(function () {
                $(".selectric-wrapper").removeClass('selectric-open');
                $(this).parent(".selectric-wrapper").toggleClass('selectric-open');
            });
            

            $(".forgotLink").click(function() {
                $("#LoginFrm").hide(200);
                $('#RecoverPwd').fadeIn(500);
            });


            $(".cancelLink").click(function() {
                $("#RecoverPwd").hide(200);
                $('#LoginFrm').fadeIn(500);
            });

            $("#confirmMsg").on("click", function(){
                if($(this).prop("checked")){
                    $("#SMScheckedStatus").val('checked'); 
                }else{
                    $("#SMScheckedStatus").val("off");  
                }                         
            })
            
            $("#register").submit(function( event ) {
                
                event.preventDefault();
                
                var errorList = $('ul.errorMessages1');
                errorList.hide();
                errorList.text('');
                if(hasNumber($("#Password").val()) == false) {
                    errorList.show();
                    errorList.append('Your password must have atleast 1 number.');
                    return;
                }

                if($("#Password").val() != $("#ConfirmPassword").val()) {
                    errorList.show();
                    errorList.append('Your password is not matched with ConfirmPassword.');
                    return;
                }
            
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
                    if (json.IsSuccess) {
                        $("#login #LoginEmail").val($("#register #Email").val());
                        $("#login #LoginPassword").val($("#register #Password").val());
                        $("#login").trigger("submit");
                    } else {
                        if(json.ArgumentErrors!=null){
                            for(i=0; i<json.ArgumentErrors.length;i++) {
                                errorList.show();
                                errorList.append(json.ArgumentErrors[i].ErrorMessage);
                            }
                        }else{
                            errorList.show();
                            errorList.append(json.ErrorMessage);
                        }
                    }
                });
                
            
            });
            
            function hasNumber(myString) {
              return /\d/.test(myString);
            }
            
            $("#login").submit(function( event ) {
                

                event.preventDefault();

                var errorList = $('ul.errorMessages2');
                errorList.hide();
                errorList.text('');

                if($("#LoginEmail").val()=="" || $("#LoginPassword").val()=="") {
                    errorList.show();
                    errorList.append('Please enter Email or Password.');
                    return;
                }

                $.ajax({
                  method: "POST",
                  url: "app/ajax_requests.php",
                  data: $(this).serialize()
                })
                .fail(function( msg ) {
                    console.log(msg)    
                })
                .done(function( msg ) {
                    if(msg!=""){
                        var json = $.parseJSON(msg);
                        if (json.result == 'success') {
                            window.location.href = '/booking/';
                        }else{
                            errorList.show();
                            errorList.append(json.result);
                        }
                    }else{
                        errorList.show();
                        errorList.append("Please enter correct Email or Password.");
                    }
                   
                });
                
            
            });
            
            $("#ResetPwd").submit(function( event ) {
                
                event.preventDefault();
                var errorList = $('ul.errorMessages3');
                errorList.hide();
                errorList.text('');
            
                if($("#ForgotPasswordFirstName").val()=="" || $("#ForgotPasswordEmail").val()=="") {
                    errorList.show();
                    errorList.append('Please enter FirstName or Email.');
                    return;
                }

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
                    if (json.IsSuccess) {
                        console.log("password resetted.")
                    }else{
                        errors = json.ErrorMessage;
                        errorList.show();
                        errorList.append(errors);

                    }
                });
                
            
            });

        });
        
        $(function() {
            var createAllErrors = function() {
                var form = $(this);
                var errorList = $('ul.errorMessages', form);

                var showAllErrorMessages = function() {
                    setTimeout(function(){   
                        errorList.empty();

                        //Find all invalid fields within the form.
                        form.find(':invalid').each(function(index, node) {
                            // console.log(node.id);
                            //Find the field's corresponding label
                            var label = $('label[for=' + node.id + ']');

                            //Opera incorrectly does not fill the validationMessage property.
                            var message = node.validationMessage || 'Invalid value.';
                            errorList
                                .show()
                                .append(message + '. ');
                        });
                                            
                    }, 50);
                };

                $('input[type=submit], button', form).on('click', showAllErrorMessages);
                $('input[type=text]', form).on('keypress', function(event) {
                    //keyCode 13 is Enter
                 
                        if (event.keyCode == 13) {
                            showAllErrorMessages();
                        } 
                    
 
                });
            };

        $('form').each(createAllErrors);
        });
        
        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
            //document.getElementById("fname").focus();
          };
        })(), true);

    </script>
</body>

</html>
