/*
 * Show the potentail points of a product in relation to MyRewards plugin.*/
function show_potential_points(){
	global $post, $product; //gets global post and product variables
	$pack_size = $product->get_meta('pack-size'); //gets pack size meta data (optional)
	if($product->is_on_sale){ //if it has a sale price
		$points = ceil($product->get_sale_price()*10); //use sale price and round up to get points
		if($pack_size){ //if pack size exists
			$points = $points * $pack_size; //multiply points by pack size
		}
	}
	else{
		$points = ceil($product->get_price()*10); //if regular price is used
	}
	$user = wp_get_current_user(); //gets user
	if ( !in_array( 'wholesale_customer', (array) $user->roles ) && !in_array( 'distributor', (array) $user->roles ) ) { //if user is not a wholesaler or distributor
		//The user is not a wholesale or distro
		echo "<p id='wq_points'>You will receive {$points} points for this purchase.</p>"; //echo potential points.
	}	
}

add_action('woocommerce_before_add_to_cart_form','show_potential_points');
