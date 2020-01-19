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
* Template Name: Registration
*
* @package WordPress
* @subpackage Consultup
* @since Consultup 1.0
*/ ?>
<?php
session_start();
ob_start();
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<head>

    <style type="text/css">
        #resulttable {

            border-collapse: collapse;
            vertical-align: middle;
            
        }

        #resultth {

            height: 50px;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: cornflowerblue;
            color: white;
            width: 140px;

        }

        #resulttr {
            height: 50px;
        }

        #resulttd {
            height: 50px;
            padding-left: 50px;
            padding-right: 15px;
        }

        #resulttr:hover {
            background-color: #f5f5f5
        }
    </style>

</head>

<main id="content">
  <div class="container">
        <!--insert school registration infor to db -->
        
        <form action="/wp-content/themes/consultup-child/insertTeacher.php" method="post" enctype="multipart/form-data">
            <h2>Teacher Registration</h2>
            <?php 
                if(!empty($_GET['error'])){
                    $error=$_GET['error'];
                    If($error==1){
                        Echo "<font color ='red'>Insert error!</font>";
                    }elseif ($error==2){
                        Echo "<font color ='red'>Please input all fields!</font>";
                    }elseif ($error==3){
                        Echo "<font color ='red'>Please input correct phone number!</font>";
                    }else{
                        Echo "<font color ='red'>An account is found under this email!</font>";
                    }
                }
            ?>
            
            
            <br>
            <table id="resulttable">
                <tr id="resulttr">
                <th id="resultth">Title</th>
                <td id="resulttd">
                    <select name="title" placeholder="Select Your Title" required>
                        <option value="1">Mr</option>
                        <option value="2">Miss</option>
                        <option value="3">Mrs</option>
                        <option value="4">Ms</option>
                        <option value="5">Dr</option>
                    </select>
                    
               </tr>
               <tr id="resulttr">
                <th id="resultth">Name</th>
                <td id="resulttd"><input type="text" name="firstName" placeholder="Firstname" value="<?php echo $_SESSION['firstName'];?>" required>&nbsp;&nbsp;
                    <input type="text" name="lastName"  placeholder="Lastname" value="<?php echo $_SESSION['lastName'];?>"  required></td>
               </tr>
              
                <tr id="resulttr">
                <th id="resultth">Password</th>
                <td id="resulttd"><input type="password" name="password" required></td>
           
                </tr>
                
                <tr id="resulttr">
                <th id="resultth">Email</th>
                <td id="resulttd"><input type="email" name="email" value="<?php echo $_SESSION['email'];?>"  required></td>
                </tr> 
                
                <tr id="resulttr">
                <th id="resultth">Phone No.</th>
                <td id="resulttd">
                    <select name="countryCode" placeholder="countryCode" required>
                        <!-- country codes (ISO 3166) and Dial codes. -->
                        <option data-countryCode="AU" value="61" Selected>Australia (+61)</option>
                        
                        <optgroup label="Other countries">
                            <option data-countryCode="CA" value="1">Canada (+1)</option>
                            <option data-countryCode="CN" value="86">China (+86)</option>
                            <option data-countryCode="SG" value="65">Singapore (+65)</option>
                            <option data-countryCode="GB" value="44">UK (+44)</option>
                            <option data-countryCode="US" value="1(US)">USA (+1)</option>
                        </optgroup>
                    </select>
                    <input type="text" name="phone" value="<?php echo $_SESSION['phone'];?>"  required></td>
               </tr>
                <tr id="resulttr">
                    <th id="resultth">Address</th>
                    <td id="resulttd"><input type="text" name="address" value="<?php echo $_SESSION['address'];?>" required></td>
                </tr>

                <tr><th id="resultth">Country</th>
                    <td id="resulttd">
                    <table>
                        <tr>
                            <td> <select name="country" required>
                            <option value="AU" selected>Australia</option>
                            <option value="CA">Canada</option>
                            <option value="CN">China</option>           
                            <option value="SG">Singapore</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            </select>
                            <input type="text" name="state" placeholder="State" value="<?php echo $_SESSION['state'];?>" required>
                                &nbsp;&nbsp;<input type="text" name="city" placeholder="City" value="<?php echo $_SESSION['city'];?>" required>
                            </td>
                        </tr>
                     </table>
                    </td>
               </tr>
                <tr id="resulttr">
                    <th id="resultth">CV</th>
                    <td id="resulttd"><input type="file" name="file" id="file"></td>
                </tr>
            </table>
               
            <table>
                   
             
                <tr id="resulttr">
                <fieldset>  
                   <table width="500" length="100" >
                        
                       <tr> <legend>Which months in the year are you able to exchange?</legend>  </tr>
                       <tr> <td> &nbsp;<input type="checkbox" name="exchangeMonths[]" value="1" onclick="return ValidatePetSelection();">  January</td>
                        <td><input type="checkbox" name="exchangeMonths[]" value="2" onclick="return ValidatePetSelection();">  February</td>
                       <td> <input type="checkbox" name="exchangeMonths[]" value="3" onclick="return ValidatePetSelection();">  March </td></tr>
                        <tr><td>&nbsp;<input type="checkbox" name="exchangeMonths[]" value="4" onclick="return ValidatePetSelection();">  April</td>
                        <td><input type="checkbox" name="exchangeMonths[]" value="5" onclick="return ValidatePetSelection();">  May</td>
                        <td><input type="checkbox" name="exchangeMonths[]" value="6" onclick="return ValidatePetSelection();">  June </td></tr>
                        <tr><td>&nbsp;<input type="checkbox" name="exchangeMonths[]" value="7" onclick="return ValidatePetSelection();">  July</td>
                        <td><input type="checkbox" name="exchangeMonths[]" value="8" onclick="return ValidatePetSelection();">  August</td>
                       <td> <input type="checkbox" name="exchangeMonths[]" value="9" onclick="return ValidatePetSelection();">  September</td></tr>
                        <tr><td>&nbsp;<input type="checkbox" name="exchangeMonths[]" value="10" onclick="return ValidatePetSelection();">  October</td>
                       <td> <input type="checkbox" name="exchangeMonths[]" value="11" onclick="return ValidatePetSelection();">  November</td>
                       <td> <input type="checkbox" name="exchangeMonths[]" value="12" onclick="return ValidatePetSelection();">  December</td>
                    </table>
                </fieldset>
                
                </tr>
                <br>
                    
                  
                <tr id="resulttr"></tr>
                  <tr id="resulttr"></tr>
                  <tr id="resulttr"></tr>
               
               <tr id="resulttr">
                   <td id="resulttd"><button type="submit" value="Register">Register</button></td>
                <td id="resulttd">&nbsp;<button onclick="window.location.href='/wp-content/themes/consultup-child/login.php'">Already? Login</button></td>
               </tr>
            </table>
        </form>
  </div>
 </main>

<?php
session_destroy();
get_footer();
?>