<?php
// auth_check.php - Authentication and authorization checks

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: customer_login.php");
        exit();
    }
}

function require_agency() {
    require_login();
    if ($_SESSION['user_type'] !== 'agency') {
        header("Location: unauthorized.php");
        exit();
    }
}

function require_customer() {
    require_login();
    if ($_SESSION['user_type'] !== 'customer') {
        header("Location: unauthorized.php");
        exit();
    }
}
?>
