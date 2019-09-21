<?php 
if(isset($_POST['create_post'])) {
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_user_id = escape($_POST['user']);
   
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    
    
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date('d-m-y'));
    $post_comment_count = 0;
    
    move_uploaded_file($post_image_temp , "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_comment_count )" ;

    $query .= "VALUES( {$post_category_id} ,'{$post_title}','{$post_user_id}', now() ,'{$post_image}','{$post_content}','{$post_tags}',  '{$post_comment_count}' ) ";

    $create_post_query = mysqli_query($connection,$query);
    
    confirmQuery($create_post_query);
    $the_post_id = mysqli_insert_id($connection); 
    echo "<h2 class='bg-success'>Post Created:<a href='../post.php?p_id={$the_post_id}'> View Post </a> or <a href=''>Edit Morw</a> </h2>";
}




?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <label>Category:</label>
          <select class="form-control" name="post_category">
             <?php 
                $query = "SELECT * FROM category ";
                $select_category = mysqli_query($connection,$query);
               
                while($row = mysqli_fetch_assoc($select_category)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                   
                   echo "<option value='{$cat_id}'>{$cat_title}</option>" ;
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
                echo "<option value=''>Select One</option>" ;
                while($row = mysqli_fetch_assoc($select_users)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    
                   echo "<option value='{$username}'>{$username}</option>" ;
               }
             ?>
       </select>
    </div>
<!--
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
-->
   
     
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="editor" name="post_content" col="30" row="10" >
        </textarea>
    </div>
    <button class="btn btn-primary" name="create_post" type="submit">Publish Post</button>
    
</form>
<!--CKEDITOR-->
<script>

ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

</script>