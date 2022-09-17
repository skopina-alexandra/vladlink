<?php

class CategoryController extends Category{
    public function importCategoriesFromFile($filename){
        $categoriesData = json_decode(file_get_contents($filename), true);
        // echo "<pre>";
        // var_dump($categoriesData);
        // echo "</pre>";
        foreach ($categoriesData as $category) {
            $this->addCategory($category);
        }
    }   
}