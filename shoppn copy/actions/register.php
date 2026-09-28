<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../core/core.php';
require_once '../controllers/CustomerController.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = clean($_POST['name'] ?? '');
    $email = clean($_POST['email'] ?? '');
    $pass = $_POST['pass'] ?? '';
    $country = clean($_POST['country'] ?? '');
    $city = clean($_POST['city'] ?? '');
    $contact = clean($_POST['contact'] ?? '');

    if(empty($name) || empty($email) || empty($pass)){
        set_flash('error', 'Required fields cannot be empty');
        redirect(BASE_URL . '/views/register.php');
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        set_flash('error', 'Please enter a valid email');
        redirect(BASE_URL . '/views/register.php');
    }

    if(strlen($email) > 50){
        set_flash('error', 'Email should be less than 50 characters');
        redirect(BASE_URL . '/views/register.php');
    }

    if(strlen($pass) < 8){
        set_flash('error', 'Password must be at least 8 characters in length');
        redirect(BASE_URL . '/views/register.php');
    }

    $controller = new CustomerController();

    $data = [
        'name' => $name,
        'email' => $email,
        'pass' => $pass,
        'country' => $country,
        'city' => $city,
        'contact' => $contact,
    ];

    $result = $controller->register($data);

    if($result['success'] == true){
        // Set session variables
        $_SESSION['customer_id'] = $result['customer_id'];
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['user_role'] = 2; // default customer role is 2

        redirect(BASE_URL . '/views/my_account.php');
    }else{
        // Use error message from result
        set_flash('error', $result['error']);

        redirect(BASE_URL . '/views/register.php');
    }
}else{
    redirect(BASE_URL . '/views/register.php');
}