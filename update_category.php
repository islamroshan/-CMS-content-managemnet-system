                       <?php
                                     if(isset($_POST['update_cat'])){
                                 
                                    $the_cat_title = $_POST['cat_title'];
                                    
                                    $query = "UPDATE category SET cat_title = '{$the_cat_title}' WHERE cat_id =  {$cat_id} ";
                                  
                                    $update_query = mysqli_query($connection,$query);
                                        header("Location: categories.php");
                                } 
                            
                                ?>
                                <form action="" method="post">  
                                <div class="form-group">
                                <label for="cat_title"> Update Category </label>
                                    <?php 
                                     if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'] ;
                                    
                                    $query = "SELECT * FROM category WHERE cat_id = $cat_id ";
                                    $select_category_id = mysqli_query($connection,$query);
                                    
                                    while($row = mysqli_fetch_assoc($select_category_id)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                    ?>
                                    <input value="<?php if(isset($cat_title)){echo $cat_title; } ?>" class="form-control" name="cat_title" type="text">
                                
                                    <?php } }
                                    ?>
                                     
                            
                               

                                     </div> 
                    <div  class="form-group">
                                <button class="btn btn-success" name="update_cat" type="submit">Update Category</button>
                                </div>
                                     </form>