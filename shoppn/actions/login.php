<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "../core/core.php";
require_once '../controllers/CustomerController.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $pass = $_POST["pass"];

    if(empty($email) || empty($pass)){
        set_flash('error', 'Required fields cannot be empty');
        redirect(BASE_URL . 'views/login.php');
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        set_flash('error', 'Please enter a valid email');
        redirect(BASE_URL . 'views/login.php');
    }

    if(strlen($email) > 50){
        set_flash('error', 'Email should be less than 50 characters');
        redirect(BASE_URL . 'views/login.php');
    }

    if(strlen($pass) < 8){
        set_flash('error', 'Password must be at least 8 characters in length');
        redirect(BASE_URL . 'views/login.php');
    }

    $controller = new CustomerController();

    $result = $controller->login($email, $pass);
    
    if($result['success'] == true){
        $user_data = $result['data'];

        $_SESSION['name'] = $user_data['name'];
        $_SESSION['customer_id'] = $user_data['customer_id']; 
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['user_role'] = $user_data['user_role'];

        redirect(BASE_URL . '/views/home.php');
    }else{
        set_flash('error', $result['error']);
        redirect(BASE_URL . 'views/login.php');
    }
}else{
    redirect(BASE_URL . 'views/login.php');
}