
<?php
include './includes/config.php';
include_once './includes/navbar.php';
 //1st step(i.e connection) done through config file
if(isset($_POST['login'])){

    if(empty($_POST['email'])){
           echo "<h4 id='error_login'>Enter email</h4>";
    }

    if(empty($_POST['pwd'])){
        echo "<h4 id='error_login'>Enter password</h4>";
 }

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password =mysqli_real_escape_string($conn,$_POST['pwd']);

$sql ="SELECT * FROM  customer WHERE customer_email='{$email}';";
$result = $conn->query($sql);

if($result->num_rows==1){ //if any one data found go inside it
    $row = $result->fetch_assoc();
    if($password == $row['customer_pwd']){

    //session will be created only if users email and passwords matched
	$_SESSION['id'] = $row['customer_id'];
	$_SESSION['customer_role'] = $row['customer_role'];
	$_SESSION['customer_name'] = $row['customer_name'];
	$_SESSION['customer_email'] = $row['customer_email'];
header("Location:./profile.php");
            // put exit after a redirect as header() does not stop execution
            exit;}else{
                echo " <h4 style='position:absolute;left:45%;z-index:4;top:70%;'>Incorrect password</h4>";//as user get inside if statem if userEmail matched
            }


}else{
    if($_POST['email']){ //it means it will run if email field is filled
    echo "<h4 style='position:absolute;left:42%;z-index:4;top:70%;'>(unavailable) please signup first</h4>";
    }
}
}//end of 1st ifstatement

?>


<head>
<link rel="stylesheet" href="./css/login.css">
<script src="https://use.fontawesome.com/be1ba39dfe.js"></script>
    <link rel="stylesheet" href="./css/style.css">
<title>Login </title>
<style>
       *{
        margin:0;padding:0;
      }
</style>
</head>
<body>
  <body>
    <div class="login-page">
      <div class="form">
        <div class="login">
          <div class="login-header">
            <h3>LOGIN</h3>
            <p>Please enter your credentials to login.</p>
          </div>
        </div>
        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?> " method="post">
          <input type="email" name='email' placeholder="Email" required/>
          <input type="password" name='pwd' placeholder="Password" required/>
          <button type='submit' name='login'>Login</button>
        </form>
        <p class="message">Not registered? <a href="./Register.php">Create an account</a></p>
      </div>
    </div>
</body>
</body>
