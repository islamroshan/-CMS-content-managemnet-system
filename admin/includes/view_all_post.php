<?php 
if(isset($_POST['checkBoxArray'])){
    foreach( $_POST['checkBoxArray'] as $checkBoxid ){
          $bluk_options = $_POST['bluk_options'];
            switch($bluk_options){
                case 'published':
                $query = "UPDATE posts SET post_status = '{$bluk_options}' WHERE post_id = {$checkBoxid} ";
                $update_query = mysqli_query($connection,$query);
                break;
                case 'draft':
                $query = "UPDATE posts SET post_status = '{$bluk_options}' WHERE post_id = {$checkBoxid} ";
                $update_query = mysqli_query($connection,$query);
                break;
                case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkBoxid} ";
                $delete_query = mysqli_query($connection,$query);
                break;
                case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxid}' ";
                $select_post_query = mysqli_query($connection,$query);
                
                while($row = mysqli_fetch_assoc($select_post_query)){
                     
                    $post_author = $row['post_author'];
                    $post_user_id = $row['post_user'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                }
                $query = "INSERT INTO  posts(post_category_id,post_title,post_author,post_user,post_status,post_image,post_tags,post_date )";
                $query .= "VALUES( {$post_category_id}, '{$post_title}', '{$post_author}','{$post_user_id}','{$post_status}','{$post_image}','{$post_tags}',now() )";
                $query_query =mysqli_query($connection,$query); 
                    if(!$query_query){
                        die('Query FAiled' . mysqli_error($connection));
                    }
                break;
            }
    }
}
?>

<form method="post" action="">
<table class="table table-bordered table-hover">
    <div class="row">
        <div id="bulkOptionContainer" class="col-xs-4"> 
            <select class="form-control" name="bluk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">

            <button class="btn btn-success" name="submit" type="submit">Apply</button>
          <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>
        </div>
     </div>
    <br>
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Images</th>
            <th>Tags</th>
            <th>Comment</th>
            <th>Dates</th>
            <th>Post Views</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
//        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        // Query TO join two tables
 $query = " SELECT posts.post_id,posts.post_author,posts.post_user,posts.post_title,posts.post_category_id,posts.post_status,posts.post_image, ";
$query .= " posts.post_tags,posts.post_comment_count,posts.post_date,posts.post_views_count,category.cat_id,category.cat_title ";
$query .= " FROM posts ";
$query .= "LEFT JOIN category ON posts.post_category_id  = category.cat_id ";
        
        $select_posts = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_user_id= $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_views_count = $row['post_views_count'];
            $category_id = $row['cat_id'];
            $category_title = $row['cat_title'];
            echo "<tr>";
            ?>
        
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id ?>"></td>
        <?php
            echo "<td>{$post_id}</td>";
            
            if($post_author || !empty($post_author)){
                  echo "<td>{$post_author}</td>";
            } else if($post_user_id || !empty($post_user_id) ){
            echo "<td> {$post_user_id} </td>";
            
            }
            
            
            echo "<td>{$post_title}</td>";
            
//            $query = "SELECT * FROM category WHERE cat_id =  {$post_category_id} ";
//            $select_category_id = mysqli_query($connection,$query);
//
//            while($row = mysqli_fetch_assoc($select_category_id)){
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
                echo "<td> {$category_title} </td>";
//            }         
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' class='img-responsive' src='../images/{$post_image}'></td>";
            echo "<td>{$post_tags}</td>";
            
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
            $send_query = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($send_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_query);
            
            echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='post.php?reset={$post_id}'>{$post_views_count}</a></td>";
            echo "<td><a href='post.php?source=edit_post&p_id={$post_id}'>Edit</a> / <a  href='post.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
        
        if(isset($_GET['delete'])){
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $delete_query = mysqli_query($connection,$query);
            header("Location: post.php");
        }
        if(isset($_GET['reset'])){
            $reset_id = $_GET['reset'];
            $reset_querys = "UPDATE posts SET post_views_count = 0  WHERE post_id  =" . mysqli_real_escape_string($connection,$_GET['reset']) . " ";
            $send_query = mysqli_query($connection,$reset_querys);
            header('Location: post.php');
        }
        ?>
    </tbody>
</table>
</form>