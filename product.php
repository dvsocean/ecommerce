<?php

class Product extends Object
{
    protected static $db_table= "products";
    protected static $where_clause= "product_id";
    protected static $db_table_fields= array('product_name', 'product_price', 'product_image', 'product_make',
        'product_year', 'product_color', 'product_quantity', 'product_condition', 'product_location',
        'product_measurements', 'product_desc', 'product_short_desc', 'product_refund', 'product_tracking');


    public $name;
    public $price;
    public $image;
    public $make;
    public $year;
    public $color;
    public $quantity;
    public $condition;
    public $location;
    public $measurements;
//    public $variations;
//    public $category;
    public $description;
    public $short_desc;
    public $refund;
    public $tracking;

    private $temp_path;
    private $upload_directory= "product_images";



    public function set_product_image($file){

        if (!is_array($file)){
            Session::set_message("<h3 class='bg-danger text-center curves'>NO IMAGE WAS FOUND</h3>");
            $this->image= null;
            $this->temp_path= null;
            return false;
        } elseif ($file['error'] != 0) {
            Session::set_message("<h3 class='bg-primary text-center curves'>".$this->error_array[$file['error']]."</h3>");
            return false;
        } else {
            $this->image= $file['name'];
            $this->temp_path= $file['tmp_name'];
            return true;
        }
    }


    public function save_product_and_image(){

        $target_path= SITE_ROOT . DS . $this->upload_directory . DS . $this->image;

        if (empty($this->image)) {
            Session::set_message("<h3 class='bg-danger text-center curves'>Product image was not uploaded because it was not found</h3>");
            $this->image= null;
            $this->temp_path= null;
            $this->create_product();
            return true;
        } elseif (file_exists($target_path)) {
            $this->image= null;
            $this->temp_path= null;
            Session::set_message("<h3 class='bg-danger text-center curves'>Image not uploaded, because it already exists in DB</h3>");
            $this->create_product();
            return true;
        } elseif (move_uploaded_file($this->temp_path, $target_path)){
            $this->create_product();
            Session::set_message("<h3 class='bg-primary text-center curves'>Product uploaded successfully</h3>");
            unset($this->temp_path);
            return true;
        } else {
            return false;
        }
    }

    public function create_product(){
        global $database;
        $target_path= SITE_ROOT . DS . $this->upload_directory . DS . $this->image;

        $sql="INSERT INTO " . self::$db_table . "(" .  implode(", ", self::$db_table_fields). ")";
        $sql.=" VALUES('$this->name', '$this->price', '$this->image', '$this->make', '$this->year', '$this->color',";
        $sql.=" '$this->quantity', '$this->condition', '$this->location', '$this->measurements',";
        $sql.=" '$this->condition', '$this->short_desc', '$this->refund', '$this->tracking');";

        if ($database->query($sql)) {
            return true;
        } else {
            Session::set_message("<h3 class='bg-danger text-center curves'>There was a problem inserting this product</h3>");
            return false;
        }
    }


}//End of class