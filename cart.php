<?php session_start(); 
include_once("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="" />
<title>Shopping Cart</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/normal.css" />
</head>
<body>
<div class="container">
  <div class="header">
    <h4 class="text-muted">Shopping Cart Demo</h4>
  </div>
  <?php

	$product_id = $_GET['product_id'];	  
	$action 	= $_GET['action'];  
	$_SESSION['sum'] = $sum;


	switch($action) {	
	
		case "add":
			$_SESSION['cart'][$product_id]++;
			header('Location: cart.php');
		break;
		
		case "remove":
			$_SESSION['cart'][$product_id]--; 
			header('Location: cart.php');
			if($_SESSION['cart'][$product_id] == 0) {
				unset($_SESSION['cart'][$product_id]); 
			} 
		break;
		
		case "empty":
			unset($_SESSION['cart']); 
		break;
	
	}
	
?>
  <?php 

if(isset($_POST['update'])){

			foreach($_POST['quantity'] as $key => $val){

				if($val==0) {

						unset($_SESSION['cart'][$key]); 		
				}else {

					$_SESSION['cart'][$key]=$val;

				}
			}
		}
?>
  <?php	

	if($_SESSION['cart']) {	
		
		echo "<table class=\"table\" border=\"0\" width=\"100%\">";	
				
			foreach($_SESSION['cart'] as $product_id => $quantity) {	
								
				$query = sprintf("SELECT name, description, price FROM products WHERE id = %d;",
								$product_id); 
					
				$result = mysql_query($query);
					
				//always display the row if there is a product
				if(mysql_num_rows($result)>0) {
				
					list($name, $description, $price) = mysql_fetch_array($result);
				
					$sum = $sum + $quantity;
					$each_cost = $price * $quantity;
					$total = $total + $each_cost; 
				
					echo "<tr>";
						echo "<td>$name</td>";
						
						//echo "<td><input name=\"quantity\" type=\"text\" size=\"2\">".$quantity."<a href=\"$_SERVER[PHP_SELF]?action=remove&product_id=$product_id\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";
						echo "<td><form action=\"cart.php\" method=\"POST\">
								<input name=\"quantity[$product_id]\" type=\"text\" size=\"1\" value=\"$quantity\">
						  		<input name=\"update\" type=\"submit\" value=\"Update\"></td>
						      	</form>";//<input name=\"update\" type=\"text\" value=\"$product_id\">		
						echo "<td>$each_cost</td>";	
					echo "</tr>";					
				}			
			}			
			//show the total
			echo "<tr>";
				echo "<td>Total</td>";
				echo "<td>$sum</td>";
				echo "<td>$total</td>";				
			echo "</tr>";

			echo "<tr>";
			echo "<td colspan=\"3\" ><a href=\"?action=empty\" onclick=\"return confirm('Are you sure?');\">Empty Cart</a></td>";
			echo "</tr>";		
		echo "</table>";
		
		
	
	}else{

		echo "You have no items in your shopping cart.";
		
	}
	
	function invalid($product_id) {

			$sql = sprintf("SELECT * FROM products WHERE id = %d;",
							$product_id); 
				
			return mysql_num_rows(mysql_query($sql)) > 0;
	}

?>
  <a href="product.php">Continue Shopping</a> <a href="checkout.php">Proceed to Check Out</a>
  <div class="footer">
    <p>© Pei-Han Chao 2014</p>
  </div>
</div>
<!-- /container -->
</body>
</html>