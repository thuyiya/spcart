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
    <ul class="nav nav-pills pull-right">
    </ul>
    <h4 class="text-muted">Shopping Cart Demo</h4>
  </div>
  <div class="container">
    <div class="row">
      <?php
$query = "SELECT * FROM products";
 $result = mysql_query($query);
   while($row = mysql_fetch_assoc($result)){          
?>
      <div class="col-md-4">
        <div id="name"><?php echo $row['name']; ?></div>
        <div id="description"><?php echo $row['description']; ?></div>
        <div id="price"><?php echo $row['price']; ?></div>
        <div>
          <button type="button" class="btn btn-link">
          <a href="cart.php?action=add&product_id=<?php echo $row['id'];?>">Add to Cart</a>
          </button>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="footer">
    <p>© 2014 Pei-Han Chao </p>
  </div>
</div>
<!-- /container --> 
</body>
</html>
