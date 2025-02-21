<?php
class Products
{
    static function get($category, $brand, $limit)
    {
        global $conn;

        $query = "SELECT id, category, brand, name, title, price, mainImage FROM products";
        $conditions = [];
        $params = [];

        if ($category !== 'producten') {
            $conditions[] = "category = :category";
            $params[':category'] = $category;
        }

        if (!is_null($brand)) {
            $conditions[] = "brand = :brand";
            $params[':brand'] = $brand;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        if (!is_null($limit)) {
            $limit = (int)$limit;
            $query .= " LIMIT :limit";
            $params[':limit'] = $limit;
        }
        $selectProducts = $conn->prepare($query);
        foreach ($params as $key => $value) {
            if ($key === ':limit') {
                $selectProducts->bindValue($key, $value, PDO::PARAM_INT);
            } else {
                $selectProducts->bindValue($key, $value);
            }
        }

        $selectProducts->execute();
        $products = $selectProducts->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("success" => true, "products" => $products));
    }

    static function get5ProductsFromAllCategory()
    { 
        global $conn;

        $selectCategories = $conn->prepare("SELECT name, title FROM categories");
        $selectCategories->execute();
        $categories = $selectCategories->fetchAll(PDO::FETCH_ASSOC);

        $data = [];

        $selectProducts = $conn->prepare("SELECT id, category, brand, name, title, price, mainImage FROM products WHERE category = :category ORDER BY createdAt DESC LIMIT 5");
        foreach ($categories as $category) {
            $selectProducts->bindParam(':category', $category['name']);
            $selectProducts->execute();
            $products = $selectProducts->fetchAll(PDO::FETCH_ASSOC);

            $data[$category['name']] = [
                "title" => $category['title'],
                "products" => $products
            ];
        }

        return json_encode(array("success" => true, "data" => $data));  
    }

    static function getProductFromId($id){
        global $conn;

        $selectProduct = $conn->prepare("SELECT brand, name, title, price, mainImage, galleryImages FROM products WHERE id = :id");
        $selectProduct->bindParam(':id', $id);
        $selectProduct->execute();
        if($selectProduct->rowCount() > 0){
            $product = $selectProduct->fetch();

            return json_encode(array("success" => true, "product" => $product));
        }else{
            return json_encode(array("success" => false, "error" => "Product not found"));
        }
    }
}
?>
