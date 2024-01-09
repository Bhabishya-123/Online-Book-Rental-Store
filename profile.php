<?php
  //today date
  $today_date =  date("Y/n/j/"); 
  session_start();
  include './includes/config.php';
  //deleting returned items
if(isset($_POST['deleteReturned'])){
   session_start();
  include_once './includes/config.php';
$sql = "DELETE FROM rentorders where cid={$_SESSION['id']} AND delivered_status='delivered' AND returned_status='returned'"; //sql query for deleting
$sql1 = "DELETE FROM return_request where customer_id={$_SESSION['id']}  AND returned_status='returned'"; //sql query for deleting
$conn->query($sql); //executing sql query
$conn->query($sql1); //executing sql query

header("Location:./profile.php?action=ReturnedBookDeletedSuccessfully");
}
//sending return request
if(isset($_POST['send_request'])){
  $sql = "SELECT * FROM return_request where customer_id='{$_SESSION['id']}'
  AND book_id = '{$_GET['bid']}' AND return_date='{$_POST['r_date']}' AND quantity='{$_POST['quant']}'";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
  
  $sql = "INSERT INTO return_request (
    customer_id,
    book_id,
    return_date,
    requested_date,
    quantity
  ) VALUES(
    {$_SESSION['id']},
    {$_GET['bid']},
    '{$_POST['r_date']}',
    '{$today_date}',
    {$_POST['quant']}
    )";
  
  $conn->query($sql);
  $conn->close();
  echo "<script type='text/javascript'>
  alert('Your request has sent to our admin');
  window.location.href = './profile.php?id=" . $_SESSION['id'] . "';
  </script>";
}else{
  echo "<script type='text/javascript'>
  alert('Your request has been already sent to admin wait for our call');
  window.location.href = './profile.php?id=" . $_SESSION['id'] . "';
  </script>";

}

}
   
?>

<?php 
include_once './includes/navbar.php';
   //restriction for unauthorized access
   if(!(isset($_SESSION['id']))){
    header("location:login.php?Unathorized");
    die();
   }
   if(isset($_POST['update'])){
    $sql6 = "UPDATE customer 
             SET  customer_name= '{$_POST['name']}' ,
                  customer_email= '{$_POST['email']}' ,
                  customer_pwd= '{$_POST['pwd']}' ,
                  customer_phone= '{$_POST['phone']}' ,
                  customer_address= '{$_POST['address']}' 
             WHERE customer_id= '{$_SESSION['id']}' ";

    $conn->query($sql6);   
    echo "<h3 style='text-align:center;position:absolute;top:70px;left:11%;padding:0'>Your Profile Updated Successfully</h3>";
   }

   $sql ="SELECT * FROM  customer WHERE customer_id='{$_SESSION['id']}';";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $_SESSION['role'] = $row['customer_role'];
   $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <style>
           *{
        margin:0;padding:0;
      }
      /* .fa {
    color: grey !important;
} */
      .facross{
    color:  #DC143C !important;
}
      .fadeliver{
    color:  green !important;
}
        .profileCont{
            display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        gap:10px;
        }
        input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 300px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
  }

  input:focus {
    outline: none;
    border-color:skyblue;
  }
    </style>
