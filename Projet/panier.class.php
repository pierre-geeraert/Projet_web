<?php
class panier{

	private $DB;

	public function __construct($DB){
		if(!isset($_SESSION)){				// If Session does not exist , it is create
			session_start();
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();   // The Session will initiate with the lass 'panier' and have an array
		}
		$this->DB = $DB;

		if(isset($_GET['delPanier'])){
			$this->del($_GET['delPanier']);			//for del an elements of the session 'panier'
		}
		if(isset($_POST['panier']['quantity'])){
			$this->recalc();						// quantity of different product
		}
	}

	public function recalc(){										// function for recalc the total price of an order 
		foreach($_SESSION['panier'] as $product_id => $quantity){
			if(isset($_POST['panier']['quantity'][$product_id])){			
				$_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
			}
		}
	}

	public function count(){
		return array_sum($_SESSION['panier']);		// count the sum of all products  price
	}

		public function total(){
		$total = 0;
		$ids = array_keys($_SESSION['panier']);		// function tatal of the panier 
		if(empty($ids)){
			$products = array();
		}else{
			$products = $this->DB->query('SELECT product_id, price FROM products WHERE product_id IN ('.implode(',',$ids).')');  // request in order to have the product id and his price 
		}
		foreach( $products as $product ) {
			$total += $product->price * $_SESSION['panier'][$product->product_id]; // the total = the price * the number of products
		}
		return $total;
	}
	public function add($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			$_SESSION['panier'][$product_id]++;
		}else{												// function to add a product in the 'panier'
			$_SESSION['panier'][$product_id] = 1;
		}
	}

	public function del($product_id){					// function to DEL a product in the 'panier'
		unset($_SESSION['panier'][$product_id]);
	}

}