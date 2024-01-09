<?php
if(isset($_POST['delete'])){
  include_once 'includes/config.php';
$sql = "DELETE FROM carts where pid={$_GET['pid']} AND quantity={$_GET['q']} LIMIT 1"; //sql query for deleting
$conn->query($sql); //executing sql query

header("Location:cart.php?itemRemovedSuccessfully");
}
?>
<?php
   include_once('./includes/navbar.php');
      //this restriction will secure the pages path injection
      if(!(isset($_SESSION['id']))){
        header("location:index.php?UnathorizedUser");
        die();
       }
       include_once('./stripeConfig.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book|Cart</title>
 <style>
       *{
        margin:0;padding:0;
      }
      .facross{
    color:  #DC143C !important;
}
  .text-end{
     text-align:center
  }
 </style>
</head>
<body>
<div class='cart' >
  <div class="container" >
  <br><br>
  <br><br>
    <h1 style='float:left'>Cart</h1>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div style=''>

<?php
       $total=0;
  $sql = "SELECT * FROM carts where uid={$_SESSION['id']} AND status='active'";
$result = $conn->query($sql) or die("Query Failed.");
if ($result->num_rows > 0) {
?>
<div style='margin-left:5%'>
    <table class='cart-table' style="position:relative;">
<thead>
<thead >
        <tr>
          <th>Sn</th>
          <th>Book</th>
          <th>Rent Charge</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Return Date</th>
          <th>Action</th>
        </tr>
      </thead>
</thead>
<tbody >
     <?php
     $sn=0;
while($row = $result->fetch_assoc()) { 
  $sn = $sn+1;
  //by this way we can encode data and pass this data to anther page and use it after decoding
  // $quantArray[$sn-1] = $row['quantity'];
  // $dateArray[$sn-1] = $row['return_date'];
  // $encodedQuantityData = urlencode(serialize($quantArray));
  // $encodedReturnDateData = urlencode(serialize($dateArray));

  $total = $total+ ($row["price"]*$row["quantity"]);
?>
<tr>
    <td><?php echo $sn?></td>
    <td><?php echo $row["product"] ?></td>
          <td><?php echo $row["rent_charge"] ?>% 
        </td>
        <td><?php echo $row["price"] ?></td>
          <td>
          <p><?php echo $row["quantity"] ?></p>
          </td>
          <td><?php echo ($row["price"]*$row["quantity"]) ?></td>
          <td><?php echo $row["return_date"] ?></td>
          <td>
          <form action="<?php echo $_SERVER['PHP_SELF']?>?pid=<?php echo $row['pid']?>&q=<?php echo $row['quantity']?>" method="post">
<button name='delete' type='submit' ><i class="fa-solid fa-trash fa-lg facross"></i> </button>
</form>
        </td>
</tr>

<?php }?>
</tbody>
<button class="btn" style="background:#11C9B6;border:none;"><a href="./products.php?type=new" style='color:white;text-decoration:none'>Continue Renting</a></button>
</table>
</div>
<div style="margin-top:5px;border-bottom:1px solid white;"></div>
<div style='margin-left:5%'>Total: <?php echo ($total)?> (<i style='color:grey' class="fa fa-motorcycle" aria-hidden="true">Free</i>)</div>
<div style="margin-top:5px;border-bottom:1px solid white;"></div>
<div style="margin-top:5px;border-bottom:1px solid white;"></div>
<div style="margin-top:5px;border-bottom:1px solid white;"></div>
<!-- <form class='cart-stripe-form' style='' action="message.php?id=<?php echo $encodedPidData?>&q=<?php echo $encodedQuantityData?>&rd=<?php echo $encodedReturnDateData?>" method="post"> -->
<form class='cart-stripe-form' style='' action="message.php?items=carts" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo ($total) ?>"
		data-name="Book Rental"
		data-description="Book For Everyone"
		data-image="./images/logo.png"
		data-currency="usd"
		data-email="<?Php echo $_SESSION['customer_email']?>"
    success="<?php //it will be created only when payment is made
        $_SESSION['order_auth']=true;
        ?>"
	>
   //this form container will auto generate paynow button that comers form script form stripe
	</script>
</form>
<?php }else { echo "0 Results <br> No Books in a Cart"; }
             ?>
      </div>
  </div>
  </div>


</body>
</html>





