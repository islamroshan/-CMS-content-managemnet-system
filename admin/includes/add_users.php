<?php 
if(isset($_POST['create_user'])) {
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];
    $user_email = $_POST['email'];
    $first_name = $_POST['firstname'];
    
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    
    $last_name = $_POST['lastname'];
    $user_role = $_POST['userrole'];
    
    move_uploaded_file($user_image_temp , "../images/$user_image");
    $user_password =  password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 10));
    $query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role )" ;

    $query .= "VALUES( '{$user_name}' , '{$user_password}' , '{$first_name}' , '{$last_name}' , '{$user_email}' , '{$user_image}' , '{$user_role}' ) ";

    $create_user_query = mysqli_query($connection,$query);
    
    confirmQuery($create_user_query);
    
    echo "User Created:" . " " . "<a href='users.php?source=view_all_users'>View Users</a> ";
}




?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" name="password">
    </div>
    
    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="firstname">First Name</label>
       <input type="text" class="form-control" name="firstname">
    </div> 
    <div class="form-group">
        <label for="lastname">Last Name</label>
       <input type="text" class="form-control" name="lastname">
    </div> 
     <div class="form-group">
        <label>Role</label>
        <select class="form-control"  name="userrole">
            <option>admin</option>
            <option>subscriber</option>
        </select>
    </div>
    <button class="btn btn-primary" name="create_user" type="submit">Publish User</button>
    
</form>