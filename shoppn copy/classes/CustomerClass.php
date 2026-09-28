<?php
require_once dirname(__DIR__) . "/core/db_class.php";

class CustomerClass extends Database{
    public function emailExists($email){
        $conn = $this->conn;

        if($conn->connect_error){
            die("Connection falied: " . $conn->connect_error);
        }

        $sql = $conn->prepare("SELECT customer_email FROM customer WHERE customer_email = ?");
        $sql->bind_param("s",$email);
        $sql->execute();
        $result = $sql->get_result();

        $exists = $result->num_rows > 0;
        $sql->close();

        return $exists;
    }

    public function addCustomer($name, $email, $pass, $country, $city, $contact){
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

        $conn = $this->conn;

        if($conn->connect_error){
            die("Connection falied: " . $conn->connect_error);
        }

        $sql = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssss", $name, $email, $pass_hash, $country, $city, $contact);

        if($stmt->execute()){
            $new_id = $conn->insert_id;
            $stmt->close();
            return $new_id;
        }else{
            error_log("Insert failed: " . $stmt->error);
        }
    }

    public function login($email, $pass){
        $conn = $this->conn;

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM customer WHERE customer_email = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        if($exists){
            $row = $result->fetch_assoc();
            $verify = password_verify($pass, $row["customer_pass"]);

            if($verify){
                return $row;
            }
        }

        return false;
    }
}
