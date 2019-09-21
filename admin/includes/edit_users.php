        <?php 
    if(isset($_GET['p_id'])) {
        $the_user_id = $_GET['p_id'];
        
    }
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
        if(isset($_POST['update_user'])){
           
            $user_name = $_POST['username'];
            $user_password = $_POST['password'];
            $user_email = $_POST['email'];
            $first_name = $_POST['firstname'];

            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];

            $last_name = $_POST['lastname'];
            $user_role = $_POST['userrole'];
            
            if(empty($user_image)) {
                $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                $select_query = mysqli_query($connection,$query);
                 while($row = mysqli_fetch_assoc($select_query)){
                     $user_image = $row['user_image'];  
                 }
            }
           if(!empty($user_password)){
               $query = "SELECT * FROM users WHERE user_id = $the_user_id";
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
            $query .= "user_image  = '{$user_image}', ";
            $query .= "user_role  = '{$user_role}' ";
            $query .= "WHERE user_id = {$the_user_id} ";
            
            $update_user = mysqli_query($connection,$query);
            
            confirmQuery( $update_user);
           }
            
        }
        ?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input  value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input value="<?php echo $user_password ; ?>" type="text" class="form-control" name="password">
    </div>
    
    <div class="form-group">
        <label for="image">User Image</label>
        <img width="100 "  height="50 " src="../images/<?php echo $user_image ?>" alt="image" >
        <input  type="file" class="form-control" name="image">
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
    <div class="form-group">
        <label>Role</label>
        <select class="form-control"  name="userrole">
            <option value="<?php echo $user_role; ?>"> <?php echo $user_role; ?></option>
            <?php 
            if($user_role == 'admin'){
            echo  "<option value='subscriber'>subscriber</option>"; 
            } else {
                  echo "<option value='admin'>admin</option>";
            }
            ?>
          
           
          
        </select>
    </div>
    <button class="btn btn-primary" name="update_user" type="submit">Update User</button>
    
</form>
   