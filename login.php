<?php include('includes/config.php');?>
<html>
    <head>
        <title>Login - Music System</title>
        <link rel="stylesheet" href="admin.css">
    </head>

    <body class="container">
        
     <div class="login">
        <h3 class="text-center">Login</h3>
    <br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
        
        ?>
        <br>
        <!-- LoginForm Starts here -->
        <form action="" method="POST" class="text-center">
       Username: <br>
       <input type="text" name="username" placeholder="Enter Admin Name"><br><br>
       Password: <br>
       <input type="password" name="password" placeholder="Enter Password"><br><br>

       <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

        </form>


        <!-- Login Form ends here -->



        <p class="text-center">Created By - <a href="www.nandiniamaravadi.com">Nandini Amaravadi</a></p>
     </div>
    </body>
</html>

<?php

//Check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //Procceess the login
    //1.Get the data from Login form
    //  $username=$_POST['username'];
     $username=mysqli_real_escape_string($con,$_POST['username']);

     $password=$_POST['password'];
    //  $password=mysqli_real_escape_string(md5($conn,$_POST['password']));



    //2.sql to check whether the user with username and password exists or not
    $sql="SELECT * FROM admin WHERE admin_name='$username' AND password='$password'";
    $res = mysqli_query($con,$sql);

    //Count rows to check whether user exists or not
    $count = mysqli_num_rows($res);
    if($count == 1){
   
        //Your are allowed to enter
        $_SESSION['login']="<div class='success '>Login Successfully</div>";
        $_SESSION['user']=$username; // Is used to check whether user logged in or not 
        //redirect to home page/Dashboard
        header("location:manage-admin.php");

    }
    else{

        //Check Your credentials
        $_SESSION['login']="<div class='error text-center' >Username or Password Doesnot match</div>";
        header("location:'login.php");


    }
}

?>