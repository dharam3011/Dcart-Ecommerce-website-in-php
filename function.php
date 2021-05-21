<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
	global $conn;
	$str=mysqli_real_escape_string($conn,$str);
	return $str;

}

function redirect($link){
	?>
	<script>
	window.location.href='<?php echo $link?>';
	</script>
	<?php
	die();
}

function get_date($date)
{
    $date =strtotime($date);

    echo date('d-m-Y',$date);
}

function get_date_time($date)
{
    $date =strtotime($date);

    echo date('d-m-Y H:i:s ',$date);
}

// get product data from database
function get_product($limit='',$cat_id='',$sub_cat_id='',$sort_order_cat='',$sort_order_sub_cat='',$best_seller='')
{
	global $conn;

	$query = "SELECT product.*,category.category_name FROM product 
					INNER JOIN category ON product.category_id = category.category_id 
					INNER JOIN sub_category ON product.sub_category_id = sub_category.sub_category_id WHERE product.status = '1' ";
	
	// product display by category
	if ($cat_id > 0) 
	{
		$query.= " AND category.category_id = '$cat_id' ";	
	}

	// product display by sub category
	if ($sub_cat_id > 0) 
	{
		$query.= " AND sub_category.sub_category_id = '$sub_cat_id'";	
	}

	// best seller product
	if ($best_seller != '') 
	{
		$query.= " AND product.best_seller = 1";	
	}

	// product display by sort cartegory
	if ($sort_order_cat != '') 
	{
		$query.= $sort_order_cat ;	
	}
	elseif ($sort_order_sub_cat != '') 
	{
		$query.= $sort_order_sub_cat ;	
	}
	else
	{
		$query.= " ORDER BY product.product_id DESC ";
	}

	if ($limit > 0) 
	{
		$query.= " limit ".$limit;
	}

	$result = mysqli_query($conn,$query);

	$product_arr = array();

	while($row = mysqli_fetch_assoc($result))
	{
		$product_arr[] = $row;
	}

	return $product_arr;
}

// get user address from database
function get_address($type='',$address_id = '',$order_id = '')
{
	global $conn;

	$query_select_add = "SELECT * FROM address ";

	if ($type == 'edit') 
	{
		$query_select_add .= " WHERE address_id = '$address_id' ";
	}

	if ($order_id != '') 
	{
		$query_select_add .= " WHERE order_id = '$order_id' ";
	}

	$query_select_add .= "ORDER BY address_id DESC";
	
	$result_select_add = mysqli_query($conn , $query_select_add);

	$addressArray = array();

	while ($row_add = mysqli_fetch_assoc($result_select_add)) 
	{
		$addressArray[] = $row_add;
	}
	return $addressArray;
}