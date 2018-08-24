<?php
include("users.php");
include("products.php");
$users = new User();
$accounts = $users->getAllUser();

$params = getopt("a:e:p:q:r:");
$action = (isset($params['a'])) ? $params['a']: "";

switch($action)
{
    case "caseTest":
    	$email = (isset($params['e'])) ? $params['e']: "";
    	$nameProduct = (isset($params['p'])) ? $params['p']: "";
    	$products = new Product();
		$productArray = $products->getAllProduct();
		foreach ($productArray as $product) {
			if($product['name'] == $nameProduct ){
				$price = $product['price'];
			}
		}
    	$qty = (isset($params['q'])) ? $params['q']: "";
        if($email != "" && $nameProduct != "" && (int)$qty > 0)
        {
			$fileContents = file_get_contents('json_array.txt');
			$arrayCart = json_decode($fileContents, true);

            $array =  
		        ["email" => $email, "nameProduct" => $nameProduct, "qty" => $qty,  "price" => $price]
		    ;
		    $cart = array();

		    if($arrayCart){
		    	// check product is exist in cart
		    	$check = $products->checkProductInCart($array);
		    	if($check == 1){
		    		foreach ($arrayCart as $value) {
		    			if($value['nameProduct'] == $nameProduct){
		    				//check add or remove product from cart
		    				$checkRemove = (isset($params['r']) && $params['r'] == 1) ? 1: 0;
		    				if($checkRemove == 1){
		    					if((int)$value['qty'] >= (int)$qty ){
		    						$qtyNew = (int)$value['qty'] - (int)$qty ;
		    					}else {
		    						print_r("data input error");die;
		    					}
		    					
		    				}else {
		    					$qtyNew = (int)$qty + (int)$value['qty'];
		    				}
		    				
		    				$array =  
						        ["email" => $email, "nameProduct" => $nameProduct, "qty" => $qtyNew,  "price" => $price]
						    ;
						    array_push($cart, $array );
		    			}else {
		    				array_push($cart, $value );
		    			}
		    		}
		    	}else {
		    		foreach ($arrayCart as $value) {
			    		array_push($cart, $value );
			    	}
			    	array_push($cart, $array );
		    	}
		    	
				$encodedString = json_encode($cart);
				file_put_contents('json_array.txt', $encodedString);
			}else {
				array_push($cart, $array);
				//var_dump($cart); die;
				$encodedString = json_encode($cart);

				file_put_contents('json_array.txt', $encodedString);
			}

		    $fileContents = file_get_contents('json_array.txt');
			$carts = json_decode($fileContents, true);

			print_r("Item Product is added. Done!: " ) ;
			echo "</br>";
			print_r($carts);
        }
        break;
    case "shoppingCart":
    	$email = (isset($params['e'])) ? $params['e']: "";
		$fileContents = file_get_contents('json_array.txt');
		$carts = json_decode($fileContents, true);
		$total = 0;
		foreach ($carts as $cart) {
			if ($cart['email'] == $email ) {
				$total = (float)$total + (float)$cart['price'] * (int)$cart['qty'];
			}
		}
		print_r("Total price cart: ". ($total) . "$") ;
        break;
    case "emptyCart":
    	file_put_contents('json_array.txt', '');
    	break;
}