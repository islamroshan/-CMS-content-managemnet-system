
<?php include "includes/admin_header.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                        <h1 class="page-header">
                          Welcome to admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php insert_categories(); ?>
                            <form action="categories.php" method="post">
                                <div class="form-group">
                                    <label for="cat_title"> Add Category </label>
                                    <input class="form-control" name="cat_title" type="text">
                                </div>
                                <div  class="form-group">
                                    <button class="btn btn-success" name="submit" type="submit">Add Category</button>
                                </div>
                            </form>   
                            <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];
                                
                                include "includes/update_category.php";
                                
                            }
                            ?>
                        </div>
                         <div class="col-xs-6">
                             <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php select_category_to_show(); ?>
                                   
                                <?php delete_category(); ?>
                                </tbody>
                             </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
   <?php include "includes/admin_footer.php"; ?>