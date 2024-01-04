<?php include("menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h3>Add Category</h3>
         <br>

         <?php
         if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         } 
         if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
         }
    ?>
    <br>

         <!-- Add Category starts -->
         <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" placeholder="Album Title"></td>
            </tr>

            <tr>
                <td>Select Image</td>
                <td>
                    <input type="file" name="image" value="image">
                </td>
            </tr>
            <tr>
                <td>Artist</td>
                <td><input type="text" name="artist" placeholder="artist"></td>
            </tr>

            <tr>
                <td colspan=2>
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>

           
            
          </table>

         </form>

         <!-- Add Category ends-->
         <?php
          //Check whether submit buttom is clicked or not
          if(isset($_POST['submit'])){
            // echo "Clicked";

            //1.Get the value from the category form
            $title = $_POST['title'];
            $artist=$_POST['artist'];

            // check whether the image selected or not and set the value for image name accordingly
            //print_r($_FILES['image']); // used print_r bcoz echo doesn't give the arry value

            //die();//Break the code here

            if(isset($_FILES['image']['name'])){
               
                //to upload image we need image name,source path and destination path
                $image_name=$_FILES['image']['name'];
                

                //Renaming the image(auto rename our image)
                //get the extension of our image (.jpg,.png,.gif,etc) "special.food.jpg"

                //Upload the image only if image is selected
                
                 if($image_name !=""){

                    $txt = end(explode('.',$image_name)); //only last value

                //rename the image
                $image_name="myfood_Category_".rand(000,999).'.'.$txt;  //myfood_category_1.jpg



                $source_path=$_FILES['image']['tmp_name'];

                $destination_path="$image_name"; 

                 //upload the image
                 $upload=move_uploaded_file($source_path,$destination_path);

                 //Check whether the image uploaded or not
                 //And if the image not uploaded we will stop the proccess redirect with error mssg
                 if($upload==FALSE){
                    //set mssg
                    $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                    //redirect to add category page
                    header("location:add-album.php");
                    //stop the proccess bcoz to not to add/insert the data into database 
                    die();  //
                 }


                 }
                


            }
            else{
                //don't upload the image set image_name as blank
                $image_name="";
            }


            //2.Create sql query to insert Category into database
            $sql = "INSERT INTO albums SET
            title='$title',
            artworkPath='$image_name',
            artist='$artist'
            
            ";

            //3.Exceute the query
            // $res = mysqli_query($conn,$sql2)
            $res=mysqli_query($con,$sql);

            if($res==TRUE){
                //Query executed and category added
                $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
                header("location:manage-album.php");
            }
            else{
                $_SESSION['add']="<div class='error'>Failed to add Category</div>";
                header("location:manage-album.php");

            }
          }
         
         
         ?>

    </div>
</div>




<!-- <?php include("footer.php"); ?> -->