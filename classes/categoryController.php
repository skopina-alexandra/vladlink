<?php

class CategoryController extends Category{
    public function importCategoriesFromFile($filename){
        $categoriesData = json_decode(file_get_contents($filename), true);
        foreach ($categoriesData as $category) {
            $this->addCategory($category);
        }
    }   
}
