<?php 

class Category extends Db {
    protected function getAllCategories($depth = 0, $maxdepth = -1){
        $sql = "SELECT id, parent_id, name, alias FROM categories";
        $categories = $this->connect()->query($sql)->fetchAll();
        return $this->getCategoriesTree($categories, 0, $depth, $maxdepth);
    }

    private function getCategoriesTree($categories, $parent_id = 0, $depth = 0, $maxdepth = -1){
        $tree = array();
        if ($maxdepth < 0 || $depth <= $maxdepth) {
            foreach ($categories as $category) {
               if ($category["parent_id"] == $parent_id) {
                    $node = array(
                        "name" => $category["name"],
                        "alias" => $category["alias"],
                        "children" => $this->getCategoriesTree($categories, $category["id"], $depth + 1, $maxdepth),
                        "depth" => $depth);
                    array_push($tree, $node);
                }
            }    
        }
        return $tree;
    }

    protected function categoryExists($category_id){
        $sql = "SELECT categories.id FROM categories WHERE categories.id = :category_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(array(":category_id" => $category_id));
        return $stmt->rowCount() > 0;        
    }

    protected function addCategory($category, $parent_id = 0){
        if (!$this->categoryExists($category["id"])){
            $sql = "INSERT INTO categories (id, parent_id, name, alias)
                    VALUES(:id, :parent_id, :name, :alias)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(array(
                        ":id" => $category["id"],
                        ":parent_id" => $parent_id,
                        ":name" => $category["name"],
                        ":alias" => $category["alias"]
            ));
            
            if (array_key_exists("children", $category)){
                foreach ($category["children"] as $child){
                    $this->addCategory($child, $category["id"]);
                }
            }
        }
    }

}