</head>
<body>
<div class='profileCont'>

  <?php
  if(isset($_GET['id']) || isset($_GET['action'])){
?>
<div style="margin-top:60px;position:relative">
<div style='text-align:center'>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<div>
<div style='border:1px solid skyblue;width:100%;text-align:center'></div>
   <h2 >Ordered History</h2>

<span style='margin-right:5px'><b>Delete Returned Books</b> 
</span>
<div style='text-align:center;margin:20px;display:flex;justify-content:center'><input name='deleteReturned' type='submit' value='Delete' class="btn btn-danger" style="background:#DC143C;"></input>
  </div>
<div style='border:1px solid skyblue;width:100%;text-align:center'></div>

</div>
</form>

<div style='display:flex;flex-direction:column;justify-content:center;flex-wrap:wrap;align-items:center'>
<table style="border-collapse: collapse; text-align: center; ">
  <thead>
    <tr>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      S.N
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Image
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Name
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Quantity
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Total Price
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Orders Date
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Return Date
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Day Left
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
      Delivered
      Status
      </th>
      <th style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
Return Settlement    </th>
<th style='background-color: skyblue; padding: 10px; font-size: 18px; text-align: center'>Returned Status</th>

    </tr>
  </thead>
  <tbody>
 <?php
//this will dynamically fetch data from a database and show all the rented books
include "includes/config.php";

$sql10 = "SELECT * FROM rentorders where cid='{$_SESSION['id']}'";
$result10 = $conn->query($sql10);

$sn=0;
if ($result10->num_rows > 0) {
  
while($row10 = $result10->fetch_assoc()) {
   $sn++;
   $sql11 = "SELECT * FROM books where book_id='{$row10['bid']}' ";
$result11 = $conn->query($sql11);
$row11 = $result11->fetch_assoc();
?>
    <tr>
    <form action='<?php echo $_SERVER['PHP_SELF']?>?bid=<?php echo $row10['bid']?>' method='post'>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5><?php echo $sn  ?></h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><img class='image' style="height:50px;width:50px"  src="admin/upload/<?php echo $row11['book_img'] ?>"  alt="book-img"></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5><?php echo $row11['book_title']  ?></h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><input type="text" name='quant' value='<?php echo $row10['quantity']  ?>' readonly style='outline:none;border:none;width:100%;background:none'></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5>Rs <?php echo $row10['price']*$row10['quantity']  ?></h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5><?php echo $row10['date']  ?></h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><input type='date' name='r_date' value='<?php echo $row10['return_date']  ?>' readonly style='outline:none;border:none;width:100%;background:none'></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5><?php 
            $dayToReturn = dateDiffInDays($row10['return_date'],$today_date);
            echo $dayToReturn-19559;
      ?></h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5><?php echo $row10['delivered_status']  ?>
      <?php echo ($row10['delivered_status']=='pending'?'<i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>':'<i class="fa fa-lg fa-check-circle fadeliver" aria-hidden="true"></i>')?>

</h5></td>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5>
      <?php if($row10['delivered_status']==='delivered' AND $row10['returned_status']==='pending') echo "<button name='send_request' type='submit' style='background:grey;border:none;font-size:12px'  class='btn'>return request</button>"?>
       <?php echo($row10['returned_status'])==='returned'?"<p style='background:grey;border:none;font-size:12px;cursor:pointer'  class='btn' readonly>success <i class='fa-solid fa-check'></i></p>":' '?>

</h5></td>

<td style="padding: 10px; width:30%; font-weight: bold;"><h5>
<?php echo ($row10['returned_status']=='pending'?'<i class="fa-solid fa-circle-xmark fa-lg facross"></i>
':'<i class="fa-solid fa-check-double fadeliver fa-lg"></i>
')?>
</h5>
</td>
</form>
</tr>
<?php }}else { echo "No Results Found"; 
}
             $conn->close(); 
             ?>

</tbody>
</table>
 </div>
</div>
<?php
  }else{
    ?>
      <table style="border-collapse: collapse; text-align: left;margin-top:60px ">
  <thead>
    <tr>
      <th colspan="2" style="background-color: skyblue; padding: 10px; font-size: 18px; text-align: center;">
        Personal Details
      </th>
    </tr>
  </thead>
  <tbody>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5> Name:</h5></td>
      <td style="padding: 10px; width:50%;"><input type='text' name='name' value="<?php echo $row['customer_name'] ?>" style="margin: 0;position:relative">
      <?php 
        if($_SESSION['role'] ==='admin') {
           echo "<span class='btn btn-medium' style='background:aliceblue'>"."<a id='admin' href='./admin/index.php'>"."Admin"."</a>"."</span>";
        }
    ?>
    </input></td>
    </tr>
    <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5> Email:</h5></td>
      <td style="padding: 10px; width:50%;"><input type='email' name='email' value="<?php echo $row['customer_email'] ?>" style="margin: 0;"></input></td>
    </tr>
    <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5> Password:</h5></td>
      <td style="padding: 10px; width:50%;"><input type='text' name='pwd' value="<?php echo $row['customer_pwd'] ?>" style="margin: 0;"></input></td>
    </tr>
    <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5>Phone:</h5></td>
      <td style="padding: 10px; width:50%;"><input type='number' maxlength='10' name='phone' value="<?php echo $row['customer_phone'] ?>" style="margin: 0;"></input></td>
      <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5>Address:</h5></td>
      <td style="padding: 10px; width:50%;"><input type='text' name='address' value="<?php echo $row['customer_address'] ?>" style="margin: 0;"></input></td>
    </tr>
    </tr>
    <tr>
      <td style="padding: 10px; width:30%; font-weight: bold;"><h5> Action:</h5></td>
      <td style="padding: 10px; width:50%;"><input name='update' type='submit' value='Update'></input></td>
    </tr>
    </form>
  </tbody>
</table>
<div style='border:1px solid skyblue;width:50%;text-align:center'></div>
<h3 style='text-align:center'> <a style='' href="./profile.php?id=<?php echo $_SESSION['id']?>">Book Rented History</a> </h3>
<div style='border:1px solid skyblue;width:50%;text-align:center'></div>
<?php
  }?>
</div>
</body>
</html>

<?php

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


