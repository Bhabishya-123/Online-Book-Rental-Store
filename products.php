<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="https://use.fontawesome.com/be1ba39dfe.js"></script>
        <link rel="stylesheet" href="./css/product_style.css">
        <title>Book Rental</title>
    </head>
    <body>
    <?php include_once './includes/navbar.php'?>


        <div class="section-body">
            <div class="vertical-nav">
                <ul style='display:flex;flex-direction:column'>
                <h4 style='margin:0;padding-top:10px;z-index:3'><div style='display:flex;gap:5px;'> <button class='btn' style='font-size:14px'><a href="./products.php?type=new" style='text-decoration:none;color:white'>New</a></button><button class='btn' style='font-size:14px'><a href="./products.php?type=old" style='text-decoration:none;color:white'>Old</a></button> </div><p>
                   <u > <?php echo $_GET['type']==='new'? 'Rent New Books': 'Rent Old Books'?></u>
                </p></h4>
                    <h4 style='margin-top:0;padding-top:0'><left>Category</left></h4>
                    <li><a href="#Adventure">Adventure</a></li>
                    <li><a href="#Thriller">Thriller</a></li>
                    <li><a href="#Romantic">Romantic</a></li>
                    <li><a href="#Comedy">Comedy</a></li>
                </ul>
            </div>

<div class="gallery-main" style="margin-left:25%;padding:1px 16px;height:1000px;">
                <div class="Adventure" id="Adventure">
                    <h2>Adventure</h2>

                    <div class="gallery">
                        <?php
//this will dynamically fetch all related category data from a database
include "includes/config.php";
$sql = "SELECT * FROM books  where book_type='{$_GET['type']}' AND book_catag='adventure'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
         

            <div class="image-holder">
                            <a style='text-decoration:none;color:black' href="./purchase.php?id=<?php echo $row['book_id']?>">
                            <img class='image' src="admin/upload/<?php echo $row['book_img'] ?>"  alt="adventure-img">
                      
                            <div class="desc">
                                Price : <?php echo $row['book_price'] ?>
                                <br>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <button style='background:grey;color:white;border:none'>Rent</button>
                            </div>      </a>
                        </div>



<?php }}else { echo "No Books Found"; }
             $conn->close(); 
             ?>

                    </div>

                    <!-- Thriller -->

                    <div class="Thriller" id="Thriller">
                        <h2>Thriller</h2>
    
                        <div class="gallery">
                        <?php
//this will dynamically fetch all related category data from a database
include "includes/config.php";
$sql = "SELECT * FROM books  where book_type='{$_GET['type']}' AND book_catag='thriller'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
         

            <div class="image-holder">
                            <a style='text-decoration:none;color:black' href="./purchase.php?id=<?php echo $row['book_id']?>">
                            <img class='image' src="admin/upload/<?php echo $row['book_img'] ?>"  alt="adventure-img">
                      
                            <div class="desc">
                                Price : <?php echo $row['book_price'] ?>
                                <br>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <button style='background:grey;color:white;border:none'>Rent</button>
                            </div>      </a>
                        </div>



<?php }}else { echo "No Books Found"; }
             $conn->close(); 
             ?>
    
    
                        </div>

                        <!-- Romantic -->
                        <div class="Romantic" id="Romantic">
                            <h2>Romantic</h2>
        
                            <div class="gallery">
                            <?php
//this will dynamically fetch all related category data from a database
include "includes/config.php";
$sql = "SELECT * FROM books  where book_type='{$_GET['type']}' AND book_catag='romantic'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
         

            <div class="image-holder">
                            <a style='text-decoration:none;color:black' href="./purchase.php?id=<?php echo $row['book_id']?>">
                            <img class='image' src="admin/upload/<?php echo $row['book_img'] ?>"  alt="adventure-img">
                      
                            <div class="desc">
                                Price : <?php echo $row['book_price'] ?>
                                <br>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <button style='background:grey;color:white;border:none'>Rent</button>
                            </div>      </a>
                        </div>



<?php }}else { echo "No Books Found"; }
             $conn->close(); 
             ?>
        
        
                            </div>

                            <!-- Comedy -->
                            <div class="Comedy" id="Comedy">
                                <h2>Comedy</h2>
            
                                <div class="gallery">
                                <?php
//this will dynamically fetch all related category data from a database
include "includes/config.php";
$sql = "SELECT * FROM books  where book_type='{$_GET['type']}' AND book_catag='comedy'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
         

            <div class="image-holder">
                            <a style='text-decoration:none;color:black' href="./purchase.php?id=<?php echo $row['book_id']?>">
                            <img class='image' src="admin/upload/<?php echo $row['book_img'] ?>"  alt="adventure-img">
                      
                            <div class="desc">
                                Price : <?php echo $row['book_price'] ?>
                                <br>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <button style='background:grey;color:white;border:none'>Rent</button>
                            </div>      </a>
                        </div>



<?php }}else { echo "No Books Found"; }
             $conn->close(); 
             ?>
            
            
                                </div>
        
                                
                            
                </div>
            </div>

            <br>

            <right> <a href="./index.php" class="btn">Back <i class="fa fa-arrow-right" aria-hidden="true"></i> </a></right>
      

        </div>


    </body>

</html>