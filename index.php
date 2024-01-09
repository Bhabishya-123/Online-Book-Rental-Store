<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/be1ba39dfe.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Book Rental</title>
    <style>
        *{
        margin:0;padding:0;
      }
    </style>
</head>
<body>
  <?php include_once './includes/navbar.php'?>

    <div class="section-1">
        <div class="Section-1-text-div">
           <h1 class='home-h1' style='margin-top:5%'>Welcome to Book Rental</h1>
            <p class='home-top-p' >You can find out yours book for rent here.</p>
            <a style='margin-top:2%' href="./products.php?type=new" class="btn">Explore Here  <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
        </div>
    </div>
    <?php

if($_SERVER['REQUEST_METHOD'] === 'POST')    {
    include './includes/config.php';

    $sql = $conn->prepare("INSERT INTO message (fname,lname,country,message) VALUES (?,?,?,?)");
 
    //sending value in ??? format will prevent injection
    $sql->bind_param('ssss',$_POST['fname'],$_POST['lname'],$_POST['country'],$_POST['message']);
    if($sql->execute()){
        echo "<h3 style='text-align:center'>Message Sent Successfully...</h3>";
    };
 
    $conn->close();
    $sql->close(); 
}

?>

    <div class="section-2">
        <h2 style='margin-bottom:10px'>Latest Products</h2>
        <!-- <a href="#"><img src="./images/img_2.jpg" alt=""> -->
        <div class="gallery">
           
        <?php
//this will dynamically fetch all books data from a database
include "includes/config.php";
$limit = 10;

$sql = "SELECT * FROM books ORDER BY books.book_id DESC LIMIT {$limit}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
            <div class="image-holder">
                <a href="./purchase.php?id=<?php echo $row['book_id']?>">
                <img class='image' src="admin/upload/<?php echo $row['book_img'] ?>"  alt="book-img">
                </a>
            </div>



<?php }}else { echo "No Books Found"; }
             $conn->close(); 
             ?>

        </div>

    </div>


    <div class="section-4">
        <h2 style="">Featured Brands</h2>
     <div class="brand-container">
            <img class='brand' src="./images/book_logo1.png" alt="">
            <img class='brand' src="./images/book_logo_6.png" alt="">
            <img class='brand' src="./images/book_logo3.png" alt="">
            <img class='brand' src="./images/book_logo_4.png" alt="">
            <img class='brand' src="./images/book_logo_5.png" alt="">
     </div>
    </div>

    <!-- section-5 contact us  -->
    <div class="section-5">
        
              <div style='padding:20px'>
              <h2>Contact Us</h2>
              <p>leave us a message or suggestion:</p>
              </div>

              <div class="column">
                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                  <label for="fname">First Name</label>
                  <input type="text" id="fname" name="fname" placeholder="Your name.." required>
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" name="lname" placeholder="Your last name.." required>
                  <label for="country">Country</label>
                  <select id="country" name="country">
                    <option value="nepal">Nepal</option>
                    <option value="india">India</option>
                    <option value="australia">Australia</option>
                    <option value="canada">Canada</option>
                    <option value="usa">USA</option>
                  </select>
                  <label for="message">message</label>
                  <textarea id="message" name="message" placeholder="Write something.." style="height:170px" required></textarea>
                  <input type="submit" value="Submit">
                </form>
              </div>

    </div>
</body>
</html>

