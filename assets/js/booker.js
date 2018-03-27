$(function () {

    var todaydate = new Date();
    _avalableDateChange(todaydate.toLocaleDateString("en-us"));
    $("#datepicker_send").val(todaydate.toLocaleDateString("en-us"));
    $("#datepicker_send2").val(todaydate.toLocaleDateString("en-us"));

    $(".FieldBlock.guesttemp1").css('visibility', 'hidden');
    $(".FieldBlock.guesttemp2").css('visibility', 'hidden');


    //getCreditCardTypes
    // _getCreditCardTypes();  

    $("select.guests").change(function () {

        var guestsId = $(this).val()

        switch (guestsId) {
            case '1':
                $(".FieldBlock.guesttemp1").css('visibility', 'hidden');
                $(".FieldBlock.guesttemp2").css('visibility', 'hidden');

                $(".guestRow1").removeClass("deactive").addClass("deactive");
                $(".guestRow2").removeClass("deactive").addClass("deactive");

                var disable_arr = ["guestfirstname1", "guestlastname1", "guestemail1", "guestfirstname2", "guestlastname2", "guestemail2"]
                element_showable(disable_arr, "disabled");

                var enable_arr = [];
                element_showable(enable_arr, "enabled");

                var visible_arr = []
                element_showable(visible_arr, "visible");

                var invisible_arr = ["guestname1", "guestname2"];
                element_showable(invisible_arr, "hidden");

                $("#multi").val('0');
                break;
            case '2':

                $(".FieldBlock.guesttemp1").css('visibility', 'visible');
                $(".FieldBlock.guesttemp2").css('visibility', 'hidden');

                $(".guestRow1").removeClass("deactive");
                $(".guestRow2").removeClass("deactive").addClass("deactive");

                var disable_arr = ["guestfirstname2", "guestlastname2", "guestemail2"]
                element_showable(disable_arr, "disabled");

                var enable_arr = ["guestfirstname1", "guestlastname1", "guestemail1"];
                element_showable(enable_arr, "enabled");

                var visible_arr = ["guestname1"]
                element_showable(visible_arr, "visible");

                var invisible_arr = ["guestname2"];
                element_showable(invisible_arr, "hidden");

                $("#multi").val('1');
                break;
            case '3':

                $(".FieldBlock.guesttemp1").css('visibility', 'visible');
                $(".FieldBlock.guesttemp2").css('visibility', 'visible');

                $(".guestRow1").removeClass("deactive");
                $(".guestRow2").removeClass("deactive");

                var disable_arr = []
                element_showable(disable_arr, "disabled");

                var enable_arr = ["guestfirstname1", "guestlastname1", "guestemail1", "guestfirstname2", "guestlastname2", "guestemail2"];
                element_showable(enable_arr, "enabled");

                var visible_arr = ["guestname1", "guestname2"]
                element_showable(visible_arr, "visible");

                var invisible_arr = [];
                element_showable(invisible_arr, "hidden");

                $("#multi").val('2');
                break;
            default:
                break;
        }

    });

    // User selects the time slot
    $(".timeslots").on('click', '.select.timeslot-button', function () {
        console.log("timeslot selected")
        $(".timeslots").each(function () {
            $('.button').find('span').text("Select");
            $('.button').removeClass('on').addClass('off');
            $('.button').removeClass('selected').addClass('select');
        });
        $(this).find('span').text("Continue");
        $(this).removeClass('off').addClass('on');
        $(this).removeClass('select').addClass('selected');

        var timeslot = $(this).data("timeslot");
        var serviceID = $(this).data("serviceid");
        var duration = $(this).data("duration");
        var price = $(this).data("price");
        var categoryId = $(this).data("categoryid");

        $("#timeslot").val(timeslot);

        console.log("ca", categoryId);

        $("#SelectedTimeSlot").val(timeslot);


    });

    $(".timeslots").on('click', '.selected.button.timeslot-button.on', function () {

        $("#SecondRow .next-step").trigger("click");
    });

    $(".timeslots").on('click', '.selected.button.multi-timeslot-button.on', function () {
        $("#SecondRow .next-step").trigger("click");
    });

    // User selects the time slot
    $(".timeslots").on('click', '.multi-timeslot-button', function () {
        $(".timeslots").each(function () {
            $('.button').find('span').text("Select");
            $('.button').removeClass('on').addClass('off');
            $('.button').removeClass('selected').addClass('select');
        });
        $(this).find('span').text("Continue");
        $(this).removeClass('off').addClass('on');
        $(this).removeClass('select').addClass('selected');
        var timeslot = $(this).data("timeslot");
        var serviceID = $(this).data("serviceid");
        var duration = $(this).data("duration");
        var price = $(this).data("price");
        var categoryId = $(this).data("categoryid");

        $("#timeslot").val(timeslot);
        $("#SelectedTimeSlot").val(timeslot);

    });


    //when click available date
    $(".SecondaryDatePicker ul li a").each(function () {


        var self = $(this);
        self.click(function () {
            var multi = $("#multi").val();
            var today = todaydate.toLocaleDateString("en-us");
            today = splitDate(today)
            var selDate = $(this).find("span:first").attr('formatDate');
            formatDate = splitDate(selDate);

            if (formatDate.setDate(formatDate.getDate()) >= today.setDate(today.getDate())) {
                _avalableDateChange(selDate);

                if ($("#treatments").val() != "") {
                    _getAvailableDates($("#treatments").val(), multi);
                }

            } else {
                return false;
            }
        })
    })

    // select services
    $("#treatments").change(function () {
        var multi = $("#multi").val();
        var value = $(this).val();
        // console.log(serviceId,subcategoryId,categoryId)
        _getAvailableDates($(this).val(), multi);
    });

    // $(".next-step").click(function () {
    //     // Copy guest names
    //     $(".guestname1").find("span").text($("#guestfirstname1").val() + " " + $("#guestlastname1").val());
    //     $(".guestname2").find("span").text($("#guestfirstname2").val() + " " + $("#guestlastname2").val());
    //     $("#chosen-guest-type").text($("#guesttype option:selected").text());
    // });


})


