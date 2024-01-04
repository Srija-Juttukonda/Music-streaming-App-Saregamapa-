<?php include('menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h3>Manage Songs</h3>


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



         <a href="add-songs.php" class="btn-primary">Add Songs</a>
         <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Songs</th>                 
                    <th>Actions</th>
                </tr>
                  
                <?php
                  //Query to get all category from database
                    $sql = "SELECT * FROM songs";

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
                            $song_name=$row['path'];
                            ?>
                <tr>
                   
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>

                    <td>
                        <?php 
                        
                        //Check image name is available or not
                        if($song_name!=""){
                            //display the image
                            ?>

                            <?php
                            $URL="http://localhost/GitHub/music-streaming-project/";
?>
                            <audio controls>
                            <source src="<?php echo $URL. $song_name; ?>" type="audio/mp3">
                            Your browser does not support the audio element.
                          </audio>                     
                          

<?php

                        }
                        else{
                            //display the mssg
                            echo "<div class= 'error'>Song not added</div>";
                        }
                        
                        ?>
                    </td>                              

                    <td>
                    <a href="update-songs.php?id=<?php echo $id;?>" class="btn-secondary">Update Songs</a>
                        <a href="delete-songs.php ?id=<?php echo $id;?>&song_name=<?php echo $song_name;?>" class="btn-danger">Delete Songs</a>
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