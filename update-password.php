<?php include("menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h3>Change Password</h3>
        <br><br>
        <?php
         if(isset($_GET['id'])){
            $id=$_GET['id'];
         }
        
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Current password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>



        </form>






    </div>
</div>
<?php
 // Check Whether the submit button clicked or not
  if(isset($_POST['submit'])){
    // echo "Clicked";

    //1.Get the data from Form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //2.Check whether the user with current ID and Current Passord Exits or not
    $sql="SELECT * FROM users WHERE id=$id AND password='$current_password'";

    //Excecute The Query
    $res = mysqli_query($con,$sql);

    if($res == TRUE){
        $count = mysqli_num_rows($res);

        if($count == 1){
            // The user exist password can change
            // echo "User Exists";
            //3.Check Whether the new password and confirm password match or not
            if($new_password == $confirm_password){
                //Update the password
                // echo "Password-Match";
                $sql2="UPDATE users SET
                password='$new_password'
                WHERE id=$id
                ";
                $res = mysqli_query($con,$sql2);
                if($res==TRUE){
                    $_SESSION['change pwd']="<div class='success'>Password Changed Successfully</div>";
                header("location:manage-admin.php");
                }
                else{
                    $_SESSION['change pwd']="<div class='error'>Failed to change password</div>";
                    header("location:manage-admin.php");
                }
            }
            else{

                //redirct to manage admin with error mssg
                $_SESSION['password-not-match']="<div class='error'>Password Not Match</div>";
                header("location:manage-admin.php");

            }
        }
        else{
            //USer does not exist Set mssg and redirect
            $_SESSION['user-not-found']="<div class='error'>The Password Doesnot Exist.</div>";
            //Redirect the mssg
            header("location:manage-admin.php");

        }
    }
    // else{
    //     echo "Recheck the password again";
    // }

    

    //4.Change Password if all above is true



  }


?>
