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
					<div class="col-md-6 log">
						<h3>
							<h1>Register Here</h1><br>
						</h3>
						<div class="strip"></div>
						<p>
							Welcome, please input your details correctly!
                        </p>

						<form action="registerred.php" method="post">
							<h5>
								Username: <input type="text" name="username" />
							</h5>
							
							<h5>
								Passsword: <input type="text" name="password" />
                            </h5>

							<input type="submit" name ="submit" value="Register" />
						</form>
						<a href="login.php">Already have an account? Login here!</a>
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