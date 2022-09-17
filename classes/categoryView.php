<?php

class CategoryView extends Category{

    public function showCategoryList(){
        $categories = $this->getAllCategories();
        foreach($categories as $category){
            echo $this->getCategoriesList($category);
        }
    }

    private function getCategoriesList($category){
        
        $list = "<ul>";
        $list .= "<li>" . $category["name"];
        foreach ($category["children"] as $child) {
            $list .= $this->getCategoriesList($child);
        }
        $list .= "</li></ul>";
        return $list;

    }

    public function exportCategoriesToFile($filename, $withUrl = true, $maxdepth = -1, $depth = 0){
        $stream = fopen($filename, "w+");
        if (!$stream){
            throw new Exception("Failed to open file");
        }
        $categories = $this->getAllCategories($depth, $maxdepth);
        foreach($categories as $category) {
            $this->writeCategoryToFile($stream, $category, $withUrl);
        }
        fclose($stream);
    }

    private function writeCategoryToFile($stream, $category, $withUrl, $parent_url = ""){
        $string = "";
        $indent = "\t";
        for ($i = 0; $i < $category["depth"]; $i++){
            $string .= $indent;
        }

        $string .= $category["name"];
        
        $url = $parent_url . "/" . $category["alias"];
        if ($withUrl){
            $string .= " " . $url;
        }

        fwrite($stream, $string."\n");
        
        if (count($category["children"])){
            foreach($category["children"] as $child){
                $this->writeCategoryToFile($stream, $child, $withUrl, $url);
            }
        }
    }
}