<?php
session_start();

date_default_timezone_set('Africa/Accra');

require 'db_class.php';

define('BASE_PATH', __DIR__ . '../');
define('BASE_URL', '/shoppn');

function get_ip(){
    return $_SERVER['REMOTE_ADDR'];
}
function redirect($url){
    header("Location: " . $url);
    exit;
}
function is_logged_in(){
    // ? isset could be true and then the content could be an empty string
    // ? so we add !empty to make sure both cases are covered
    return isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id']);
}
function is_admin(){
    return ($_SESSION['user_role'] === 1) ? true : false;
}
function require_login(){
    if(!is_logged_in()){
        redirect('login.php');
    }
}
function require_admin(){
    if(!is_admin()){
        redirect('login.php');
    }
}

// Flash messages are temporary messages like "login successful"
function set_flash($key, $msg){
    $_SESSION[$key] = $msg;
}
function get_flash($key){
    // Check if session key exists
    if(isset($_SESSION[$key])){
        // Save message in key to a variable
        $display_message = $_SESSION[$key];

        // Unset session key
        unset($_SESSION[$key]);

        // Return message saved to variable
        return $display_message;
    }else{
        // Display error message if session key doesn't exist
        die('Session key does not exist');
    }
}
function clean($value){
    trim($value);
    strip_tags($value);
    htmlspecialchars($value);
}
function log_err($msg){
    // Making sure message is always on a new line
    $msg .= "\n";

    // Absolute pathway to file
    $file = __DIR__ . '../error/error.log';

    // Opening file in append-only('a') mode
    $handle = fopen($file, 'a');

    if($handle){
        // Writing message to file
        fwrite($handle, $msg);

        //! Important: Always close handle after writing
        fclose($handle);
    }else{
        echo "Could not open the file";
    }
}
