$(function () {

    // Click Next step of first step 
    $("#FirstRow .next-step").click(function () {
        if (_isValidStepOne('firstRowForm') == true) {
            // _getAvailableDates($("#datepicker_send").val());                

            $(".guestname1").find("span").text($("#guestfirstname1").val() + " " + $("#guestlastname1").val());
            $(".guestname2").find("span").text($("#guestfirstname2").val() + " " + $("#guestlastname2").val());
            $("#chosen-guest-type").text($("#guesttype option:selected").text());

            $(".TimeslotsInfo").children().remove();
            $("#FirstRow").fadeOut(500);
            $("#SecondRow").fadeIn(800);
            $(".step").removeClass("CurrentStep");
            $(".step-2").addClass("CurrentStep");

            //Load services 
            var multi = $("#multi").val();
            if(multi==""){
                var multi = 0;
            }
            _getAvailableDates($("#treatments").val(), multi);
        } else {
            return false;
        }
    });

    $("#SecondRow .next-step").click(function () {

        if ($("#timeslot").val() == "") {
            return;
        }
        // createincompleteAppointment
        if($("#multi").val()>0) {
            $("#SecondRow").fadeOut(500);
            $("#ThirdRow").fadeIn(800);
            $(".step").removeClass("CurrentStep");
            $(".step-3").addClass("CurrentStep");
            return ;
        }

        var selectedButton = $(".selected.button.timeslot-button.on");
        $.ajax({
                method: "POST",
                url: "app/ajax_requests.php",

                data: {
                    'type': 'CreateIncompleteAppointment',
                    'startDatetime': $("#SelectedTimeSlot").val(),
                    'categoryId': selectedButton.data("categoryid"),
                    'price': selectedButton.data("price"),
                    'serviceID': selectedButton.data("serviceid"),
                    'duration': selectedButton.data("duration")
                }
            })
            .fail(function (msg) {
                console.log(msg);
            })
            .done(function (msg) {
                var data1 = JSON.parse(msg);
                if (data1.IsSuccess) {
                    $('#incomplete_appointment_id').val(data1.IncompleteAppointmentID);                  
                    $("#SecondRow").fadeOut(500);
                    $("#ThirdRow").fadeIn(800);
                    $(".step").removeClass("CurrentStep");
                    $(".step-3").addClass("CurrentStep");
                }
            });
    });

    $("#SecondRow .prev-step").click(function () {
        $(".guestname1").find("span").text('');
        $(".guestname2").find("span").text('');
        $("#chosen-guest-type").text('');


        $("#SecondRow").fadeOut(500);
        $("#FirstRow").fadeIn(800);
        $(".step").removeClass("CurrentStep");
        $(".step-1").addClass("CurrentStep");
        $(".TimeslotsInfo").empty();
        $("#treatments option:eq(0)").prop("selected", true);
    });

    //
    $("#ThirdRow .prev-step").click(function () {
        if ($('#incomplete_appointment_id').val() != "") {
            $.ajax({
                    method: "POST",
                    url: "app/ajax_requests.php",
                    data: {
                        'type': 'DeleteIncompleteAppointment',
                        'IncompleteAppointmentID': $('#incomplete_appointment_id').val()
                    }
                })
                .fail(function (msg) {
                    console.log(msg);
                })
                .done(function (msg) {
                    var data1 = JSON.parse(msg);
                    if (data1.IsSuccess) {
                        // console.log("deleted Incompletappointment ID")
                    }
                });
        }
        $("#ThirdRow").fadeOut(500);
        $("#SecondRow").fadeIn(800);
        $(".step").removeClass("CurrentStep");
        $(".step-2").addClass("CurrentStep");
    })

    $("#ThirdRow .next-step").click(function () {
        var flag = 0;

        if ($("#cardSel").val() == "" && $(".NewCreditCardDetails").css("visibility") === 'visible') {

            if (checkExp($("#exp_date").val()) != 'Valid') {
                $('.payment-errors').text("This credit card is not valid.");
                flag = 1;
                // console.log('10');
            }
            if ($("#postal_code").val() == "") {
                $('.payment-errors').text("Please enter your credit card billing zip code.");
                flag = 1;
                // console.log('4');
            }
            if ($("#security_code").val() == "") {
                $('.payment-errors').text("Please enter your credit card security code.");
                flag = 1;
                // console.log('5');
            }
            if ($("#cc_type").val() == "un-recognized") {
                $('.payment-errors').text("This is not a recognized credit card number.");
                flag = 1;
                // console.log('8');
            }

            if ($("#exp_date").val() == "") {
                $('.payment-errors').text("Please enter your credit card expiration date.");
                flag = 1;
                // console.log('6');
            }
            if ($("#card_number").val() == "") {
                $('.payment-errors').text("Please enter your credit card number.");
                flag = 1;
                // console.log('7');
            }

            if ($("#name_on_card").val() == "") {
                $('.payment-errors').text("Please fill out the name on your credit card.");
                flag = 1;
                // console.log('9');
            }

        } else if ($("#cardSel").val() == "" && $(".NewCreditCardDetails").css("visibility") === 'hidden') {
            $('.payment-errors').text("Please select your payment method.");
            flag = 1;
        }

        // if ($('#default_acccept').prop('checked') == false) {
        //     $('.payment-errors').text("Please accept the service accurately reflects your needs.");
        //     flag = 1;
        //     console.log('1');
        // }

        if ($('#late_policy').prop('checked') == false) {
            $('.payment-errors').text("Please accept the late policy.");
            flag = 1;
            // console.log('2');
        }
        if ($('#cancellation').prop('checked') == false) {
            $('.payment-errors').text("Please accept the cancellation policy.");
            flag = 1;
            // console.log('3');
        }

        if (flag == 1) {
            // console.log('A field is invalid');
            return;
        }

        var multi = $("#multi").val();

        if (multi > 0) {
            book_itinerary();
        } else {
            process_order();
        }
    });

})