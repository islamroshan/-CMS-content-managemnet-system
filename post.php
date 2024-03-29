<!DOCTYPE html>
<html lang="en">
 <?php include "includes/header.php";  ?>
<body>

    <!-- Navigation -->
   <?php include "includes/navigation.php";  ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                  <?php 
                
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                    
                    $view_query = "UPDATE posts SET  post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                    $update_query = mysqli_query($connection,$view_query);
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
                    }else{
                         $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} AND post_status = 'published' ";
                    }
                   
                    $select_all_posts_query = mysqli_query($connection , $query);
                    if(mysqli_num_rows($select_all_posts_query) < 1){
                        echo "<h1>No Posts Available For This ID </h1>";
                    } else{
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                       
                ?> 
                        
                    <h1 class="page-header">
                     Posts
                     
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p ><?php echo $post_content ?></p>
                <hr>

                  <?php  } 
                
                
                 
                ?>
                
                
                        <!-- Blog Comments -->
                <?php 
                if(isset($_POST['create_comment'])){
                    
                    $the_post_id = $_GET['p_id'];
                    $comment_author =  $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ( $the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now() )";
                    $insert_query = mysqli_query($connection , $query);
                    confirmQuery($insert_query);

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id ";
                    $update_comment_count = mysqli_query($connection,$query);
                        
                    } else {
                        echo "<script>alert('Fields can not be empty')</script>";
                    }
                    
                } 
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                           <input  class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                          <input class="form-control" type="email" name="comment_email">
                        </div> 
                        <div class="form-group">
                            <label for="comment_content"></label>
                            <textarea class="form-control" id="editor" name="comment_content" rows="3"></textarea>
                  
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                
               
              
                     <?php 
                    $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
                    $query .= "AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC";
                    $select_comments_query = mysqli_query($connection,$query);
                    if(!$select_comments_query){
                        die("Query failed");
                    }
                    while($row = mysqli_fetch_assoc($select_comments_query)){
                    $comment_author = $row['comment_author'];
                    $comment_date   = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    ?>
                    <div class="media">
                    <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author ;?>
                    <small><?php echo $comment_date ; ?></small>
                    </h4>
                    <?php echo $comment_content ; ?>
                          </div>
                    </div> 
                   <?php } } } else{
                    header("Location: index.php");
                }  ?>  
              

                <!-- Comment -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
       <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<!--       CKEDITOR-->
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
</body>

</html>
