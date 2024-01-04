<?php


      // Include constnts.php file here
      include('includes/config.php');

     //1. get the id of the Admin to be deleted
     echo  $id = $_GET['id'];

     //2.Create SQL Query to Delete Admin
     $sql = "DELETE FROM users WHERE id=$id";

     //Exceute the Query
     $res= mysqli_query($con,$sql);

     //Check whether the query executed Successfully or not
     if($res==TRUE){

        //Query Executed successfully
        // echo "Admin Deleted Successfully";
        //Create Session Variable to Display Message
        $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin Page
        header("location:manage-admin.php");

     }
     else{
        
        // Fail to Delete Admin
        // echo "Failed to delete the Admin";
        $_SESSION['delete']="<div class='error'>Failed to Delete the Admin Try the Later again.</div>";
        header("location:".SETURL.'manage-admin.php');
     }

     //3.Redirect to Manage Admin page with message(success/error)





?>