// form validation each 3 forms
function _isValidStepOne(form) {

    var formObj = $("#" + form);
    formObj.validate()

    if (!formObj.valid()) {
        formObj.valid();
        return false;
    } else {
        return true;
    }
}

function splitDate(date) {
    var DateArr = date.split('/');
    var date = new Date(Date.UTC(parseInt(DateArr[2]), parseInt(DateArr[0]) - 1, parseInt(DateArr[1])));
    return date;
}

function getstringDate(date) {
    var date = date.toUTCString();
    return date.substring(0, 16)
}

function getformatDate(date) {

    return (date.getUTCMonth() + 1) + "/" + date.getUTCDate() + "/" + date.getUTCFullYear()
}
//select date 
function _avalableDateChange(selectedDate) {

    var newDate = splitDate(selectedDate);
    var options = {
        weekday: "short",
        year: "numeric",
        month: "long",
        day: "numeric"
    }
    var selstringDate = getstringDate(newDate);

    var prevDate = new Date(newDate.setDate(newDate.getDate() - 1));
    var nextDate = new Date(newDate.setDate(newDate.getDate() + 2));

    var nextstringDate = getstringDate(nextDate);
    var prevstringDate = getstringDate(prevDate);

    $(".sel_date").html(selstringDate);
    $("#datepicker_send").val(selectedDate);
    $("#datepicker_send2").val(selectedDate);
    $(".current-date span:first").html(selstringDate);
    $(".current-date span:first").attr("formatDate", selectedDate);
    $(".prev-date span:first").html(prevstringDate);
    $(".prev-date span:first").attr("formatDate", getformatDate(prevDate));
    $(".next-date span:first").html(nextstringDate);
    $(".next-date span:first").attr("formatDate", getformatDate(nextDate));

    //get available date and time real time
    // _getAvailableDates(selectedDate)
}

function _getAvailableDates(value, multi) {
    $("#timeslot").val('');
    $("#SelectedTimeSlot").val('');
    var type = 'AvailableDates';

    if (multi > 0) {
        type = 'MultiGuestDates';
    }

    // console.log(type);
    // console.log(multi);
    var serviceId = value.split(",")[0];
    var subcategoryId = value.split(",")[1];
    var categoryId = value.split(",")[2];
    var selectedDate = $("#datepicker_send2").val();
    // console.log(selectedDate);
    $.ajax({
            method: "POST",
            url: "app/ajax_requests.php",
            data: {
                'type': type,
                'fromdate': selectedDate,
                'serviceId': serviceId,
                'categoryId': categoryId,
                'subcategoryId': subcategoryId,
                'multi': multi
            }
        })
        .fail(function (msg) {
            console.log(msg)
        })
        .done(function (msg) {
            // console.log(msg);
            var data = JSON.parse(msg);
            if (data.length == 0) {
                return;
            } else {

                if (multi > 0) {
                    var availableDate = data.availability;
                    var serviceId = data.serviceId;
                } else {
                    var availableDate = data[0].serviceCategories[0].services[0].availability;
                    var serviceId = data[0].serviceCategories[0].services[0].serviceId;
                }

                _getAailability(serviceId, availableDate, multi)
            }
        });
}

