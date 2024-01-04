<?php include('menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Manage Album</h3>


    <!-- Buttom to add category -->
    <br>
    <?php
         if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         }
         if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
         }
         if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
         }
         if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
            
         }
         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
         if(isset( $_SESSION['upload'])){
            echo  $_SESSION['upload'];
            unset( $_SESSION['upload']);
         }
         if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
         }
         
    ?>
    <br><br>



         <a href="add-album.php" class="btn-primary">Add Album</a>
         <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Image</th>                 
                    <th>Actions</th>
                </tr>
                  
                <?php
                  //Query to get all category from database
                    $sql = "SELECT * FROM albums";

                    //Exceute the query
                    $res=mysqli_query($con,$sql);

                    //Count the rows
                    $count = mysqli_num_rows($res);

                    //Create serial variable
                    $sn=1;

                    //check whether the data in database or not
                    if($count>0){
                        //we have data in database
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['artworkPath'];
                            ?>
                <tr>
                   
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>

                    <td>
                        <?php 
                        
                        //Check image name is available or not
                        if($image_name!=""){
                            //display the image
                            ?>
                            <img src="<?php echo "http://localhost/GitHub/music-streaming-project/".$image_name;?>" width="100px" height="75px">
                            <?php
                        }
                        else{
                            //display the mssg
                            echo "<div class= 'error'>Image not added</div>";
                        }
                        
                        ?>
                    </td>                              

                    <td>
                    <a href="update-album.php?id=<?php echo $id;?>" class="btn-secondary">Update Album</a>
                        <a href="delete-album.php ?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Album</a>
                        <!-- get method is used -->
                    </td>
                </tr>
                            
                            <?php
                        }

                    }
                    else{
                        //we donot have the data
                        //we'll display the message inside the table
                        ?>
                        <tr>
                            <td colspan="6" ><div class="error">No Category Added.</div></td>
                        </tr>

                        <?php

                    }
                ?>

                
                
            </table> 
  </div> 
</div>

<!-- <?php include('footer.php'); ?> -->