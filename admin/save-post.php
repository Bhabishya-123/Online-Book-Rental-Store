<?php
include "includes/config.php";
if(isset($_FILES['book-img'])){
  echo "ok";
  $file_name = $_FILES['book-img']['name'];
  $file_size = $_FILES['book-img']['size'];

  $file_tmp = $_FILES['book-img']['tmp_name']; 
  $file_type = $_FILES['book-img']['type'];
  $tmp = explode('.',$file_name);
  $file_ext = end($tmp);
  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    echo "This extension isn't allowed , please choose a jpg,jpeg or png file.";
    die();
  }
  else if($file_size >= 2097152){
    echo "file size must be less 2mb";
    die();
  }
  else{
    $error = false;
    move_uploaded_file($file_tmp,"upload/".$file_name);
  }
}

if($error===false){
  session_start();
  $sql="INSERT INTO books 
                    (book_catag,book_title,book_price,book_desc,book_date,book_img,book_author,book_type)
             VALUES ('{$_POST['prod-category']}','{$_POST['prod-title']}',{$_POST['prod-price']},'{$_POST['prod-desc']}','{$_POST['prod-date']}','{$file_name}','{$_POST['prod-author']}','{$_POST['prod-type']}');";
  $result = $conn->query($sql);
  $conn->close();
  header("location:index.php?bookAddedSuccessfully");
 }
    ?>

