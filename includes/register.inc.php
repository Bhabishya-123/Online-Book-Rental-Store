
<?php


if(isset($_POST['submit'])){
   
    //ACCESSING all the input value from its name(key) given in form through its post associative array
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $pwd = $_POST['pwd'];

    
    //1st step(i.e connection) done through config file
    require_once 'config.php';
    require_once 'registerFn.inc.php';

//error handler done by using diff functions

//2nd checking if user entererd uid is appropriate or not
if(invalidPhone($number) == true){
    header("location: ../register.php?error=enterValidNumber");
    exit();
}

//3rd checking if user entererd email is proper or not
if(invalidEmail($email) ==true){
    header("location: ../register.php?error=invalidemail");
    exit();

}



//finally creating user in database incase all above condition got true
createUser($name,$email,$address,$pwd,$number);
}//if end

else{
    /* This is to redirect the browser */
    header("location: ../register.php");
    exit("some errors");
}//else end
