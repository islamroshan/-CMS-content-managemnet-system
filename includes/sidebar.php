
<div class="col-md-4">

         
         <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                   
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                     </form>
                    <!-- /.input-group -->
                </div>
             <div class="well" >
                 <?php if(isset($_SESSION['user_role'])): ?>
                 <h2>Logged in as <span class="text-primary"> <?php echo $_SESSION['username']; ?></span></h2>
                 <h2>User Role :<span class="text-danger"> <?php echo $_SESSION['user_role']; ?></span></h2>
                 <a href="includes/logout.php" class="btn btn-primary">LogOut</a>
                 <?php else: ?>
                    <h4>Login</h4>
                 <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input  type="text" name="username" class="form-control" placeholder="Enter User Name">
                    </div>
                     <div class="input-group">
                     <input type="password" name="password" class="form-control" placeholder="Password">
                     <span class="input-group-btn">
                        <button name="login" class="btn btn-primary" type="submit">
                            Submit
                        </button>
                        </span>
                     </div>
                </form>
                 <?php endif; ?>
            </div>
                
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                $query = "SELECT * FROM category";
                                $select_categories_sidebar = mysqli_query($connection , $query);
                                
                                while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                echo "<li><a href='category.php?category= {$cat_id} '>{$cat_title}</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php include "widget.php"; ?>
            </div>