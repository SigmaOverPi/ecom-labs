<?php
// require_once dirname(__DIR__) . "/core/core.php";
require_once __DIR__ . "/../core/core.php";

class CartClass extends Database{
    public function isInCart($pid, $ip){
        $sql = 'SELECT * FROM cart WHERE p_id = ? AND ip_add = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("is", $pid, $ip);

        $stmt->execute();

        $result = $stmt->get_result();

        return ($result->num_rows > 0);
    }
    
    public function addToCart($pid, $qty, $ip, $cid=null){
        $sql = 'INSERT INTO cart (p_id, ip_add, c_id, qty) VALUES (?, ?, ?, ?)';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("isii", $pid, $ip, $cid, $qty);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function getCartItems($ip){
        $sql = 'SELECT c.*, p.product_title, p.product_price, p.product_image FROM cart c INNER JOIN products p ON c.p_id = p.product_id WHERE c.ip_add = ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $ip);

        $stmt->execute();

        $result = $stmt->get_result();

        $cartItems = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $cartItems[] = $row;
            }
        }

        return $cartItems;
    }

    public function getCartCount($ip){
        $sql = 'SELECT COALESCE(SUM(qty), 0) AS quantity FROM cart WHERE ip_add = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $ip);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['quantity'];
    }

    public function getCartTotal($ip){
        $sql = 'SELECT COALESCE(SUM(c.qty * p.product_price), 0) AS total FROM cart c INNER JOIN products p ON c.p_id = p.product_id WHERE c.ip_add = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $ip);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function removeFromCart($pid, $ip){
        $sql = 'DELETE FROM cart WHERE p_id = ? AND ip_add = ?';

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("is", $pid, $ip);

        return $stmt->execute();
    }

    public function updateQty($pid, $qty, $ip){
        $sql = 'UPDATE cart SET qty = ? WHERE p_id = ? AND ip_add = ?';

        $stmt = $this->conn->prepare($sql);

        // Bind order follows the ?s in the SQL: qty first, then p_id, then ip_add
        $stmt->bind_param("iis", $qty, $pid, $ip);

        return $stmt->execute();
    }
}
