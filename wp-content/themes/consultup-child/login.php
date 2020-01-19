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
?>

<?php
/**
* Template Name: Login
*
* @package WordPress
* @subpackage Consultup
* @since Consultup 1.0
*/ ?>
<?php
include("session.php");
session_start();
ob_start();
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<main id="content">
    <div class="container">


        <html>

        <body>

            <div class="login">
                <div class="container">
                    <div class="login-grids">
                        <div class="col-md-6 log">
                            <h3>
                                
                                <h1>Please Login</h1><br>
                            </h3>
                            
                            <h5>
                                Welcome, please input your login details correctly!
                            </h5>
                            <?php 
                            
                            if (!empty(session::get('loginemail'))&!empty(session::get('loginpassword') )){
                       
                            header("location:/wp-content/themes/consultup-child/loginned.php");
                                exit;
                        }
  
                            
                            
                                                if(!empty($_GET['error'])){
                                                    $error=$_GET['error'];
                                                    If($error==1){
                                                        Echo "<font color ='red'>Username or password is incorrect!</font>";
                                                    }elseif ($error==2){
                                                        Echo "<font color ='red'>Username and password cannot be empty!</font>";
                                                    }elseif ($error==3){
                                                        Echo "<font color ='red'>Please login your account!</font>";
                                                    }elseif ($error==5){
                                                        Echo "<font color ='red'>Your email or password has been changed. Please login again!</font>";
                                                    }
                                                }
                                            ?>
                            <br>
                            <form action="/wp-content/themes/consultup-child/loginned.php" method="post">
                                <table>
                                    <tr>
                                        <td style="font-size: 16px;">Username</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="text" name="username" value="<?php echo $_SESSION['email'];?>" required/></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;">Password</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="password" name="password" required/></td>
                                    </tr>
                                    <tr>
                                        <td><button type="submit" name="submit" value="Login">Login</button></td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><a href="/wp-content/themes/consultup-child/forgotPwd.php">Forgot your Password?</a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </table>
                                
                            </form>
                            
                        </div>
                        
                        <div class="col-md-6 login-right">
                            
                            <h2>Register Here</h2><br>
                            
                           
                            <h3 style="font-size: 16px">
                                We are here waiting for you, welcome to join us!
                            </h3>
                            <br>
                            <p><a href="/wp-content/themes/consultup-child/schoolRegister.php">Join us as a school</a></p>
                            <p><a href="/wp-content/themes/consultup-child/teacherRegister.php">Join us as a teacher</a></p> 
                        </div>
                        
                    </div>
                </div>
            </div>
        </body>
        </html>
    </div>
</main>
<?php
get_footer();
?>