function getAvailableTime(string) {

    var timestr = string.split('T')[1];
    return timestr.split("-")[0];
}

function _getAailability(serviceId, availableDate, multi) {

    if (typeof availableDate === 'undefined') {
        return;
    }
    var type = 'Availability1Day';

    if (multi > 0) {
        type = 'MultiGuest1Day';
        //get available date
        $(".TimeslotsInfo").children().remove();
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    'type': type,
                    'serviceId': serviceId,
                    'date': availableDate[availableDate.length - 1],
                    'multi': multi
                }
            })
            .fail(function (msg) {
                console.log(msg)
            })
            .done(function (msg) {
                // console.log(msg);
                var data = JSON.parse(msg);

                var multi = $("#multi").val();

                //var locationHours = data[0].locationHours;
                var services = data.availability;

                var TableHTML = '';
                for (var i = 0; i < services.length; i++) {
                    var startDatetime = getAvailableTime(services[i].startDateTime);
                    var endDatetime = getAvailableTime(services[i].endDateTime)
                    //var employees = services.availability[i].employees;

                    var itin =
                        'data-itin1="' + services[i].availabilityItems[0].serviceId + '"' +
                        'data-itin2="' + services[i].availabilityItems[1].serviceId + '"';

                    if (multi == 2) {
                        itin = itin + ' data-itin3="' + services[i].availabilityItems[2].serviceId + '"';
                    }

                    TableHTML += '<div class="row"><div class="Timeslotsbox">' +
                        '<div class="col-md-3 t_row text-left">' +
                        '<p>' + startDatetime + '</p>' +
                        '</div>' +
                        '<div class="col-md-3 t_row text-left">' +
                        '<p>' + endDatetime + '</p>' +
                        '</div>' +
                        '<div class="col-md-4 t_row for text-left">' +
                        '<p>Custom Sandal</p>' +
                        '</div></div>' +
                        '<div class="col-md-2 t_row">' +
                        '<a class="select button multi-timeslot-button" href="#select" ' +
                        'data-serviceid="' + services[i].serviceId + '"' +
                        'data-duration="' + services[i].duration + '"' +
                        'data-price="' + services[i].price + '"' +
                        itin +
                        'data-timeslot="' + services[i].startDateTime + '">' +
                        '<span class="">Select</span>' +
                        '</a>' +
                        '</div>' +
                        '</div>';

                }

                $(".TimeslotsInfo").append($(TableHTML));

            });
    } else {
        //get available date
        $(".TimeslotsInfo").children().remove();
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    'type': type,
                    'serviceId': serviceId,
                    'date': availableDate[availableDate.length - 1]
                }
            })
            .fail(function (msg) {
                console.log(msg)
            })
            .done(function (msg) {
                var data = JSON.parse(msg);

                //var locationHours = data[0].locationHours;
                var serviceCategories = data[0].serviceCategories;
                var startTimeInterval = data[0].startTimeInterval;

                var serviceData = serviceCategories[0];
                var services = serviceData.services[0];

                var TableHTML = '';
                for (var i = 0; i < services.availability.length; i++) {
                    var startDatetime = getAvailableTime(services.availability[i].startDateTime);
                    var endDatetime = getAvailableTime(services.availability[i].endDateTime)
                    var employees = services.availability[i].employees;
                    TableHTML += '<div class="row"><div class="Timeslotsbox">' +
                        '<div class="col-md-3 t_row text-left">' +
                        '<p>' + startDatetime + '</p>' +
                        '</div>' +
                        '<div class="col-md-3 t_row text-left">' +
                        '<p>' + endDatetime + '</p>' +
                        '</div>' +
                        '<div class="col-md-4 t_row for text-left">' +
                        //'<p>' + serviceData.serviceCategoryName + ' - ' + services.serviceName + '</p>' +
                        '<p>Custom Sandal</p>' +
                        '</div></div>' +
                        '<div class="col-md-2 t_row">' +
                        '<a class="select button timeslot-button" href="#select" ' +
                        'data-serviceid="' + services.serviceId + '"' +
                        'data-duration="' + services.duration + '"' +
                        'data-price="' + services.price + '"' +
                        'data-categoryid="' + serviceData.serviceCategoryId + '"' +
                        'data-timeslot="' + services.availability[i].startDateTime + '">' +
                        '<span class="">Select</span>' +
                        '</a>' +
                        '</div>' +
                        '</div>';

                }

                $(".TimeslotsInfo").append($(TableHTML));

            });
    }
}

