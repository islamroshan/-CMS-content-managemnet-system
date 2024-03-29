        <?php 
    if(isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
        
    }
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $post_id = $row['post_id'];
            $post_user_id = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

        }
        if(isset($_POST['update_post'])){
            $post_title = $_POST['title'];
            $post_category_id = $_POST['post_category'];
            $post_user_id = $_POST['user'];
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];


            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
           

            move_uploaded_file($post_image_temp , "../images/$post_image");
            
            if(empty($post_image)) {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_query = mysqli_query($connection,$query);
                 while($row = mysqli_fetch_assoc($select_query)){
                     $post_image = $row['post_image'];  
                 }
            }
        
            $query = "UPDATE posts SET ";
            $query .= "post_title  = '{$post_title}', ";
            $query .= "post_category_id  = '{$post_category_id}', ";
            $query .= "post_date  = now(), ";
            $query .= "post_user  = '{$post_user_id}', ";
            $query .= "post_status  = '{$post_status}', ";
            $query .= "post_tags  = '{$post_tags}', ";
            $query .= "post_content  = '{$post_content}', ";
            $query .= "post_image  = '{$post_image}' ";
            $query .= "WHERE post_id = {$the_post_id} ";
            
            $update_post = mysqli_query($connection,$query);
            
            confirmQuery( $update_post);
            
            echo "<h2 class='bg-success'>Post Updated: <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='post.php'>Edit More Posts</a> </h2>";
        }
        ?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <label for="post_category"> Post Category</label>
        <select class="form-control" name="post_category">
             <?php 
                $query = "SELECT * FROM category ";
                $select_category = mysqli_query($connection,$query);
               
                while($row = mysqli_fetch_assoc($select_category)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                   if($cat_id == $post_category_id){
                   echo "<option selected value='{$cat_id}'>{$cat_title}</option>" ;
                   }else{
                       echo "<option value='{$cat_id}'>{$cat_title}</option>" ;
                   }
               }
             ?>
       </select>
    </div>
    <div class="form-group">
         <label>Users:</label>
          <select class="form-control" name="user">
             <?php 
              
                $query = "SELECT * FROM users ";
                $select_users = mysqli_query($connection,$query);
              
                
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    if($username == $post_user_id){
                         echo "<option selected value='{$username}'>{$username}</option>" ;
                    }else{
                   echo "<option value='{$username}'>{$username}</option>" ;
                }
               }
             ?>
       </select>
    </div>
    
     <div class="form-group" >
        <select name="post_status" class="form-control">
            <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php 
            if($post_status == 'draft' ){
                echo "<option value='published'>Published</option>";
            } else {
                echo "<option value='draft'>Draft</option>";
            }
            ?>
        </select>
    </div>

    
    <div class="form-group">
        <label for="image">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="" >
        <input  type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo  $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" col="30" row="10" id=""><?php echo  $post_content ?></textarea>
    </div>
    <button class="btn btn-primary" name="update_post" type="submit">Update Post</button>
    
</form>