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
                        <div class="">




                            <?php 
                                if(!isset($_POST['submit'])){
                                    exit("错误执行");
                                }

                                $name=$_POST['username'];//post获取表单里的name
                                $password=$_POST['password'];//post获取表单里的password

                                include('conndb.php');//链接数据库
                                                         echo "$name";
                                                        echo "$password";
                                $q="insert into aamt_webuser(id,username,password) values (null,'$name','$password')";//向数据库插入表单传来的值的sql  
                                                        echo "$q";
                                $r=mysqli_query($conn, $q);  

                                if (!$r){
                                    die('Error:');//如果sql执行失败输出错误
                                }
                                    else{
                                    echo "注册成功";//成功输出注册成功
                                }



                                mysql_close($con);//关闭数据库

                            ?>




                            <h3>
                                <h1>Registerred Successfully, Please Login!</h1><br>
                            </h3>
                            <div class="strip"></div>
                            <p>
                                Welcome, please input your login details correctly!
                            </p>

                            <form action="loginned.php" method="post">
                                <h5>
                                    Username: <input type="text" name="username" />
                                </h5>

                                <h5>
                                    Passsword: <input type="text" name="password" />
                                </h5>

                                <input type="submit" value="Login" />
                            </form>
                            <a href="user/forget.action">Forgot your Password ?</a>
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