function createAppointment(InComappointID) {
    $.ajax({
            method: "POST",
            url: "app/ajax_requests.php",
            data: {
                'type': 'CreateAppointment',
                'serviceId': serviceId,
                'date': $("#datepicker_send2").val()
            }
        })
        .fail(function (msg) {
            console.log(msg)
        })
        .done(function (msg) {
            var data = JSON.parse(msg);
        });
}

function process_order() {
    // Check / validate
    console.log('process order');

    // Check checkboxes
    var Cancellation = $("#cancellation").val();
    var LatePolicy = $("#late_policy").val();
    var DefaultAccept = $("#default_accept").val();

    // Get form data
    var IncompleteAppointmentID = $("#incomplete_appointment_id").val();
    var StartDateTime = $("#SelectedTimeSlot").val();
    var TreatmentId = $('#treatments').data('treatment-id');
    console.log(TreatmentId);


    // CC
    var CC_NameOnCard = $("#name_on_card").val();
    var CC_CardNumber = $("#card_number").val();
    var CC_ExpDate = $("#exp_date").val();
    var CC_SecurityCode = $("#security_code").val();
    var CC_PostalCode = $("#postal_code").val();
    var CC_Type = $("#cc_type").val();
    var CC_Type_ID = $("#cc_type_id").val();

    var creditCardType = $("#cardSel").val();

    // console.log("card", creditCardType);
    $.ajax({
            method: "POST",
            url: "app/ajax_requests.php",
            data: {
                'type': 'CreateAppointment',
                'NameOnCard': CC_NameOnCard,
                'CardNumber': CC_CardNumber,
                'CC_Type' :CC_Type,
                'CC_Type_ID' :CC_Type_ID,
                'ExpDate': CC_ExpDate,
                'SecurityCode': CC_SecurityCode,
                'PostalCode': CC_PostalCode,
                'StartDateTime': StartDateTime,
                'TreatmentId': TreatmentId,
                'IncompleteAppointmentID': IncompleteAppointmentID,
                'creditCardType': creditCardType
            }
        })
        .fail(function (msg) {
            console.log(msg)
        })
        .done(function (msg) {
            console.log('Appointment Created');
            // console.log(msg);
            var data = JSON.parse(msg);
            if (data.IsSuccess == true) {
                $("#ThirdRow").fadeOut(500);
                $("#FourthRow").fadeIn(800);
            }


        });
}

