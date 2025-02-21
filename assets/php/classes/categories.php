<?php
class Categories{
    static function getAll(){
        global $conn;

        $selectCategories = $conn->prepare("SELECT DISTINCT category FROM products");
        $selectCategories->execute();
        $categories = $selectCategories->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
}
?>