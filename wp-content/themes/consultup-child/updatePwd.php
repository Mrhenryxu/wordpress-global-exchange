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
                    <h1>Update Password</h1>
                    <?php $email = $_POST['email'];
                    $_SESSION['email']=$email; 
                     
                    ?>

                    <p>Please input new password:</p>
                    <?php 
                    if(!empty($_GET['error'])){
                        $error=$_GET['error'];
                        If($error==3){
                            Echo "<font color ='red'>Update error!</font>";
                        }elseif ($error==4){
                            Echo "<font color ='red'>Please input the same password!</font>";
                        }
                    }
                    ?><br>

                        <form action="updatePwdLogin.php" method="post">
                            <table width="100%">
                                <tr>
                                    <input type="text" name="id" value= "<?php echo $_GET['token'];?>" hidden />
                                    <td width="1/3">Your email is:&nbsp;&nbsp;&nbsp;<input type="text" name="email" value="<?php echo $_GET['email'];?>" readonly></td>
                                    <td width="1/3">Password:&nbsp;&nbsp;&nbsp;<input type="password" name="password" required /></td>
                                    <td width="1/3">Confirm password:&nbsp;&nbsp;&nbsp;<input type="password" name="conPassword" required /></td>
                                </tr>
                            </table>
                            <input type="submit" name="submit" value="Submit" />
                        </form>
               
                    <?php
//class checkForgotPwd  
//{                
//	var $checkEmail; 
// 
//	function checkForgotPwd($x)			
//	{
//		$this->checkEmail=$x;
//    } 
//	function checkEmail()
//	{
//        
//		include("conndb.php");  
//        $q="select email from aamt_registerSchool where email='".$this->checkEmail."'";
//        $s = $conn->query($q);
//        $info=$s->num_rows;
//		
//        if($info==0)					
//		{      
//            header("location:forgotPwd.php?error=1");
//			exit;
//		}
//	}
//    
//} 
//if(isset($_POST["s1"])){
//       $obj=new checkForgotPwd($email); 
//$obj->checkEmail(); 
//    }
//                                                            
                                                            
       	
?>


                </div>
            </div>
        </body>

        </html>




    </div>
</main>

<?php
session_destroy();
get_footer();
?>