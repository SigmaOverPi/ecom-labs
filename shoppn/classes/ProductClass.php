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

    public function addProduct($cat, $brand, $title, $price, $desc, $image, $keywords){
        $sql = 'INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iisdsss", $cat, $brand, $title, $price, $desc, $image, $keywords);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function updateProduct($id, $cat, $brand, $title, $price, $desc, $image, $keywords){
        $sql = 'UPDATE products SET product_cat = ?, product_brand = ?, product_title = ?, product_price = ?, product_desc = ?, product_image = ?, product_keywords = ? WHERE product_id = ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("iisdsssi", $cat, $brand, $title, $price, $desc, $image, $keywords, $id);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function getProductById($id){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id WHERE p.product_id = ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        return $product;
    }

    public function getAllProducts(){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id ORDER BY p.product_title ASC';
        $result = $this->conn->query($sql);

        $products = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $products[] = $row;
            }
        }

        return $products;
    }

    public function getFeaturedProducts($n){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id ORDER BY RAND() LIMIT ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $n);

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        return $products;
    }

    public function getProductsByCategory($cat){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id WHERE p.product_cat = ? ORDER BY p.product_title ASC';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $cat);

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        return $products;
    }

    public function getProductsByBrand($brand){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id WHERE p.product_brand = ? ORDER BY p.product_title ASC';
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $brand);

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        return $products;
    }

    public function searchProducts($q){
        $sql = 'SELECT p.*, c.cat_name, b.brand_name FROM products p INNER JOIN categories c ON p.product_cat = c.cat_id INNER JOIN brands b ON p.product_brand = b.brand_id WHERE p.product_title LIKE ? OR p.product_keywords LIKE ? ORDER BY p.product_title ASC';
        $stmt = $this->conn->prepare($sql);


        $like = '%' . $q . '%';

        $stmt->bind_param("ss", $like, $like);

        $stmt->execute();

        $result = $stmt->get_result();

        $products = [];

        while($row = $result->fetch_assoc()){
            $products[] = $row;
        }

        return $products;
    }
}