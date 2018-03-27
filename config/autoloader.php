<?php

$load_classes = [
    "Request.class.php",
    "authentication/Token.class.php",
    "availability/Availability1Day.class.php",
    "availability/AvailableDates.class.php",
    "availability/MultiGuest1Day.class.php",
    "availability/MultiGuestDates.class.php",
    "customer/BookItinerary.class.php",
    "customer/CancelAppointment.class.php",
    "customer/CreateAppointment.class.php",
    "customer/CreateCustomerAndUserAccount.class.php",
    "customer/CreateIncompleteAppointment.class.php",
    "customer/CreateItinerary.class.php",
    "customer/DeleteIncompleteAppointment.class.php",
    "customer/FindEmployees.class.php",
    "customer/FindLocations.class.php",
    "customer/FindTreatments.class.php",
    "customer/ForgotPassword.class.php",
    "customer/ForgotPasswordCustom.class.php",
    "customer/GetCustomer.class.php",
    "customer/GetCustomerAppointments.class.php",
    "customer/GetLocationCancellationPolicy.class.php",
    "customer/GetTreatmentCategories.class.php",
    "customer/GetTreatmentSubCategories.class.php",
    "customer/Login.class.php",
    "customer/Logout.class.php",
    "customer/ResetPassword.class.php",
    "customer/UpdateCustomer.class.php",
    "customer/UpdateProfile.class.php",
    "customer/GetCreditCardTypes.class.php"
    
];

foreach ( $load_classes as $load_class ) {
    include_once( _PROJECT_PATH . '/requests/' . $load_class);
}