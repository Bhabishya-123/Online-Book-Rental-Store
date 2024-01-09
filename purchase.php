<?php
        //today date
        $today_date =  date("Y/n/j/"); 

        //calculate day between two date
        function dateDiffInDays($date1, $date2) {
          $oneDay = 60 * 60 * 24; // 1 day in seconds
        
          // Convert date strings to timestamps
          $timestamp1 = strtotime($date1);
          $timestamp2 = strtotime($date2);
        
          // Calculate the difference in seconds
          $diffInSeconds = abs($timestamp1 - $timestamp2);
        
          // Convert the difference to days
          $diffInDays = round($diffInSeconds / $oneDay);
          return $diffInDays;
        }

        //rent charge calculating ()
        function rentRate($day){
          switch ($day) {
            case $day>0 && $day<=25:
              return 23;
              break;
            case $day>25 && $day<=30:
              return 25;
              break;
            case $day>30 && $day<=80:
              return 32;
              break;
            case $day>80 && $day<=90:
              return 35;
              break;
              case $day>90 && $day<=160:
                return 42;
                break;
              case $day>160 && $day<=180:
                return 45;
                break;
            case $day>180 && $day<=300:
              return 48;
              break;
            case $day>300 && $day<=366:
              return 50;
              break;
            
            default:
            return 80;
            break;
          }
        }


?>
<?php    
include_once('./includes/config.php');
include_once('./stripeConfig.php');
$numOfReturnDayCart=1;
if (isset($_POST['addCart'])) { 
  session_start();
  $val = dateDiffInDays($today_date,$_POST['return_date_cart']);
$numOfReturnDayCart = $val-19559;
if($numOfReturnDayCart>0){
$rateCart = rentRate($numOfReturnDayCart);
$bookprice = $_SESSION['bp']*($rateCart/100);
  if(isset($_SESSION['id'])){
$sql22 = "INSERT INTO carts (
    pid,
    uid,
    product,
    price,
    quantity,
    return_date,
    rent_charge
) VALUES(
  {$_SESSION['book_id']},
    {$_SESSION['id']},
    '{$_SESSION['bt']}',
    {$bookprice},
    {$_POST['quantity']},
    '{$_POST['return_date_cart']}',
    {$rateCart}
    )";
$conn->query($sql22);
  }
  else{
    header("Location:login.php?LoginFirst");
    die();
  }

}

}
include_once('./includes/navbar.php');
$sql ="SELECT * FROM  books WHERE book_id='{$_SESSION['book_id']}';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['bt'] = $row['book_title'];
$_SESSION['bp'] = $row['book_price'];

$conn->close();
?>
<head>
    <style>
      *{
        margin:0;padding:0;
      }
        .selected_book{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:35px;
        }

        .img-magnifier-container {
         position:relative;
       }
 

       .img-magnifier-glass {
        position: absolute;
        top:-5px;
        left:-5px;
        opacity:0.1;
        border-radius: 5%;
        cursor: none;
       /*Set the size of the magnifier glass:*/
        width: 10px;
        height: 10px;
      }
       .img-magnifier-glass:hover {
        opacity:1;
        border-radius: 10%;
        cursor: none;
       /*Set the size of the magnifier glass:*/
        width: 100px;
        height: 100px;
      }


      .button {
     border: none;
     color: white;
     padding: 16px;
     text-align: center;
     text-decoration: none;
     font-size: 16px;
     margin: 1px;
     transition-duration: 0.4s;
     cursor: pointer;
     box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .button:hover{
          transform:scale(1.1,1.1);
    }
    .btn2{
      background-color: #E74C3C;
    }
    .btn2:active{
      padding:10px;
    }
    .btn1{
      background-color:#40E0D0;
    }
   .quantityDiv{
    display:flex;
        align-items:center;
        gap:6px;
        margin:3px 0px;
        color:black;

   }
   .section-title{
    margin:0;
    padding:0;
   }
  .incDec{
  font-weight:large;
  font-size:15px;
  cursor:pointer;
  border:1px solid grey;
  width:20px;
  height:20px;
  display:flex;
        align-items:center;
        justify-content:center;
  }
  .incDec:hover{
    background:skyblue;
  }
  #quantity{
    display:flex;
        align-items:center;
        justify-content:center;
    width:50px;
    height:20px;

    text-align:center;
  }

      /*responsive for ipad iphone and other */
   @media (max-width: 700px) {

 .prod-in{
    width:100%;
  }

  }
    </style>
    
    <script>
 //jquery script for image magnifier
