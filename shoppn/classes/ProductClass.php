<?php
// require_once dirname(__DIR__) . "/core/core.php";
require_once __DIR__ . "/../core/core.php";

// ? What I Learned:
// ? SQL statements with ? use bind_param and execute
// ? SQL statements without ? use query and result->fetch assoc
class ProductClass extends Database{
    public function addBrand($name){
        $sql = "INSERT INTO brands (brand_name) VALUES (?)";

        $stmt = $this->conn->prepare($sql);

        
        $stmt->bind_param("s", $name);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function getAllBrands(){
        $sql = "SELECT * FROM brands ORDER BY brand_name ASC";
        $result = $this->conn->query($sql);

        $brands = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $brands[] = $row;
            }
        }
        return $brands;
    }

    public function getBrandById($id){
        $sql = "SELECT * FROM brands WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateBrand($id, $name){
        $sql = "UPDATE brands SET brand_name = ? WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("si", $name, $id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function addCategory($name){
        $sql = "INSERT INTO categories (cat_name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $name);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllCategories(){
        $sql = "SELECT * FROM categories ORDER BY cat_name ASC";

        $result = $this->conn->query($sql);

        $categories = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $categories[] = $row;
            }
        }

        return $categories;
    }

    public function getCategoryById($id){
        $sql = "SELECT * FROM categories WHERE cat_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateCategory($id, $name){
        $sql = "UPDATE categories SET cat_name = ? WHERE cat_id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("si", $name, $id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}