function book_itinerary() {
    // Check / validate
    // console.log('book itinerary');

    // Check checkboxes
    var Cancellation = $("#cancellation").val();
    var LatePolicy = $("#late_policy").val();
    var DefaultAccept = $("#default_accept").val();

    // Get form data
    var IncompleteAppointmentID = $("#incomplete_appointment_id").val();
    var StartDateTime = $("#SelectedTimeSlot").val();
    // var TreatmentId = $('.treatments').find(':selected').attr('data-treatment-id');
    var TreatmentId = $('#treatments').data('treatment-id');
    // console.log(TreatmentId);

    // Guests
    var multi = $("#multi").val();

    var name = $("#guestfirstname1").val() + "/" + $("#guestlastname1").val();
    var name2 = $("#guestfirstname2").val() + "/" + $("#guestlastname2").val();

    var guests = '';
    if (multi == 1) {
        guests = [name];
    } else {
        guests = [name, name2];
    }

    // CC
    var CC_NameOnCard = $("#name_on_card").val();
    var CC_CardNumber = $("#card_number").val();
    var CC_ExpDate = $("#exp_date").val();
    var CC_SecurityCode = $("#security_code").val();
    var CC_PostalCode = $("#postal_code").val();
    var CC_Type = $("#cc_type").val();
    var CC_Type_ID = $("#cc_type_id").val();

    var creditCardType = $("#cardSel").val();

    // console.log("card", creditCardType);
    $.ajax({
            method: "POST",
            url: "app/ajax_requests.php",
            data: {
                'type': 'CreateItinerary',
                'NameOnCard': CC_NameOnCard,
                'CardNumber': CC_CardNumber,
                'CC_Type':CC_Type,
                'CC_Type_ID' :CC_Type_ID,
                'ExpDate': CC_ExpDate,
                'SecurityCode': CC_SecurityCode,
                'PostalCode': CC_PostalCode,
                'StartDateTime': StartDateTime,
                'TreatmentId': TreatmentId,
                'creditCardType': creditCardType,
                'Multi': multi,
                'guests': guests
            }
        })
        .fail(function (msg) {
            console.log(msg)
            console.log('didnt work');
        })
        .done(function (msg) {
            // console.log('worked');

            var json = JSON.parse(msg);

            if (json.IsSuccess) {
                var groupId = json.ID;

            }
            $.ajax({
                    method: "POST",
                    url: "app/ajax_requests.php",
                    data: {
                        'type': 'BookItinerary',
                        'groupId': groupId
                    }
                })
                .fail(function (msg) {
                    console.log(msg)
                })
                .done(function (msg) {
                    console.log('Multi Guest Appointment Created');
                    var data = JSON.parse(msg);
                    if (data.IsSuccess == true) {
                        $("#ThirdRow").fadeOut(500);
                        $("#FourthRow").fadeIn(800);
                    }

                });

        });
}

//cancel appointments
function cancelbook(obj) {
    if (confirm("Are you sure you want to cancel this appointment?")) {
        $("#appointmentsBody .msg").text('');
        $("#appointmentsBody .msg").css('display', 'none');
        var Id = $(obj).data("appointmentid");
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",
                data: {
                    type: "CancelAppointment",
                    appointmentID: Id
                }
            })
            .fail(function (msg) {
                //console.log(msg)    
            })
            .done(function (msg) {
                //console.log(msg);
                var json = $.parseJSON(msg);
                if (json.IsSuccess) {
                    $(obj).text("Cancelled");
                    $("#appointmentsBody .msg").text("Your appointment was cancelled successfully.");
                    $("#appointmentsBody .msg").css('display', 'block');
                    $("#appointmentsBody .msg").css('color', 'black');
                    // $(obj).parent().parent().remove();
                } else {
                    $("#appointmentsBody .msg").text(json.ArgumentErrors[0].ErrorMessage);
                    $("#appointmentsBody .msg").css('display', 'block');
                    $("#appointmentsBody .msg").css('color', 'black');
                }

            });
    }
}

function GetCardType(number) {

    if (!luhnCheck(number)) {
        return "";
    }
    // visa

    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";

    // Mastercard 
    // Updated for Mastercard 2017 BINs expansion
    if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "MasterCard";

    // AmericanExpress
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AmericanExpress";

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";

    // // Diners
    // re = new RegExp("^36");
    // if (number.match(re) != null)
    //     return "Diners";

    // // Diners - Carte Blanche
    // re = new RegExp("^30[0-5]");
    // if (number.match(re) != null)
    //     return "Diners";

    // // JCB
    // re = new RegExp("^35(2[89]|[3-8][0-9])");
    // if (number.match(re) != null)
    //     return "JCB";

    // // Visa Electron
    // re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    // if (number.match(re) != null)
    //     return "Visa Electron";

    // //Maestro
    // if (/^(5[06-8]|6\d)\d{14}(\d{2,3})?$/.test(number))
    //     return "Maestro";
        
    return "";
}


function luhnCheck(cardNum) {
    // Luhn Check Code from https://gist.github.com/4075533
    // accept only digits, dashes or spaces
    var numericDashRegex = /^[\d\-\s]+$/
    if (!numericDashRegex.test(cardNum)) return false;

    // The Luhn Algorithm. It's so pretty.
    var nCheck = 0,
        nDigit = 0,
        bEven = false;
    var strippedField = cardNum.replace(/\D/g, "");

    for (var n = strippedField.length - 1; n >= 0; n--) {
        var cDigit = strippedField.charAt(n);
        nDigit = parseInt(cDigit, 10);
        if (bEven) {
            if ((nDigit *= 2) > 9) nDigit -= 9;
        }

        nCheck += nDigit;
        bEven = !bEven;
    }

    return (nCheck % 10) === 0;
}

