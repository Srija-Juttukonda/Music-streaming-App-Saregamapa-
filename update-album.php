<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h3>Update Album</h3> 
       <br><br>

       <?php
       //check whether the id is set or not
       if(isset($_GET['id'])){
        //get the ID and all other datails
        $id=$_GET['id'];
        //Create SQL Query to get all other details
        $sql="SELECT * FROM albums WHERE id=$id";
        //Exceute the query
        $res=mysqli_query($con,$sql);

        //count the rows to check to check the id is valid or not
        $count= mysqli_num_rows($res);
        if($count==1){
            //Get all the data
            $row=mysqli_fetch_assoc($res); //contains array of values
            $title=$row['title'];
            $current_image=$row['artworkPath'];
            
       }
        else{
            //redirect to manage category with mssg 
            $_SESSION['no-category-found']="<div class='error'>Category not Found</div>";
            header("location:manage-album.php");
        }

       }
       else{
        //redirect to manage category
        header("location:manage-admin.php");
       }
       
       ?>

       <form action="" method="POST" enctype="multipart/form-data">
       <table class="tbl-30">
         <tr>
            <td>Title</td>
             <td><input type="text" name="title" value="<?php echo $title;?>"></td>
         </tr>
         <tr>
            <td>Current image</td>
            <td>
                <?php
                if($current_image != ""){
                    //Display the image
                    ?>
                    <img src="<?php echo "http://localhost/GitHub/music-streaming-project/"?><?php echo $current_image; ?>" alt="" width="120px" height="75px">
                    <?php
                }
                else{

                    //Display the message
                    echo "<div class='error'>Image Not Add.</div>";
                }
                
                ?>

            </td>
         </tr>
         <tr>
            <td>New Image</td>
            <td><input type="file" name="image"></td>
         </tr>

         

         <tr>
            <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">    

            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
        </td>

         </tr>

       </table>
       </form>
    <?php
      if(isset($_POST['submit'])){
        // echo "Clicked";

        //get all the values from our form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
       

        //2.Updating the New Image if Selected
        //check whether image selected or not
        if(isset($_FILES['image']['name'])){
            //Get the image details
            $image_name=$_FILES['image']['name'];

            //Check whether the image is available or not
            if($image_name!=""){
                //image available
                //upload the new image 

                // $txt = end(explode('.',$image_name)); //only last value

                // //rename the image
                // $image_name="myalbum_Images_".rand(000,999).'.'.$txt;  //myfood_category_1.jpg



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
                    header("location:manage-album.php");
                    //stop the proccess bcoz to not to add/insert the data into database 
                    die();  //
                 }

                //remove the current_image if available
                if($current_image!=""){
                    $remove_path = "$current_image";
                $remove=unlink($remove_path);

                //check whether the image is removed or not
                //if failed to remove then display the message and stop the proccess
               if($remove==false){
                $_SESSION['failed-remove']="<div class='error'>Failed to remove current image</div>";
                header("location:manage-album.php");
                die();  //stop the proccess
               }

                }
                


            }
            else{
                $image_name=$current_image;
            }
        }
        else{

            $image_name=$current_image;
        }



        //3.Updata the database
        $sql2 = "UPDATE albums SET
              title = '$title',
              image_name='$image_name'
              WHERE $id =id
              ";
              
              //Exceute the query
             $res2 = mysqli_query($con,$sql2); 
           
        //4.Redirect to Manage Category with message
        //check whether query excecuted or not
        if($res2==TRUE){
            //excecuted and updated
            $_SESSION['update']="<div class='success'>Category Updated successfully</div>";
            header("location:manage-album.php");

        }
        else{

            $_SESSION['update']="<div class='error'>Failed to Update Category</div>";
            header("location:manage-album.php");

            //failed to update
        }



      



      }
    
    
    ?>






    </div>
</div>



<!-- <?php include('footer.php');?> -->