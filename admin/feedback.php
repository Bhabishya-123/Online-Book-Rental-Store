
<?php 
    include_once('./includes/navbar.php');
    include_once('./includes/restriction.php');
    if(!(isset($_SESSION['role']))){
      header("Location:login.php?unauthorizedAccess");
    }
 ?>

<h4 class='adm-h4'>Feedback From Visitors</h4>
<br>
<br>

<?php
  include "includes/config.php";
     
        /* define how much data to show in a page from database*/
        $limit = 4;
        if(isset($_GET['page'])){
          $page = $_GET['page'];
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }else{
          $page = 1;
          switch($page){
            case 1: $sn = 0; break;
            case 2: $sn = 4;break;
            case 3: $sn = 8; break;
            case 4: $sn = 12; break;
            case 5: $sn = 16; break;
            case 6: $sn = 20; break;
          }
        }
        //define from which row to start extracting data from database
        $offset = ($page - 1) * $limit;

$sql = "SELECT * FROM message LIMIT {$offset},{$limit}";
$result = $conn->query($sql);
if ($result->num_rows > 0) { ?>
    
    <div class="table-cont">
    <table>
    <tr>
    <th class="short">S.N</th>
    <th class="medium">First Name</th>
    <th class="medium">Last Name</th>
    <th class="medium">Country</th>
    <th class="short">Message</th>
    </tr>
<?php 
// output data of each row
while($row = $result->fetch_assoc()) {
    $sn = $sn+1;
?>
<tr>
    <td><?php echo $sn ?></td>
    <td><?php echo $row["fname"] ?></td>
    <td><?php echo $row["lname"] ?></td>
    <td><?php echo $row["country"] ?></td>
    <td><?php echo $row["message"] ?></td>
</tr>

<?php }}else { echo "0 results"; }
             $conn->close(); 
             ?>

</table>
</div>

<!--Pagination-->
<?php
                include "includes/config.php"; 
               // Pagination btn using php with active effects 

                $sql1 = "SELECT * FROM message";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_message = mysqli_num_rows($result1);
                  $total_page = ceil($total_message / $limit);

                  echo "<div class='pagination'>";
          
                  for($i=1; $i<=$total_page; $i++){

                    //important this is for active effects that denote in which page you are in current position
                    if($page==$i){
                      $active = "active";
                    }else{
                      $active = "";
                    }

                        echo "<a href='feedback.php?page={$i}' class='{$active}'>".$i."</a>";
                  }
            
                }
                echo "</div>";
                  ?>
<br>
