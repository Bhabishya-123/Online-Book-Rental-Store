
<?php
session_start();
if(isset($_SESSION['order_auth'])){
  //restriction for unauthorized access
  if(!(isset($_SESSION['id']))){
    header("location:login.php?Unathorized");
    die();
   }
require('stripeConfig.php');
require('./includes/config.php');

if(isset($_POST['stripeToken'])){
	?>
<?php
    $today_date =  date("Y/n/j/"); 
    if(! isset($_GET['items'])){
//for single book purchase
$sql = "INSERT INTO rentorders (
    cid,
    bid,
    price,
    date,
    return_date
) VALUES(
    {$_SESSION['id']},
    {$_GET['id']},
    {$_SESSION['payment_amt']},
    '{$today_date}',
    '{$_SESSION['return_date']}'
    )";

$conn->query($sql);
unset($_SESSION['payment_amt'],$_SESSION['return_date']);

}
            else{
//for cart(many) book purchase
$sql = "SELECT * FROM carts where uid={$_SESSION['id']} AND status='active'";
$result = $conn->query($sql) or die("Query Failed.");
$sn=0;
while($row = $result->fetch_assoc()) { 
    $sql2 = "INSERT INTO rentorders (
    cid,
    bid,
    quantity,
    price,
    date,
    return_date)
    values(
        {$_SESSION['id']},
        {$row['pid']},
        {$row['quantity']},
        {$row['price']},
        '{$today_date}',
        '{$row['return_date']}'
        )";
            $conn->query($sql2);
}
//after cart order sent || deleting cart items from db
$sql3 = "DELETE FROM carts";
$conn->query($sql3);
        }

    
$conn->close();

?>
	<style>
        
        .mess-cont{
            height:100%;
            display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        }
    .mess-box{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        height:70%;
        width:60%;
        box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
-webkit-box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
-moz-box-shadow: 10px 10px 34px 7px rgba(204,247,203,0.75);
    }
    .mess{
        height: clamp(250px,540px,70%);
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }
    
</style>
<link rel="stylesheet" href="./css/style.php">
<div class="mess-cont">

<div class="mess-box">
<div class="mess">
    <img  src="./images/thanks.png" alt="prod to deliver" style="height:80%;width:100%">
<h3 style="margin-bottom:0;padding-bottom:0;color:grey">your book is on the way</h3>
<h3 style="margin-top:0px;padding:0px;color:grey;text-align:center">Thanks for Choosing Book Rental</span></h3>
<button class="btn" style="background:#11C9B6;border:none;"><a href="./products.php?type=new" style='color:white;text-decoration:none'>Continue Renting</a></button>

</div>
</div>
</div>
<?php
}
}
else{
    ?>
    <h3 style="margin-bottom:0;padding-bottom:0;color:grey">Unauthorized Submission !!!</h3>
    <button class="btn" style="background:#11C9B6;border:none;"><a href="./products.php?type=new" style='color:white;text-decoration:none;height:30px'>Visit Booke Rental</a></button>
<?php
}
unset($_SESSION['order_auth']);
?>

