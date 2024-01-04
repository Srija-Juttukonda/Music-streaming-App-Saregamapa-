<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add Admin</h3>
         <br><br>
          
          <?php
              if(isset($_SESSION['add'])){  //checking the session set or not
                echo $_SESSION['add'];   //Display the session Message
                unset($_SESSION['add']);
              }
          
          
          ?>


        <form action="" method="POST">
         <table class="tbl-30">
            <tr>
                <td>Username  </td>
                <td><input type="text" name="user_name" placeholder="Enter Your Username"></td>
                
            </tr>
            <tr>
                <td>First Name  </td>
                <td><input type="text" name="firstName" placeholder="Your First Name"></td>
                
            </tr>
            <tr>
                <td>Last Name  </td>
                <td><input type="text" name="lastName" placeholder="Your Last Name"></td>
                
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" placeholder="Your Last Name"></td>
                
            </tr>
            <tr>
                <td>Password  </td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
         </table>
        </form>
    </div>
</div>

<?php
// Proceess the value from Form and save it in Datebase
// check whether the submit buttom is clicked or not
if(isset($_POST['submit'])){
    // echo "Buttom is clicked";

    //Get the data from form
      $User_Name = $_POST["user_name"];
      $First_Name = $_POST["firstName"];
      $Last_Name = $_POST["lastName"];
      $Email = $_POST["email"];
     $Password = md5($_POST["password"]); // used for password encryption

     //2.SQL Query to save the data in database
     $sql = "INSERT INTO users SET
        username = '$User_Name',
        firstName = '$First_Name',
        lastName = '$Last_Name',
        email = '$Email',  
        password = '$Password'
     ";
     //3. Execute Query and save the data in database
     // it is done in constants.php and that file is attached into menu file to get axcess to all other files
     $res = mysqli_query($con,$sql) or die(mysqli_error());

     //4.Check whether the (Query is exceuted or not)/ data is inserted or not and display appropriate message
     if($res == TRUE){
        // Data inserted
        // echo "Data Inserted";
        //Create Session Variable to Display the mssg
        $_SESSION['add']="<div class='success'>Admin Added Successfully.</div>";
        //redirect page to Manage admin
        header('location: manage-admin.php');
 //free domain and free hostage
 //publishing website on internet and access it and view 

     }
     else{
        //Data is failed to insert
        // echo "Failed to insert Data";

        $_SESSION['add']="<div class='error'>Fail to Add Admin.</div>";
        //redirect page to Manage admin
        header("location:".SETURL.'manage-admin.php');

     }

}

?>