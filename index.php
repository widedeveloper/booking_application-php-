<?php

	session_start();
	// var_dump($_SESSION);exit;
	if ( !isset($_SESSION['user_access_token']) ) {		
        header("Location: /booking/myaccount.php");
	}

    // Get user info
	include_once('app/customer_request.php');
	
	//Get Treatments
	include_once('app/treatment_request.php');


	
?>

<!DOCTYPE html>
<html lang="en-US" class="no-js no-svg">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Book your Experience</title>
	<link type="text/css" rel="stylesheet" href="assets/css/booker.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/custom.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap-datepicker/bootstrap-datepicker3.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/components-md.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="assets/css/responsive.css" />
	
	<link type="text/css" rel="stylesheet" href="assets/jquery-ui/jquery-ui.min.css" />
	<link rel="stylesheet" href="https://use.typekit.net/gub8scf.css">
</head>

<body id="BookAppointment">

	<div id="BookingSec" class="col-md-12">

		<div class="container TopMenu">
			<ul>			
					<li>
						<a href="#" id="appointments">Appointments</a>
					</li>	
					<li>
						<a href="#" id="myaccount">My Account</a>
					</li>	
					<li>
						<a href="#" id="logout" actionUrl="Logout">Log Out</a>
					</li>
			
			</ul>

		</div>

		<div class="container">

			<div class="col-md-9 col-sm-9 col-xs-9" id="LeftSec">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 HeaderBar">
						<div class="row">
							<h4 class="col-md-7 col-sm-7 col-md-12 tk-garamond-premier-pro-display"><a href="/booking/index.php" class="bookindex">
							Book your Experience</a></h4>
							<div class="StepNav col-md-5 col-sm-5 col-md-12 pull-right">
								<div class="row">

									<div class="col-md-4 col-sm-5 col-md-12 step step-1 CurrentStep">Step One</div>
									<div class="col-md-4 col-sm-5 col-md-12 step step-2">Step Two</div>
									<div class="col-md-4 col-sm-5 col-md-12 step step-3">Step Three</div>

								</div>
							</div>


						</div>
					</div>
					<!--HeaderBar-->

					<div class="form-row" id="FirstRow">
						<form id="firstRowForm" >
							<input type="hidden" name="type" value="FindTreatments" />
							<div class="CustomerDetails" >
								<div class="row">

									<div class="col-md-12 ">
										<div class="col-md-4 FieldBlock">
											<!-- <div class="row"> -->
												<h5>How many guests?</h5>

												<div class="selectric-wrapper">
													
													<div class="form-group form-md-line-input form-md-floating-label selectric">
														<select class="form-control edited guests" name="guesttype" id="guesttype" required>
														
															<option value="1">Just Me</option>
															<option value="2">Me and a guest</option>
															<option value="3">Me and two guests</option>
														</select>													
													</div>												
												</div>
											<!-- </div> -->
										</div>
										<!--end how many-->
										<div class="col-md-4 FieldBlock">
											<!-- <div class="row"> -->
												<h5>When?</h5>
												<div class="selectric-wrapper">
													<div class="form-group  form-md-floating-label selectric">											
															<p class="SelectLabel sel_date"><?php echo date("D, d M Y") ?></p>												
													</div>		
													<div class="selectric-items date-picker" tabindex="-1">
														<div class="selectric-scroll">
															<div id="datepicker" class="date-picker datepickerDiv"  data-date-format="mm/dd/yyyy" data-date-start-date="+0d"> </div>
															<input type="hidden" id="datepicker_send" name="datepicker_send" required>
															<input type="hidden" id="datepicker_send5" name="datepicker_send5" required>
														</div>
													</div>
												</div>
											<!-- </div> -->
										</div>

									</div>
								</div>
										<!--end When-->
								<div class="row guestRow1 deactive">
									<div class="col-md-12 ">
										<div class="col-md-4 FieldBlock guesttemp1">											
												<h5>My Guest FirstName</h5>
												<div class="selectric-wrapper">
													<input type="text" id="guestfirstname1" placeholder="Enter guest's firstname" name="guestfirstname1" disabled="" required/>
												</div>
										</div>
										<div class="col-md-4 FieldBlock guesttemp1">											
												<h5>My Guest LastName</h5>
												<div class="selectric-wrapper">
													<input type="text" id="guestlastname1" placeholder="Enter guest's lastname" name="guestlastname1" disabled="" required/>
												</div>
										</div>
										<div class="col-md-4 FieldBlock guesttemp1">
												<h5>Guest Email (Optional)</h5>
												<div class="selectric-wrapper">
													<input type="email" id="guestemail1" placeholder="Enter guest's email" name="guestemail1" disabled="" />
												</div>
										</div>
										<div style="clear: all;"></div>
									</div>
								</div>
								<div class="row guestRow2 deactive">
									<div class="col-md-12 ">
										<div class="col-md-4 FieldBlock guesttemp2">
												<h5>My Guest FirstName 2</h5>
												<div class="selectric-wrapper">
													<input type="text" id="guestfirstname2" placeholder="Enter guest's firstname" name="guestfirstname2" disabled="" required/>
												</div>
										</div>
										<div class="col-md-4 FieldBlock guesttemp2">
												<h5>My Guest LastName 2</h5>
												<div class="selectric-wrapper">
													<input type="text" id="guestlastname2" placeholder="Enter guest's lastname" name="guestlastname2" disabled="" required/>
												</div>
										</div>
										<div class="col-md-4 FieldBlock guesttemp2">
												<h5>Guest Email 2 (Optional)</h5>
												<div class="selectric-wrapper">
													<input type="email" id="guestemail2" placeholder="Enter guest's email" name="guestemail2" disabled=""/>
												</div>
										</div>
									</div>
								</div>
							</div>
						</form>
						<!--CustomerDetails-->
						<div class="col-md-12 actions_wrapper ">
							<div class="row">

								<div class="col-md-6 col-sm-6 col-xs-12"></div>

								<div class="col-md-6 col-sm-6 col-xs-12 text-right">
									<div class="row">
										<a class="button next-step" href="#next-step">Next Step</a>
									</div>
								</div>

							</div>
						</div>
						<!--actions_wrapper-->
					</div>
					<!--FirstRow form_row-->


					<div class="form-row" id="SecondRow" style="display:none;">
					
						<form id="secondRowForm" >
							<!-- //////////////////////////// -->
							<input type="hidden" name="type" value="GetTreatmentCategories" />
							<div class="col-md-12 col-sm-12 col-xs-12 CustomerDetails">
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-12 FieldBlock">
										<div class="row">
											<h5 id="chosen-guest-type">Me plus a Guest</h5>

											<div class="SelectedGuests">
												<ul>
													<li class="me"><?php echo $_SESSION['customerData']['FirstName']." ". $_SESSION['customerData']['LastName'] ?></li>
													<li class="guestname1 guestRow1 deactive">Guest:
														<span></span>
													</li>
													<li class="guestname2 guestRow2 deactive">Guest:
														<span>Anita Patrickson1</span>
													</li>
												</ul>
											</div>

										</div>
									</div>
									<!--end how many-->
									<div class="col-md-4 col-sm-4 col-xs-12 FieldBlock">
										<div class="row">
											<h5>When?</h5>
											<div class="selectric-wrapper">
												<div class="form-group  form-md-floating-label selectric">											
														<p class="SelectLabel sel_date">Today</p>												
												</div>		
												<div class="selectric-items date-picker" tabindex="-1">
													<div class="selectric-scroll">
														<div id="datepicker2" class="date-picker datepickerDiv" data-date-format="mm/dd/yyyy" data-date-start-date="+0d"> </div>
														<input type="hidden" id="datepicker_send2" name="datepicker_send" requried>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end When-->
									<div class="col-md-4 col-sm-4 col-xs-12 FieldBlock">
										<div class="row">
											<h5>For?</h5>
											<div class="selectric-wrapper">
												<!-- <input type="text" id="secondstep_for" placeholder="Custom Sandal - 2 Guests" name="secondstep_for" requried/> -->

												<div class="form-group form-md-line-input form-md-floating-label">
													<?php /*<select class="form-control edited treatments" name="treatments" id="treatments" required>
														<option value="" >Select Service...</option>	
														<?php foreach($_SESSION['treatments'] as $treat) {?>
															
															<optgroup label="<?php echo $treat['Category']['Name']?>">
															<?php foreach($treat['subCategory'] as $service) { ?>

																<option value="<?php echo $service['treatmentId'].",".$service['subcategoryId'].",".$treat['Category']['ID'] ?>" data-treatment-id="<?php echo $service['treatmentId'];?>" data-subcategory-id="<?php echo $service['subcategoryId'];?>" data-category-id="<?php echo $treat['Category']['ID'] ?>"
																	
																>
																	<?php echo $service['name']?>
																</option>		
														
															<?php }?>										
														</optgroup>
														<?php } ?>
													</select>*/ ?>
                                                    <p style="font-size: 17px; margin: 0;">
														<?php 
                                                            $count = 0;
                                                            foreach($_SESSION['treatments'] as $treat) {
                                                        
                                                                foreach($treat['subCategory'] as $service) { ?>

																<input type="hidden" name="treatments" id="treatments" value="<?php echo $service['treatmentId'].",".$service['subcategoryId'].",".$treat['Category']['ID'] ?>" data-treatment-id="<?php echo $service['treatmentId'];?>" data-subcategory-id="<?php echo $service['subcategoryId'];?>" data-category-id="<?php echo $treat['Category']['ID'] ?>">
                                                                <?php 
                                                                    
                                                                    echo $service['name'];
                                                                    
                                                                    $count++;
                                                                    if ( $count == 1 ) {
                                                                        break;
                                                                    }
														
															 }
                                                    
                                                                if ( $count == 1 ) {
                                                                        break;
                                                                }
                                                         } ?>	
                                                    </p>
												</div>
											</div>
										</div>
									</div>
									<!--end guest name-->
								</div>
							</div>
							<!--CustomerDetails-->
							<div class="col-md-12 col-sm-12 col-xs-12 SecondaryDatePicker">
								<ul>
									<li>
										<a href="#date" class="prev-date">
											<span class="big " formatDate="">Tue. March 20, 2018</span>
										</a>
									</li>
									<li>
										<a href="#date" class="current-date ActiveDate">
											<span class="big " formatDate="">Tue. March 20, 2018</span>
										</a>
									</li>
									<li>
										<a href="#date" class="next-date ">
											<span class="big" formatDate="">Tue. March 20, 2018</span>
										</a>
									</li>
								</ul>
							</div>
							<!--SecondaryDatePicker-->
							<div class="col-md-12 col-sm-12 col-xs-12 timeslots">

								<div class="col-md-12 col-sm-12 col-xs-12 TimeslotsHeader">
									<div class="row">
										<div class="col-md-2 t_header text-left">Start</div>
										<div class="col-md-2 t_header text-left">End</div>
										<div class="col-md-5 t_header text-left for">For</div>
										<div class="col-md-3 t_header"></div>
									</div>
								</div>
								<!--TimeslotsHeader-->

								<div class="col-md-12 col-sm-12 col-xs-12 TimeslotsInfo">
									<!-- <div class="row">
										<div class="col-md-3 t_row text-left">
											<p>9.00am</p>
										</div>
										<div class="col-md-3 t_row text-left">
											<p>9.30 am</p>
										</div>
										<div class="col-md-4 t_row for text-left">
											<p>Custom Sandal - 2 Guests</p>
										</div>
										<div class="col-md-2 t_row">
											<a class="select button" href="#select">
												<span class="off">Select</span>
											</a>
										</div>
									</div> -->
								</div>
								<!--TimeslotsInfo-->
                                <input type="hidden" id="SelectedTimeSlot" name="timeslot" value="">
                                <input type="hidden" id="incomplete_appointment_id" name="incomplete_appointment_id" value="">

							</div>
							<!--timeslots-->
							<div class="col-md-12 actions_wrapper">
								<div class="row">

									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="row">
											<a class="button prev-step" href="#prev-step">Prev Step</a>
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 text-right">
										<div class="row">
											<a class="button next-step" href="#next-step">Next Step</a>
										</div>
									</div>

								</div>
							</div>
						<!--actions_wrapper-->
						</form>
					</div>
					<!--SecondRow form_row-->


					<div class="form-row" id="ThirdRow" style="display:none;">
						<form id="thirdRowForm" >
							<div class="col-md-12 col-sm-12 col-xs-12 CustomerDetails">
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12 FieldBlock">
										<div class="row">
											<h5>My Information</h5>
											<div class="MyInfo">
												<p><?php echo $_SESSION['customerData']['FirstName']." ". $_SESSION['customerData']['LastName'] ?>
													<br /> <?php echo $_SESSION['customerData']['Email']?>
													<br />  <?php echo $_SESSION['customerData']['CellPhone']?>
												</p>
											</div>
											<!--MyInfo-->

										</div>
									</div>
									<!--end-->
									<div class="col-md-6 col-sm-6 col-xs-12 FieldBlock CreditCardDetails">
										<div class="row">
											<h5>Credit Card Information</h5>
											<div class="selectric-wrapper width_lg pull-right">

												<div class="form-group form-md-line-input form-md-floating-label selectric">
													<select class="form-control  creditCard" name="cardSel" id="cardSel" required>
														<?php if ( !empty($_SESSION['customerData']['CustomerCreditCards']) ) { ?>
                                                        <option value="">No Card Selected</option><?php } else { ?>
														<option value="">No Cards Available</option> <?php } ?>
														<?php foreach($_SESSION['customerData']['CustomerCreditCards'] as $key=> $card){?>		
															<option selected value="<?php echo $key?>">
																<?php echo $card['CreditCard']['Number']?>
															</option>
														<?php }?>
													</select>													
												</div>	

											</div>
                                            <div id="add-new-credit-card"><a href="#" class="add-new-credit-card">ADD A NEW CARD</a></div>
										</div>
									</div>
									<!--end Credit Card info-->
								</div>
							</div>
							<!--CustomerDetails-->
							<div class="col-md-12 col-sm-12 col-xs-12 FieldBlock " >
								<div class="row NewCreditCardDetails" style="display: none;">
									<h5>Add a New Credit Card</h5>
									<p class="CardInfoLine">Your payment information is only used to hold your reservation</p>

									<div class="col-md-6 FieldBlock width45">
										<div class="row">
											<h5>Name on Card</h5>
											<div class="selectric-wrapper width_lg">
												<input type="text" id="name_on_card" placeholder="Name on Card" name="name_on_card" />
											</div>
										</div>
									</div>

									<div class="col-md-6 FieldBlock width45 pull-right">
										<div class="row">
											<h5>Card Number <span id="card_type_flag"></span></h5>
											<input type="hidden" name="cc_type" id="cc_type" value="un-recognized" />
											<input type="hidden" name="cc_type_id" id="cc_type_id" value="" />
											<div class="selectric-wrapper width_lg pull-right">
												<input type="number" id="card_number" maxlength="16" placeholder="Card Number" name="card_number" />
											</div>
										</div>
									</div>

									<div class="col-md-3 MarginRight FieldBlock">
										<div class="row">
											<h5>Expiration Date</h5>
											<div class="selectric-wrapper">
												<input type="text" id="exp_date" placeholder="mm/yyyy" name="exp_date" />
											</div>
											
										</div>
									</div>
									<!--Expiration Code-->

									<div class="col-md-3 MarginRight FieldBlock">
										<div class="row">
											<h5>Security Code</h5>
											<div class="selectric-wrapper">
												<input type="number" id="security_code" placeholder="Security Code" name="security_code" />
											</div>
										</div>
									</div>
									<!--Security Code-->

									<div class="col-md-3 MarginRight FieldBlock last">
										<div class="row">
											<h5>Postal Code</h5>
											<div class="selectric-wrapper last">
												<input type="text" id="postal_code" placeholder="Postal Code" name="postal_code" />
											</div>
										</div>
									</div>
									<!--Postal Code-->

								</div>
								<div>
									<div class="col-md-12 col-sm-12 col-xs-12 checkboxes">
										<div class="row">
											<input name="acccept_cancellation" type="checkbox" value="acccept_calcellation" id="cancellation" />
											<label for="cancellation">I accept the cancellation policy // Should you need to cancel your Amanu experience, please do so online by 8pm the night before your appointment to avoid being charged $25.</label>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 checkboxes">
										<div class="row">
											<input name="acccept_late_policy" type="checkbox" value="acccept_late_policy" id="late_policy" />
											<label for="late_policy">I accept the late policy // Because of our scheduling, we can&#39;t guarantee that you’ll be able to still have a sitting with a maker if you’re more than 15 minutes late, but we’ll try our best to make it work. You may have to get initial sizing and then wait until the next scheduled appointment finishes (approx.30 min) for your final fitting.</label>
										</div>
									</div>

									<!-- <div class="col-md-12 col-sm-12 col-xs-12 checkboxes">
										<div class="row">
											<input name="default_acccept" type="checkbox" value="default_acccept" id="default_acccept" />
											<label for="default_acccept">I accept that my booked service accurately reflects my manicure needs, i.e. I booked a gel removal if I need one.</label>
										</div>
									</div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12 checkboxes">
                                        <div class="row">
											<div class="payment-errors"></div>
											<div class="card-errors"></div>
										</div>
                                    </div>

								</div>
							</div>
							<!--NewCreditCardDetails-->
							<div class="col-md-12 actions_wrapper">
								<div class="row">

									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="row">
											<a class="button prev-step" href="#prev-step">Prev Step</a>
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-12 text-right">
										<div class="row">
                                            <input type="hidden" name="multi" id="multi" value="">
                                            <input type="hidden" name="customer_id" id="customer_id" value="">
                                            <input type="hidden" name="customer_name" id="customer_name" value="">
                                            <input type="hidden" name="customer_email" id="customer_email" value="">
                                            <input type="hidden" name="customer_birthday" id="customer_birthday" value="">
                                            <input type="hidden" name="timeslot" id="timeslot" value="">
                                            
											<a class="button next-step book-appointment" href="#next-step">Book Appointment</a>
										</div>
									</div>

								</div>
							</div>
						<!--actions_wrapper-->
						</form>
					</div>
					<!--ThirdRow form_row-->
                    <div class="form-row" id="FourthRow" style="display:none;">
                        <div class="col-md-12 col-sm-12 col-xs-12 CustomerDetails">
                            <div class="row">
                                <h4>We have scheduled your appointment.</h4>
								<!-- <p><?php //echo $_SESSION['customerData']['FirstName'];?> <?php //echo $_SESSION['customerData']['LastName'];?></p> -->
								<ul>
									<li class="me"><?php echo $_SESSION['customerData']['FirstName']." ". $_SESSION['customerData']['LastName'] ?></li>
									<li class="guestname1 guestRow1 deactive">Guest:
										<span></span>
									</li>
									<li class="guestname2 guestRow2 deactive">Guest:
										<span>Anita Patrickson1</span>
									</li>
								</ul>
                                <p>We will contact you at <?php echo $_SESSION['customerData']['Email'];?></p>
                                <p></p>
                                <p></p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<!--LeftSec-->
			<div class="col-md-3 col-sm-3 col-xs-12 pull-right" id="RightSec">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 HeaderBar">
						<div class="row">
							<h4 class=" tk-garamond-premier-pro-display">Details</h4>
						</div>
					</div>

					<p>Your appointment window will be 30 minutes. Depending on the style you choose, the actual sandal-making will only take 10-25 minutes. Please come at least 15 minutes early, so that you have sufficient time to browse all the silhouettes, materials and color ways—and choose the sandal (or sandals!) you want to leave with.</p>
					<p>If you decide on more than one sandal, our maker will take initial sizing and strap placement measurements, and then have you come back later for the final fitting. We’ll work around your schedule and text you when we’re ready to finalize them perfectly to your feet. Appointments are by no means required, but they do ensure that a maker will be ready for you when you arrive.</p>
					<p>If you’re looking to book multiple guests, but can’t find a window that works, send us a note at hello@amanustudio.com and we’ll see what can do to accommodate all of you. </p>
					
					<p>Have any additional questions about the process, the <strong><a href="#" id="cancelPolicy">CANCELLATION POLICY</a></strong> or anything else? That same email works for that too!</p>
				</div>
			</div>
			<!--RightSec-->

		</div>
	</div>
	<input type="hidden" name="expire_time" id = "expire_time" value="<?php echo $_SESSION['timestamp']?>" />
	<script type="text/javascript" src="assets/js/jquery-3.2.0.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/jquery.inputmask.bundle.min.js"></script>	
	<script type="text/javascript" src="assets/js/form-input-mask.js"></script>	
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
	<script type="text/javascript" src="assets/jquery-ui/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="assets/js/step.js"></script>
	<script type="text/javascript" src="assets/js/booker.js"></script>
	<script type="text/javascript" src="assets/js/modal.js"></script>

	<?php include('appointments.php');?>
    <?php include('my-account-modal.php');?>
    <?php include('cancel-policy.php');?>
    <?php include('faq.php');?>
	
	<script>
		$(document).ready(function () {
		
			// Check access token expiration
			setInterval(function(){				
				var expire_time = $("#expire_time").val();
				if(Date.now() > expire_time) {
					window.location.href = "<?php echo _APPLICATION_FOLDER; ?>/myaccount.php";
				}				
			},1000)


			$(".selectric").click(function () {
				$(".selectric-wrapper").removeClass('selectric-open');
				$(this).parent(".selectric-wrapper").toggleClass('selectric-open');
			});

			// check credit card available
			if($("#cardSel").val()==""){
				$(".NewCreditCardDetails").css("display","block");
				$("#cardSel option:eq(0)").prop("selected", true);
			}
			
			//--------------datepicker-------------//
			$("#datepicker").datepicker({
				changeMonth:true,
				minDate: new Date(),
			    onSelect: function(value,dd,inst){
					$(this).trigger('close');
					$("#datepicker2").datepicker("setDate",value);
					$("#datepicker_send").val(value);
					$("#datepicker_send2").val(value);
					$(".selectric-open").removeClass('selectric-open');
					_avalableDateChange(value);	
				}		
			});

			$("#datepicker2").datepicker({
				changeMonth:true,
				minDate: new Date(),
				onSelect: function(value){
					$(this).trigger('close');
					$("#datepicker").datepicker("setDate",value);
					$("#datepicker_send").val(value);
					$("#datepicker_send2").val(value);
					$(".selectric-open").removeClass('selectric-open');					
					_avalableDateChange(value);
					if($("#treatments").val()!=""){
						_getAvailableDates($("#treatments").val(), $("#multi").val());
					}	
				}		

			});			
			//--------------datepicker end-------------//	


			//logout
            $("#logout").click(function( event ) {
                
				$.ajax({
				  method: "POST",
				  url: "app/ajax_requests.php",
				  data: { type: 'logout'}
				})
				.fail(function( msg ) {
					console.log(msg)    
				})
				.done(function( msg ) {
					var json = $.parseJSON(msg);
					if (json.IsSuccess == true) {
						window.location.href = '/booking/myaccount.php';
					}
				   
				});  
		   	});

			//    add new credit card
			$(".add-new-credit-card").click(function(){
				$(".NewCreditCardDetails").css("display","block");
                $("#cardSel option:eq(0)").prop("selected", true);
			});

		});
	</script>
   
</body>

</html>