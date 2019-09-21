<?php include "includes/admin_header.php"; ?>
<?php session_start(); ?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">

                        Welcome to admin
                        <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <?php
                        if(isset($_SESSION['username'])){
                            $username = $_SESSION['username'];
                            
                            $query = "SELECT * FROM users WHERE username = '$username' ";
                            
                            $select_users_query = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_users_query)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_password = $row['user_password'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                            }
                            
                            
                        }
                            if(isset($_POST['update_profile'])){

                            $user_name = $_POST['username'];
                            $user_password = $_POST['password'];
                            $user_email = $_POST['email'];
                            $first_name = $_POST['firstname'];

//                            $user_image = $_FILES['image']['name'];
//                            $user_image_temp = $_FILES['image']['tmp_name'];

                            $last_name = $_POST['lastname'];

//                            if(empty($user_image)) {
//                            $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
//                            $select_query = mysqli_query($connection,$query);
//                            while($row = mysqli_fetch_assoc($select_query)){
//                            $user_image = $row['user_image'];  
//                            }
//                            }
                                if(!empty($user_password)){
                                   $query = "SELECT * FROM users WHERE username = '$username' ";
                                   $send_query = mysqli_query($connection,$query);
                                   confirmQuery( $send_query);

                                   $row = mysqli_fetch_assoc($send_query);

                                   $db_user_password = $row['user_password'];
                                   if($db_user_password != $user_password){
                                       $hashed_password =  password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 10));

                                   }
                             $query = "UPDATE users SET ";
                            $query .= "username  = '{$user_name}', ";
                            $query .= "user_password  = '{$hashed_password}', ";
                            $query .= "user_firstname  = '{$first_name}', ";
                            $query .= "user_lastname  = '{$last_name}', ";
                            $query .= "user_email  = '{$user_email}', ";
                            $query .= "user_image  = '{$user_image}' ";
                            $query .= "WHERE user_id = {$user_id} ";

                            $update_user = mysqli_query($connection,$query);

                            confirmQuery( $update_user);
                                }
                            
                            }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        <label for="username">User Name</label>
                        <input  value="<?php echo $username ; ?>" type="text" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                        <label for="password">Password</label>
                        <input auto-complete="off"   type="text" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?php echo $user_email ?>" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input value="<?php echo $user_firstname ?>" type="text" class="form-control" name="firstname">
                        </div> 
                        <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="lastname">
                        </div> 
                        
                        <button class="btn btn-primary" name="update_profile" type="submit">Update Profile</button>

                        </form>
   
                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>