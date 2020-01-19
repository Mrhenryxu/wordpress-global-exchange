<?php
$genmul=$_SERVER['DOCUMENT_ROOT'];
require_once("$genmul/wp-config.php");
?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package consultup
 */
session_start();
ob_start();
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->


<main id="content">
    <div class="container">
        <div class="login-grids">
                        <div class="col-md-6 log">
        <!--insert school registration infor to db -->
        
            <h2>Forgotten Password</h2>

            <p>Please input the email address used when registered:</p>


            <?php 
            if(!empty($_GET['error'])){
                $error=$_GET['error'];
                If($error==1){
                    Echo "<font color ='red'>Email not exist! Please check detail and try again!</font>";
                }elseif ($error==2){
                    Echo "<font color ='red'>Username and password cannot be empty!</font>";
                }
            }
            ?><br>
        <form action="sendMail.php" method="post">


            Email:&nbsp&nbsp&nbsp <input type="text" name="email" required>&nbsp&nbsp&nbsp
            <input type="submit" name="s1" value="Submit">



        </form>

<br><br><br><br><br><br><br>
    </div></div></div>
</main>

<?php
get_footer();
?>