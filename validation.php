<?php
// validation.php - Input validation functions

function validate_username($username) {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}

function validate_password($password) {
    // At least 8 chars, 1 uppercase, 1 lowercase, 1 number
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}

function validate_vehicle_number($number) {
    // Format: MP 04 1234 or similar
    return preg_match('/^[A-Z]{2} \d{2} \d{4}$/', $number);
}

function validate_date($date) {
    return (bool)strtotime($date);
}

function validate_number($number, $min = 0, $max = 999999) {
    return filter_var($number, FILTER_VALIDATE_INT, 
        array('options' => array('min_range' => $min, 'max_range' => $max)));
}
?>