function magnify(imgID, zoom) {
  var img, glass, w, h, bw;
  img = document.getElementById(imgID);
  /*create magnifier glass:*/
  glass = document.createElement("DIV");
  glass.setAttribute("class", "img-magnifier-glass");
  /*insert magnifier glass:*/
  img.parentElement.insertBefore(glass, img);
  /*set background properties for the magnifier glass:*/
  glass.style.backgroundImage = "url('" + img.src + "')";
  glass.style.backgroundRepeat = "no-repeat";
  glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
  bw = 3;
  w = glass.offsetWidth / 2;
  h = glass.offsetHeight / 2;
  /*execute a function when someone moves the magnifier glass over the image:*/
  glass.addEventListener("mousemove", moveMagnifier);
  img.addEventListener("mousemove", moveMagnifier);
  /*and also for touch screens:*/
  glass.addEventListener("touchmove", moveMagnifier);
  img.addEventListener("touchmove", moveMagnifier);
  function moveMagnifier(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    x = pos.x;
    y = pos.y;
    /*prevent the magnifier glass from being positioned outside the image:*/
    if (x > img.width - (w / zoom)) {x = img.width - (w / zoom);}
    if (x < w / zoom) {x = w / zoom;}
    if (y > img.height - (h / zoom)) {y = img.height - (h / zoom);}
    if (y < h / zoom) {y = h / zoom;}
    /*set the position of the magnifier glass:*/
    glass.style.left = (x - w) + "px";
    glass.style.top = (y - h) + "px";
    /*display what the magnifier glass "sees":*/
    glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}

</script>
</head>
<body>
  


<div class="selected_book" >
<table style="border-collapse: collapse; text-align: left;margin-top:24px ">
  <thead>
    <tr>
      <th colspan="2" style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
        Book Details
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="padding: 10px; font-weight: bold;"><h5> Name:</h5></td>
      <td style="padding: 10px;"><h5 style="margin: 0;position:relative">
      <div class="img-magnifier-container">
<img id='image-pr' src="admin/upload/<?php echo $row['book_img'] ?>" style="height:90px;width:90px" alt="product-img">
</div>
<br>
<?php echo $row['book_title'] ?>
    </h5></td>
    </tr>
    <tr>
      <td style="padding: 10px; font-weight: bold;"><h5> Price:</h5></td>
      <td style="padding: 10px;"><p style="margin: 0;font-size:13px"><?php echo $row['book_price']." "."(".$row['book_type'].")" ?>
 <span style='height:10px;border-left:px solid grey'></span> 
    </p></td>
    </tr>
    <tr>
      <td style="padding: 10px; font-weight: bold;"><h5> Author:</h5></td>
      <td style="padding: 10px;"><p style="margin: 0;font-size:13px"><?php echo $row['book_author'] ?></p></td>
    </tr>
    <tr>
      <td style="padding: 10px; font-weight: bold;"><h5>Description:</h5></td>
      <td style="padding: 10px;"><p style="margin: 0;font-size:13px;width:60%"><?php echo $row['book_desc'] ?></p></td>
      <tr>
      <td style="padding: 10px; font-weight: bold;"><h5>Publication Date:</h5></td>
      <td style="padding: 10px;"><p style="margin: 0;font-size:13px"><?php echo $row['book_date'] ?></p></td>
    </tr>
    </tr>
    <tr>
    <td style="padding: 10px; font-weight: bold;"><h5>Add To Cart:</h5></td>
      <td style="padding: 10px;"><h4 style="margin: 0;">
      <form style='display:flex;gap:20px' action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
      <div >
      <h6 class="section-title">Quantity</h6>
   <div class='quantityDiv'>
   <span class="IncDec"  onclick="decQuantity()">-</span>
    <input id='quantity' name='quantity'  type="number" value='1' autocomplete="off">
    <span class="IncDec"  onclick="incQuantity()" >+</span>
   </div>
</div>
<div >
<h6 class="section-title" style='margin-bottom:5px'>Return Date:</h6>
<input type="date" name='return_date_cart' id='returnDate' style='margin-bottom:10px' required> 
<?php if($numOfReturnDayCart<=0) echo "<p style='font-size:12px;margin-bottom:4px'>Warning: <span style='color:red;font-size:12px'>Please Enter Correct Date</span></p>";?>
</div>
<div class="btn-pr">
<?php if(isset($_SESSION['id'])&& isset($_POST['return_date_cart'])){
  echo "<input type='submit'  value='Add to Cart' name='addCart'></input>";
}else{
  echo " <input type='submit'  value='Add to Cart' name='addCart'></input>  ";
}?>
</div>
</form>
    </h4></td>
    </tr>
    <?php 
if(isset($_SESSION['id'])){?>
<form  method="POST">
    <tr>
      <td style="padding: 10px; font-weight: bold;"><h5> Return Duration:</h5></td>
      <td style="padding: 10px;">
      <h6 class="section-title" style='margin-bottom:5px'>I will return on:</h6>

      <input type="date" name='return_date' id='#dateInput'  required> <br> <br>
      <hr>
      <br>
      <span style='padding-right:20px;font-size:14px'>
       Charge rate:
</span>
      <span style='padding-right:10px ;font-size:12px;text-decoration:underline'>(1 Month):25%</span>
      <span style='padding-right:10px ;font-size:12px;text-decoration:underline'>(3 Months):35%</span>
      <span style='padding-right:10px ;font-size:12px;text-decoration:underline'>(6 Months):45%</span>
      <span style='padding-right:10px ;font-size:12px;text-decoration:underline'>
        <span >(1 Year):50%</span>
      </span> 

<span style='padding-left:20px;font-size:14px'>
       Penalties: <span style="font-size:12px;text-decoration:underline">(2x Charge rate)</span>
</span>
    </td>

    </tr>
    <tr>
    <tr>
    <td style="padding: 10px; font-weight: bold;"><h5>Payment:</h5></td>
    <td style="padding: 10px;display:flex;"><div style="margin: 0;font-size:12px">
    <p style="margin: 0;font-size:12px;margin-bottom:2px;">
(Rent 1 Book at a Time) 
</p>
  <button type='submit' name='pay' style='border-radius:5px;background:skyblue;width:118px;height:30px;border:none;cursor:pointer;color:white' id='#pay'>Proceed</button>
</div>

  </form>
<?php 
}else echo '   <td style="padding: 10px; font-weight: bold;"><h5>Payment:</h5></td>
<td style="padding: 10px"><a href="./login.php" style="margin: 0;font-size:12px">Login First:</a>'
  ?>
  <?php if(isset($_POST['pay'])){
$_SESSION['return_date'] = $_POST['return_date'];
?>
<div style='display:flex'>
<hr style='margin-left:20px'>
<hr style='margin-right:20px'>
<form action="message.php?id=<?php echo $row['book_id']?>" style='display:flex;flex-direction:column-reverse;gap:5px' method="POST">
<?php
//it will be created only when payment is made
        $_SESSION['order_auth']=true;

     
//returnDay
$val = dateDiffInDays($today_date,$_SESSION['return_date']);
$numOfReturnDay = $val-19559;

//rentRate
$rate = rentRate($numOfReturnDay);

   //sessionAmountPurchase
   $_SESSION['payment_amt'] = $row['book_price']*($rate/100);

if($numOfReturnDay>0){
?>

<script

src="https://checkout.stripe.com/checkout.js" 

    class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo $row['book_price']*($rate/100)?>"
		data-name="Book Rental"
		data-description="Book For Everyone"
		data-image="./images/logo.png"
		data-currency="usd"
		data-email="<?Php echo $_SESSION['customer_email']?>"
	>	</script>
  <?php
}else   echo "<p style='font-size:14px'>warning: <span style='color:red;font-size:12px'>Please Enter Correct Date</span></p>";

?>
<div>
<p style='color:crimson;margin-bottom:2px'>
    <u>Read Carefully Before Payment</u>
  </p>
  <p style="margin: 0;font-size:12px;">
 Rent rate according to selected date: <?php echo $rate."%"?> <br>
 You need to return the rented book within: <?php echo $numOfReturnDay." "."days"?>
</p>
</div>
</form>
</div>
  <?php
}
?>
  </h6></td>
</tr>
  </tbody>
</table>


</div>
</body>

<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("image-pr", 3);
</script>
<script src="./js/addToCart.js"></script>






