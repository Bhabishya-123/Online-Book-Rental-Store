<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
 <head>
     <style>
         .addpost{
             width:40%;
             position:absolute;
             top:14%;             left:29%;
             background-color:rgb(60, 124, 197);
             box-shadow:2px 2px 3px 2px skyblue;
             font-size:20px;
             font-weight:bold;
             text-align:center;
         }

     </style>
 </head>

 <h4 class='adm-h4'>Add Book</h4>
 <div class="addpost">
  <!-- Form -->
  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                     
                         <div><label for="post_title">Name</label></div> 
                          <input style="width:80%; height:35px" type="text" name="prod-title" autocomplete="off" required> <br>
                    
                          <div> <label for="product-author">Author</label></div>
                          <input style="width:80%; height:35px" type="text" name="prod-author"  value="" required />
                          
                          <div> <label for="product-price">Price</label></div>
                          <input style="width:80%; height:35px" type="number" name="prod-price"  value="" required />
                          
                     
                         <div> <label for="catagory">Category</label></div>
                          <select style="width:80%;height:50px" name="prod-category" value="">
                            <option value="adventure" selected>Adventure</option>
                            <option value="thriller">Thriller</option>
                            <option value="romantic">Romantic</option>
                            <option value="comedy">Comedy</option>
                          </select>  
                          <div><label for="type"> Type</label> <br></div>
                          <select style="width:80%;height:50px" name="prod-type" value="">
                            <option value="new">New</option>
                            <option value="old">Old</option>
                          </select>  <br>
                          <div><label for="description"> Description</label></div>
                          <textarea rows='1' cols='1' style="width:80%;" name="prod-desc"  required></textarea>  
                    
                          <div> <label for="product-date">Date of Publication</label></div>
                          <input style="width:80%; height:35px" type="text" name="prod-date"  value="" required />
                          
                        
                        
                          <div > <label  for="image-post">Image</label>       
                          <input style="width:50%;" name="book-img" type="file"  required>
                   
                       
                      <input style="width:100px;margin-top:5px" type="submit" name="submit"  value="Save" required /></div>
                  </form>
                  <!--/Form -->
 </div>




