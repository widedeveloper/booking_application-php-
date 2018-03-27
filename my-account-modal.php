<div id="myaccountModal" class="modal container fade" data-backdrop="static" tabindex="-1" style="background: white none repeat scroll 0% 0%;
    margin: 70px auto; max-width: 700px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title tk-garamond-premier-pro-display">Update Account</h4>
    </div>
    <div class="modal-body container-fluid past-appointments" id="myaccountBody">

        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="" id="updateprofile">
                        <input type="hidden" name="type" value="UpdateCustomer">
                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>* First Name</h5>
                                    <input name="firstName" class="first-name" type="text" placeholder="First Name" required="" style="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>* Last Name</h5>
                                    <input name="lastName" class="last-name" type="text" placeholder="Last Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Phone</h5>
                                    <input name="phone" class="phone" type="tel" placeholder="Phone" minlength="10" maxlength="10" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">                              
                                <div class="selectric-wrapper">
                                    <h5>Birthday</h5>
                                    <input name="birthday" type="text" placeholder="mm/dd/yyyy" id="birthday" required="" />
                                </div>                                
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Password</h5>
                                    <input name="profilepassword" class="password" type="password" placeholder="Password" style="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 FieldBlock">
                            <div class="row">
                                <div class="selectric-wrapper">
                                    <h5>Confirm Password</h5>
                                    <input name="profileconfirmpassword" class="confirm-password" type="password" placeholder="Confirm Password" style="">
                                </div>
                            </div>
                        </div>
                        <div class="errors"></div>
                        <div class="success"></div>
                        <input name="submit" type="submit" value="Update" class="button col-md-12 col-sm-12 col-xs-12" id="update-account">
                    </form>
            </div>
        </div>
    </div>
</div>
