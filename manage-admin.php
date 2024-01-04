<?php include('menu.php'); ?>
     <!-- Main contents Section starts -->
     <div class="main-content">
     <div class="wrapper">
         <h3>Manage Admin</h3>
         <br>
        <?php
           if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);

           }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];  //Displaying the session mssg
                unset($_SESSION['add']);  //Removing the session message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['password-not-match'])){
                echo $_SESSION['password-not-match'];
                unset($_SESSION['password-not-match']);
            }
            if(isset($_SESSION['change pwd'])){
                echo $_SESSION['change pwd'];
                unset($_SESSION['change pwd']);
            }
          
        ?>
        <br>
         <!-- Buttom to add Admin -->
         <br><br>
         <a href="add-admin.php" class="btn-primary">Add Admin</a>
         <br><br><br>

          <!-- ... (your existing code) ... -->

<table class="tbl-full">
    <tr>
        <th>S.No</th>
        <th>User Name</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    // Query to get all admin
    $sql = "SELECT * FROM users";
    // Execute the Query
    $res = mysqli_query($con, $sql);

    // Check whether the Query is Executed or not
    if ($res == TRUE) {
        // Count rows to check whether we have data in the database or not
        $count = mysqli_num_rows($res);

        // Check the no.of rows
        if ($count > 0) {
            // We have data in the database

            $sn = 0;
            while ($rows = mysqli_fetch_assoc($res)) {
                // Using a while loop to get all the data from the database
                // And the while loop will run as long as we have data in the database

                // Get individual Data
                $id = $rows['id'];
                $username = $rows['username'];
                $first_name = $rows['firstName'];
                $last_name = $rows['lastName'];
                $email = $rows['email'];

                // Display the values in our table
                ?>
                <tr>
                    <td><?php echo ++$sn; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $first_name; ?></td>
                    <td><?php echo $last_name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td>
                        <a href="update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                        <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                        <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                        <!-- passing value through url known as GET method  -->
                    </td>
                </tr>
                <?php
            }
            
        } else {
            // no data is there in your database
            echo "No data in your database";
        }
    } else {
        // Error in executing the query
        echo "Error: " . mysqli_error($con);
    }
    ?>
</table>

<!-- ... (your existing code) ... -->


        </div>
     </div>
    <!-- Main contents Section ends -->

<!-- <?php include('footer.php'); ?> -->