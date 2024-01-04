<?php

include('includes/config.php');

// echo "Delete php";
  //check whether the id and image_name value or set or not
//   echo  $image_name = $_GET['image_name'];
  if(isset($_GET['id']) && isset($_GET['image_name'])){

    //Get the value 
    // echo "Get value and delete";
    $id = $_GET['id'];
    $image_name=$_GET['image_name'];

    //Remove the first physical image file 
    if($image_name!=""){
        //remove the image
        $path=$image_name;
        //Remove the image
        $remove=unlink($path);// used to remove the image from folder
        //if failed to remove the image then add an error message and stop the process
        if($remove==FALSE){
            //set the session message
            $_SESSION['remove']="<div class='error'>Fail to Remove Category Image.</div>";

            header("location:manage-album.php");
         //stop the process
         die();
          

        }
        
    }
    //SQL Query to delete data from database
    $sql="DELETE FROM albums WHERE id=$id";

    //Delete data from database
    $res = mysqli_query($con,$sql);

    //Check whether the data is delete from database or not
    if($res==TRUE){
        //set success mssg and redirect it
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
        //redirect to manage category page with message
        header("location:manage-album.php");
    }
    else{
        $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";
        header("location:manage-album.php");
    }


    

  }
  else{

    //redirect it to manage category page
    header("location:".SETURL."manage-category.php");
   

  }