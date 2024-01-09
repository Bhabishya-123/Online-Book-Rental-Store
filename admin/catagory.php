<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
        header("Location:login.php?unauthorizedAccess");
      }
 ?>
<h4 class='adm-h4'>Book Category</h4>
<br>
<br>


<div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="large">Category</th>
    <th class="short">Total Post</th>

    </tr>

<?php
  include "includes/config.php";

$catagory_list = ['adventure','thriller','romantic','comedy'];

for($i=0; $i<sizeof($catagory_list); $i++){
    $sn = $i+1;
    $catagory = $catagory_list[$i];
    $sql = "SELECT * FROM books WHERE book_catag= '{$catagory}' ";
    $result = $conn->query($sql);
    $total_post = $result->num_rows;
    
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row["book_catag"] ?></td>
    <td><?php echo $total_post?></td>

</tr>
   <?php break; ?>
<?php }

}//loop end 
?>


</table>
</div>

