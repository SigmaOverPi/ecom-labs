<?php
require_once "../classes/CustomerClass.php";
class CustomerController{
    private $model;

    public function __construct(){
        $this->model = new CustomerClass();
    }

    public function register($data){
        // Ensure email is unique before proceeding with registration
        if($this->model->emailExists($data['email'])){
            return ['success' => false, 'error' => 'Email already registered'];
        }

        // Add customer to db
        $new_id = $this->model->addCustomer(
            $data['name'],
            $data['email'],
            $data['pass'],
            $data['country'],
            $data['city'],
            $data['contact'],
        );

        if($new_id){
            return ['success' => true, 'customer_id' => $new_id];
        }else{
            return ['success' => false, 'error' => 'Registration failed. Please try agagin'];
        }
    }
}