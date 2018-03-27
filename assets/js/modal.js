$(document).ready(function () {

    //Appointments modal
    $("#appointments").click(function () {

        $("#appointmentsModal").modal();
        $("#appointmentsBody .msg").text('');
        $("#appointmentsBody .msg").css('display', 'none');
        $("#AppointmentTable").children().remove();

        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    type: "GetCustomerAppointments"
                }
            })
            .fail(function (msg) {
                console.log(msg)
            })
            .done(function (msg) {
                var json = $.parseJSON(msg);

                if (json.IsSuccess) {
                    var appointments = json.Appointments;

                    if (appointments.length == 0) {
                        $("#AppointmentTable").append($('<div class="js-appointments">No previous appointments exist.</div>'));
                    } else {
                        //foreach
                        var total_result = json.TotalResults;
                        // console.log("appointments--", appointments)
                        var booksTable = '';
                        for (var i = 0; i < appointments.length; i++) {
                            var bookingNumber = appointments[i].bookinigNumber;
                            var startDateTime = appointments[i].StartDateTime;
                            var Status = appointments[i].Status;
                            var OrderID = appointments[i].OrderID;
                            var ID = (appointments[i].GroupAppointmentID != null) ? appointments[i].GroupAppointmentID : appointments[i].ID;
                            var AppointmentPayment = appointments[i].AppointmentPayment;
                            var AppointmentTreatments = appointments[i].AppointmentTreatments;
                            var Customer = appointments[i].Customer;
                            var Treatment = appointments[i].Treatment;
                            var momentDate = moment(startDateTime).zone('-0400').format("MM-DD-YY HH:mm");
                            var dateTime = momentDate.toLocaleString('en-US', {
                                timeZone: 'US/Eastern'
                            });

                            if (Status.ID == 2) {
                                var buttonTitle = "Cancel";
                            } else {
                                var buttonTitle = Status.Name;
                            }
                            switch (AppointmentTreatments.length) {
                                case 1:
                                    var Guest = "Just Me";
                                    break;
                                case 2:
                                    var Guest = "Me and a guest";
                                    break;
                                case 3:
                                    var Guest = "Me and two guests";
                                    break;
                                default:
                                    break;
                            }

                            var button = (Status.ID != 2) ? '<p><center>' + buttonTitle + '</center></p>' :
                                '<a class="button cancelbook"  data-appointmentid="' + ID + '" onclick="cancelbook(this)">' + buttonTitle + '</a>';

                            booksTable += '<div class="row" id="viewAppointmests">' +
                                '<div class="col-md-3 text-left"><p>' + Guest + '</p></div>' +
                                '<div class="col-md-3 text-left"><p>Custom Sandal</p></div>' +
                                '<div class="col-md-2 text-left"><p>' + dateTime.split(" ")[0] + '</p></div>' +
                                '<div class="col-md-2 text-left"><p>' + dateTime.split(" ")[1] + '</p></div>' +
                                '<div class="col-md-2 text-left"><p class="cancelaction">' + button +
                                '</p>' +
                                '</div>' +
                                '</div>';
                        }

                        $("#AppointmentTable").append($(booksTable));
                    }
                } else {
                    $("#AppointmentTable").append($('<div class="js-appointments">No previous appointments exist.</div>'));
                }
            });

    });


    // myaccount modal
    $("#myaccount").click(function () {

        $("#myaccountModal").modal();
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    type: "GetCustomer"
                }
            })
            .fail(function (msg) {
                //console.log(msg)    
            })
            .done(function (msg) {
                //console.log(msg);
                var json = $.parseJSON(msg);
                if (json.IsSuccess) {

                    var birthdate = json.Customer.Customer.DateOfBirth;
                    var momentDate = moment(birthdate).zone('-0400').format("MM/DD/YYYY");
                    var birthday = momentDate.toLocaleString('en-US', {
                        timeZone: 'US/Eastern'
                    });

                    $("#myaccountModal .first-name").val(json.Customer.Customer.FirstName);
                    $("#myaccountModal .last-name").val(json.Customer.Customer.LastName);
                    $("#myaccountModal .phone").val(json.Customer.Customer.CellPhone);
                    $("#myaccountModal #birthday").val(birthday);
                    var newDate = splitDate(birthday);
                    var selstringDate = getstringDate(newDate);
                    $('#myaccountModal .sel_bddate').html(selstringDate);
                }
            });
    });

    //Update Account 
    $("#update-account").click(function (event) {
        event.preventDefault();

        $("#updateprofile .errors").children().remove();
        $("#updateprofile .success").children().remove();

        var flag = 0;
        var pass1 = $("#updateprofile .password").val();
        var pass2 = $("#updateprofile .confirm-password").val();
        if (pass1 != "" && pass1 != pass2) {
            $("#updateprofile .errors").append($("<div>Passwords don't match.</div>"));
            return false;
        }

        if (_isValidStepOne('updateprofile') == true) {

            $.ajax({
                    method: "POST",
                    url: "app/ajax_requests.php",
                    data: $("#updateprofile").serialize()
                })
                .fail(function (msg) {
                    //console.log(msg)    
                })
                .done(function (msg) {

                    var json = JSON.parse(msg);
                    if (json.IsSuccess) {
                        if (pass1 != "" && pass1 == pass2) {
                            $.ajax({
                                    method: "POST",
                                    url: "app/ajax_requests.php",
                                    data: {
                                        'type': 'UpdateProfile',
                                        'password': pass1
                                    }
                                })
                                .fail(function (msg) {
                                    //console.log(msg)    
                                })
                                .done(function (msg) {

                                    var result = JSON.parse(msg);
                                    if (result.IsSuccess) {

                                    } else {
                                        var errorMsgs = '';
                                        for (var i = 0; i < result.ArgumentErrors.length; i++) {
                                            errorMsgs += '<div>' + result.ArgumentErrors[i].ErrorMessage + '</div>';
                                        }
                                        $("#updateprofile .errors").append($(errorMsgs));
                                    }
                                })
                        }
                        $("#updateprofile .success").append($("<span>Account Updated</span>"));

                    } else {
                        var errorMsgs = '';
                        for (var i = 0; i < json.ArgumentErrors.length; i++) {
                            errorMsgs += '<div>' + json.ArgumentErrors[i].ErrorMessage + '</div>';
                        }
                        $("#updateprofile .errors").append($(errorMsgs));
                    }
                })
        } else {

        }
    });

    //cancel policy modal
    $("#cancelPolicy").click(function (event) {
        $("#cancelpolicyModal").modal();
        $(".cancel-policy-caption").children().remove();
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    type: "GetLocationCancellationPolicy"
                }
            })
            .fail(function (msg) {
                //console.log(msg)    
            })
            .done(function (msg) {
                var json = $.parseJSON(msg);
                if (json.IsSuccess) {
                    var content = json.CancellationPolicy.CancellationPolicyText;
                    var content = content.split("\n");
                    var html = '<span>';
                    for (var i = 0; i < content.length; i++) {
                        html += content[i] + '<br>';
                    }
                    html += '</span>';
                    $(".cancel-policy-caption").append($(html));
                }
            });
    });

    //FAQ modal
    $("#faq").click(function () {
        $("#faqModal").modal();
    });
});