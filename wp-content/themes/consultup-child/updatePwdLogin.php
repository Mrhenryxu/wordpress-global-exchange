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
        <html>

        <body>

            <div class="login">
                <div class="container">
                    <div class="login-grids">
                        <div class="col-md-6 log">
                            <h3>
                                <h1>Please Login</h1><br>
                            </h3>
                            <div class="strip"></div>
                            <p>
                                <font color ='red'>Update password successfully, please login!</font>
                            </p>

                            <?php
 
                            $password=$_POST['password'];                    
                            $conPassword=$_POST['conPassword'];
                            $id=base64_decode($_POST['id']);
                            $email=$_POST['email']; 
                            
                            if($password!=$conPassword){

                                    $_SESSION['email1']=$email;
                                        header("location:updatePwd.php?email=$email&error=4");
                                        exit;
                                    }
                                include("conndb.php");
                                $seclect = "select * from aamt_registerSchool where email='$email'";
                                $rselect=mysqli_query($conn, $seclect); 
                               
                                    if (!$rselect){
                                        die('1Cannot read data:'.mysqli_error());
                                    }
                                $rowselect=mysqli_num_rows($rselect);
                                $sql = "update aamt_registerschool set password='$password' where id='$id'";
                                if($rowselect==0){
                                    $seclect = "select * from aamt_registerTeacher where email='$email'";
                                    $rselect=mysqli_query($conn, $seclect);  
                                    if (!$rselect){
                                        die('2Cannot read data:'.mysqli_error());
                                    }
                                    $rowselect=mysqli_num_rows($rselect);
                                    $sql = "update aamt_registerTeacher set password='$password' where id='$id'";
                                }
                                    
                            
                                $results=mysqli_query($conn, $sql);  
                                if (!$results){
                                    header("location:updatePwd.php?error=3");
                                    exit;
                                }        

                                    mysqli_close($conn);

                            ?>


                            <?php 
                            if(!empty($_GET['error'])){
                                $error=$_GET['error'];
                                If($error==1){
                                    Echo "<font color ='red'>Username or password is incorrect!</font>";
                                }elseif ($error==2){
                                    Echo "<font color ='red'>Username and password cannot be empty!</font>";
                                }
                            }
                            ?>

                            <form action="loginned.php" method="post">
                                <table>
                                    <tr>
                                        <td style="font-size: 16px;">Username</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="text" name="username" value="<?php echo "$email";?>" required /></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;">Password</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="password" name="password" value="<?php echo "$password";?>" required /></td>
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
                            <h3>
                                <h1>Register Here</h1><br>
                            </h3>
                            <div class="strip"></div>
                            <p>
                                Welcome to join us!
                            </p>
                            <p>Join us as a school? <a href="schoolRegister.php">Chick here!</a></p>
                            <p>Join us as a teacher? <a href="teacherRegister.php">Chick here!</a></p>
                        </div>
                        <div class="clearfix"></div>
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