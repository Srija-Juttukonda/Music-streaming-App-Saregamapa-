<?php include('menu.php');?>


<div class="main-content">
    <div class="wrapper">
       <h3>Upadate Admin</h3>
        <br><br>

        <?php
         //Get the ID of Selected admins
          $id=$_GET['id'];


         //2.Create SQL Query to get the Details
         $sql="SELECT * FROM users WHERE id=$id";

         //Exceute the Query
         $res=mysqli_query($con,$sql);

         //Check whether the query is exceuted or not
         if($res== TRUE){
            //Check whether the data is available or not
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count==1){
                //Get the Details
                //echo "Admin Available";
                $row=mysqli_fetch_assoc($res);
                $username=$row['username'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row['email'];
            }
            else{

                //Redirect to manage Admin page
                header("location:manage-admin.php");
            }
         }
        
        
        ?>

       <form action="" method="POST">
          <table class="tbl-30">
          <tr>
                <td>Username </td>
                <td><input type="text" name="username" placeholder="Enter the Username" value="<?php echo $username;?>"></td>
            </tr>
            <tr>
                <td>First Name </td>
                <td><input type="text" name="firstName" placeholder="Enter Your first-Name" value="<?php echo $firstName;?>"></td>
                
            </tr>
            <tr>
                <td>Last Name </td>
                <td><input type="text" name="lastName" placeholder="Enter Your Last-Name" value="<?php echo $lastName;?>"></td>
                
            </tr>
            <tr>
                <td>Email </td>
                <td><input type="email" name="email" placeholder="Enter Your Email" value="<?php echo $email;?>"></td>
                
            </tr>
            <tr>
             <td colspan="2">
                <input type="hidden" name="id" value = "<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
             </td>

            </tr>

          </table>
       </form>
    </div>
</div>
<?php
   // Check whether the submit button clicked or not
   if(isset($_POST['submit'])){
    //echo "Button is clicked";
    //Get all the values from form tp update
    $id=$_POST['id'];
    $username=$_POST['username'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    // Create SQL Query to update Admin
    $sql="UPDATE users SET
    username='$username',
    firstName = '$firstName',
    lastName='$lastName',
    email='$email'
    WHERE id='$id'
    ";


    //Excecute the Query
    $res=mysqli_query($con,$sql);

    //Check Whether the Query excecuted or not
    if($res==TRUE){
        $_SESSION['update']="<div class='success'>Admin updated Successfully. </div>";
        header("location:manage-admin.php");
    }
    else{

        $_SESSION['update']="<div class='error'>Failed to Update the Admin . </div>";
        header("location:manage-admin.php");
    }
    }
   


?>