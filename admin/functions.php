<?php 
function confirmQuery($result){
     global $connection;
     if(!$result){
        die ("QUERY FAILED" . mysqli_error($connection));
      }
}
function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}
function insert_categories() {
if(isset($_POST['submit'])){
    global $connection;
   $cat_title = $_POST['cat_title'];

    if($cat_title == "" || empty($cat_title)){
        echo "This Field Should Not Be empty ";
    } else{
        $query = "INSERT INTO category(cat_title) ";
        $query .= "VALUE('{$cat_title}') ";
        $create_category_query = mysqli_query($connection,$query);
        header("Location: categories.php");

        if(!$create_category_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }
}
    
}


function delete_category() {
    
    if(isset($_GET['delete'])) {
    global $connection;
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM category WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: categories.php");
    }
                                    
}
function users_online() {
    global $connection;
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time -  $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection,$query);
        $count = mysqli_num_rows( $send_query);

        if($count == NULL){
            mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session' , '$time') ");
        }else{
            mysqli_query($connection,"UPDATE  users_online SET time = '$time' WHERE session = '$session' ");
        }

        $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out' ");
        return  $count_users = mysqli_num_rows($users_online_query);
                                    
}
function select_category_to_show() {
    global $connection;
    $query = "SELECT * FROM category";
    $select_category_to_show = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_category_to_show)) { 
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
        
    echo "<tr>";
    echo "<td> {$cat_id}</td>"; 
     echo "<td> {$cat_title}</td>" ;
    echo "<td> <a href='categories.php?delete={$cat_id}'>Delete</a> / <a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
 } 
}
function recordCount($table){
     global $connection ;
        $query = "SELECT * FROM " . $table ;
        $select_query = mysqli_query($connection,$query);
        $result = mysqli_num_rows($select_query);
        confirmQuery($result);
        return $result ;
}
function postStatus($table,$column,$status) {
    global $connection;
     $query = "SELECT * FROM $table WHERE $column = '$status' ";
     $result = mysqli_query($connection,$query);
     return mysqli_num_rows($result);
}
function is_admin($username = ''){
       global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);
    $row = mysqli_fetch_assoc($result);
    if($row['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }
    
}
?>