function normalizeYear(year) {
    // Century fix
    var YEARS_AHEAD = 20;
    if (year < 100) {
        var nowYear = new Date().getFullYear();
        year += Math.floor(nowYear / 100) * 100;
        if (year > nowYear + YEARS_AHEAD) {
            year -= 100;
        } else if (year <= nowYear - 100 + YEARS_AHEAD) {
            year += 100;
        }
    }
    return year;
}

function checkExp(monthYear) {
    var monthYear = monthYear;

    var match = monthYear.match(/^\s*(0?[1-9]|1[0-2])\/(\d\d|\d{4})\s*$/);
    if (!match) {
        return 'Date must be in mm/yyyy format';

    }
    var exp = new Date(normalizeYear(1 * match[2]), 1 * match[1] - 1, 1).valueOf();
    var now = new Date();
    var currMonth = new Date(now.getFullYear(), now.getMonth(), 1).valueOf();
    if (exp <= currMonth) {
        return 'Expired';
    } else {
        return 'Valid';
    };
}

function element_showable(el_arr, status) {
    var length = el_arr.length
    if (length > 0) {
        for (i = 0; i < length; i++) {
            switch (status) {
                case "disabled":
                    $("#" + el_arr[i]).prop('disabled', true);
                    $("#" + el_arr[i]).val('');
                    break;
                case "enabled":
                    $("#" + el_arr[i]).prop('disabled', false);
                    break;
                case "visible":
                    $("." + el_arr[i]).css('visibility', "visible");
                    break;
                case "hidden":
                    $("." + el_arr[i]).css('visibility', "hidden");
                    break;
                default:
                    break;
            }

        }
    }
}

$("#cardSel").change(function(){
    if($(this).val()!=''){
        $(".NewCreditCardDetails").css("display","none");
    }else{
        $(".NewCreditCardDetails").css("display","block");
    }
})

$("#card_number").change(function(){
    var _cardNum = $(this).val();

    var _card_type = GetCardType(_cardNum);
    if(_card_type != ""){
        var _img_folder = 'assets/img/cards/';
        var _img_name = "";
        var _cardtypeID='';
        if(_card_type == 'Visa') {_img_name = "visa.png";_cardtypeID = 2;}
        else if(_card_type == 'MasterCard'){ _img_name = "mastercard.png";_cardtypeID = 3;}
        else if(_card_type == 'AmericanExpress') {_img_name = "amex.png";_cardtypeID = 1;}
        else if(_card_type == 'Discover') {_img_name = "discover.png";_cardtypeID = 4;}
        // else if(_card_type == 'Diners') {_img_name = "diners.png";_cardtypeID = 5;}
        // else if(_card_type == 'Diners'){ _img_name = "diners.png";_cardtypeID = 5;}
        // else if(_card_type == 'JCB') {_img_name = "jcb.png";_cardtypeID = 6;}
        // else if(_card_type == 'Visa Electron'){ _img_name = "visa.png";_cardtypeID = 2;}
        if(_img_name !=""){
            $("#card_type_flag").html('<img src="'+_img_folder+_img_name+'" style="width: 10%; padding: 0 0 8px 0;"/>');
            $("#cc_type").val(_card_type);
            $("#cc_type_id").val(_cardtypeID);
            // $('.card-unrgd').remove();
        }else{
            // $(".card-errors").append('<p class="card-unrgd">This is not a recognized credit card number</p>');
            $("#cc_type").val("un-recognized");
            $("#cc_type_id").val('');
        }

    }else{
        $("#cc_type").val("un-recognized");
        $("#cc_type_id").val('');
        // $(".card-errors").append('<p class="card-unrgd">This is not a recognized credit card number</p>');
    }


});


//getCreditcardtypes
function _getCreditCardTypes() {
    $.ajax({
        method: "POST",
        url: "app/ajax_requests.php",
        data: {
            'type': 'GetCreditCardTypes'
        }
    })
    .fail(function (msg) {
        console.log(msg)
    })
    .done(function (msg) {
        // console.log(msg);
        var data = JSON.parse(msg);
        if (data.length == 0) {
            return;
        } else {
            // console.log(data);
        }
    });
}