
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>User Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>User Role</th>
            <th>Rand Salt</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT * FROM users ";
        $select_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $randSalt = $row['randSalt'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_password}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td><img width='100' height='50' src='../images/{$user_image}' alt='image' ></td>";
            echo "<td>{$user_role}</td>";
            echo "<td>{$randSalt}</td>";
            echo "<td><a href='users.php?admin={$user_id}'>Admin</a> </td>";
            echo "<td><a href='users.php?subs={$user_id}'>Subscribe</a></td>";
            echo "<td><a href='users.php?source=edit_users&p_id={$user_id}'>Edit</a> / <a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        if(isset($_GET['admin'])){
            $the_user_id = $_GET['admin'];
            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
            $update_query = mysqli_query($connection,$query);
            header("Location: users.php");
        }
        if(isset($_GET['subs'])){
            $the_user_id = $_GET['subs'];
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
            $update_query = mysqli_query($connection,$query);
            header("Location: users.php");
        }
        if(isset($_GET['delete'])){
            if(isset($_SESSION['user_role'])){
                if($_SESSION['user_role'] == 'admin' ){
                $the_user_id = mysqli_real_escape_string($connection,$_GET['delete']);
                $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                $delete_query = mysqli_query($connection,$query);
                header("Location: users.php");
                    }
            }
        }
        
        ?>
    </tbody>
</table>