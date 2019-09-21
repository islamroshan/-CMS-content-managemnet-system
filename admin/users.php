
<?php include "includes/admin_header.php"; ?>
<?php session_start(); ?>
<body>
<?php 
if(!is_admin($_SESSION['username'])){
    header("Location: index.php");
}    
?>
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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <?php 
                        if(isset($_GET['source'])) {
                            
                            $source = $_GET['source'];
                            
                        } else {
                            $source = '';
                        }
                        switch($source) {
                                
                                case '34';
                                echo "Nice 34";
                                break;
                                
                                case 'add_users';
                                include "includes/add_users.php";
                                break;
                                
                                case 'edit_users';
                                include "includes/edit_users.php";
                                break;
                                
                                case '32';
                                echo "Good 32";
                                break;
                                
                                case '200';
                                echo "Cool 200";
                                break;
                                
                                default:
                                include "includes/view_all_users.php";
                                break;
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/admin_footer.php"; ?>