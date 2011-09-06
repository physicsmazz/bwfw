<?php

class Product{
	private $conn;
	private $prodId;
    public $info;

	function __construct($id = '') {
		//database conn
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or
					  die('There was a problem connecting to the database.');
		if($id){
            $this->prodId = (int)$id;
        }
    }// end contructor

    function setId($id){
        $this->prodId = (int)$id;
    }

    function getInfoBySize($size, $depth){
        $q = 'SELECT id, name, description, depth, price, category FROM products WHERE name = ? AND depth = ? LIMIT 1';
        if ($stmt=$this->conn->prepare($q)){
            $stmt->bind_param('si', $size, $depth);
            $stmt->bind_result($prodId, $name, $desc, $depth, $price, $cat);
            $stmt->execute();
            $stmt->fetch();
            return array('id'=>$prodId, 'name'=>$name, 'description'=>$desc, 'depth'=>$depth, 'price'=>$price, 'category'=>$cat);
        }else throw new EmailException($this->conn->error);
    }

    function allProducts($active=''){
        if ($active == 'active') $q='SELECT prod_id FROM products WHERE prod_avail = 1';
        else $q='SELECT prod_id FROM products';
        if ($stmt=$this->conn->prepare($q)){
            $stmt->execute();
            $stmt->bind_result($prodId);
            while ($stmt->fetch()){$arr[]=$prodId;}
            return $arr;
        }else return $this->conn->error;
    }//end allProducts

	function getProductsByCategory($catId){
        $q = 'SELECT products.id, products.cat_id, subcat_id, subcategories.description, prod_name, description_short, prod_description, prod_price, prod_unit, added FROM products, subcategories WHERE products.cat_id = ' . $catId . ' AND products.subcat_id = subcategories.id ORDER BY id ASC';
		if($stmt = $this->conn->query($q)) {
			while($product = $stmt->fetch_object()){
			    $arr[$product->id] = $product;
			}
			return $arr;
		}else throw new MyException($this->conn->error);
	}//end getProductsByCategory
	function getCatByProdId($id){
        $q = 'SELECT cat_id FROM prod_cat WHERE prod_id = ?';
		if($stmt = $this->conn->prepare($q)) {
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->bind_result($catId);
			if($stmt->fetch()){
			    return $catId;
			}else return $stmt->error;
		}else return $this->conn->error;
	}//end getProductsByCategory

    function getCatNameById($id){
        $q = 'SELECT cat_name FROM categories WHERE cat_id = ?';
        if($stmt = $this->conn->prepare($q)) {
            $stmt->bind_param('i',$id);
            $stmt->execute();
            $stmt->bind_result($catName);
            if($stmt->fetch()){
                return $catName;
            }else return $stmt->error;
        }else return $this->conn->error;
    }//end getProductsByCategory

    function getProdInfo($id = ''){
        if($id){
            $q = 'SELECT * FROM products WHERE id = ' . $id;
        }else{
            $q = 'SELECT * FROM products WHERE id = ' . $this->prodId;
        }
        if($stmt=$this->conn->query($q)){
            if($prodInfo = $stmt->fetch_object()){
                $this->info = $prodInfo;
                return $prodInfo;
            } else return false;
        }else return $this->conn->error;
    }

    function getImages(){
        if($dir = dir("images/products/{$this->prodId}")){
            //List files in images directory
            while (($file = $dir->read()) !== false){
                //if it's a jpg, add to the array
                if(preg_match('/.jpg/',$file)){
                    $files[] = $file;
                }
            }
            $dir->close();
        }//end if
        return $files;
    }

} //End Class

