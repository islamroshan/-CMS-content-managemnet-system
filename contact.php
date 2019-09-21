
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <?php
                    if(isset($_POST['submit'])){
                        $to = "islamroshan103@gmail.com";
                        $subject = wordwrap($_POST['subject'],70);
                        $body = $_POST['body'];   $header =  $_POST['email'];
                        
                        mail($to,$subject,$body,);
                      
                    }
                    ?>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Your Email:</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Enter Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter you Subject">
                        </div>
                         <div class="form-group">
                           <textarea name="body" class="form-control"  rows="10" cols="50"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
