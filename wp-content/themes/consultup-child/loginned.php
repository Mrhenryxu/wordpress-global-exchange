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
* Template Name: MyProfile
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



<head>

    <style type="text/css">
        #resulttable {

            border-collapse: collapse;
            
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
            width:155px;

        }

        #resulttr {
            height: 50px;
        }

        #resulttd {
            height: 50px;
            padding-left: 50px;
            padding-right: 15px;
        }
        #resulttdd{
            height: 50px;
            text-align: center;
        }
        #resulttr:hover {
            background-color: #f5f5f5
        }
    </style>

</head>

<main id="content">
    <div class="container">
        <div class="login-grids">
            <div class="col-md-6 log">
        <?PHP
        $_SESSION['email']=$_POST['username']; 
        if (empty(session::get('loginemail'))&empty(session::get('loginpassword') )){
                        $name = $_POST['username'];
                        $password=$_POST['password'];
        }
        else{
            $name=session::get('loginemail');
            $password=session::get('loginpassword');
        }
            
                        if (!empty($name)){
                        if ($name && $password){
                            include("conndb.php");
                            $sql = "SELECT * FROM aamt_registerschool where email='$name' and password='$password'";  
                            $results=mysqli_query($conn, $sql);  
                            if (!$results){
                                die('Cannot read data:'.mysqli_error());
                            }
                            $rows=mysqli_num_rows($results);
                            if ($rows==0){
                                    $sql = "SELECT * FROM aamt_registerTeacher where email='$name' and password='$password'";  
                                    $results=mysqli_query($conn, $sql);  
                                   
                                    if (!$results){
                                        die('Cannot read data:'.mysqli_error());
                                    }
                                    $rows=mysqli_num_rows($results);
                            }
                            if($rows){//0 false 1 true 
                                
                                while($rows = mysqli_fetch_assoc($results)){  
                                        $_SESSION['id']=$rows['id']; 
                                        $_SESSION['title']=$rows['title'];
                                        $_SESSION['firstName']=$rows['firstName']; 
                                        $_SESSION['lastName']=$rows['lastName']; 
                                        $_SESSION['password']=$rows['password']; 
                                        $_SESSION['email']=$rows['email']; 
                                        $_SESSION['countryCode']=$rows['countryCode']; 
                                        $_SESSION['phone']=$rows['phone']; 
                                        $_SESSION['department']=$rows['department']; 
                                        $_SESSION['position']=$rows['position']; 
                                        $_SESSION['schoolName']=$rows['schoolName']; 
                                        $_SESSION['schoolAddress']=$rows['schoolAddress']; 
                                        $_SESSION['address']=$rows['address'];
                                        $_SESSION['countryCode']=$rows['countryCode'];
                                        $_SESSION['country']=$rows['country']; 
                                        $_SESSION['state']=$rows['state']; 
                                        $_SESSION['city']=$rows['city']; 
                                        $_SESSION['schoolLevel']=$rows['schoolLevel']; 
                                        $_SESSION['schoolType']=$rows['schoolType']; 
                                        $_SESSION['schoolSize']=$rows['schoolSize']; 
                                        $_SESSION['hostVisiting']=$rows['hostVisiting'];  
                                        $_SESSION['accommodateMonths']=$rows['accommodateMonths'];  
                                        $_SESSION['exchangeMonths']=$rows['exchangeMonths']; 
                                        
                                        $_SESSION['fileName']=$rows['fileName'];
                                        session::set('loginemail', $rows['email'], 600);
                                        session::set('myid', $rows['id'], 600);
                                        session::set('mytitle', $rows['title'], 600);
                                        session::set('myusername', $rows['firstName'], 600);
                                        session::set('loginpassword', $rows['password'], 600);
                                        
                                  ?>
                                <?php
                                if(!empty($rows['title'])){
                                ?>
                                    <table width="500">
                                        <tr>
                                            <td width="100">
                                                <h2>Your Details</h2>
                                            </td>

                                        </tr>
                                    </table> <br>
                                    <table id="resulttable">
                                        <tr id="resulttr">
                                            <th id="resultth">Name</th>
                                            <td id="resulttd" style="text-transform: capitalize"><?php echo "{$rows['firstName']}"?>&nbsp;<?php echo "{$rows['lastName']}"?></td>
                                        </tr>
                                        <tr id="resulttr">
                                            <th id="resultth">Email</th>
                                            <td id="resulttd"><?php echo "{$rows['email']}"?></td>
                                        </tr>
                                        <tr id="resulttr">
                                            <th id="resultth">Phone</th>
                                            <td id="resulttd">+<?php echo "{$rows['countryCode']}"?>&nbsp;<?php echo "{$rows['phone']}"?></td>
                                        </tr>
                                        <tr id="resulttr">
                                            <th id="resultth">Address</th>
                                            <td id="resulttd"><?php echo "{$rows['address']}"?>&nbsp;<?php echo "{$rows['city']}"?>&nbsp;<?php echo "{$rows['state']}"?>&nbsp;<?php echo "{$rows['country']}"?></td>
                                        </tr>
                                        <tr id="resulttr">
                                            <th id="resultth">Exchange Months</th>
                                            <td id="resulttd">
                                                <?php  
                                                $accM=array();
                                                $accM=explode(',',$rows['exchangeMonths']);
                                                for($i=0;$i<count($accM);$i++){
                                                    if($accM[$i]==1){
                                                        echo "January ";
                                                    }else if($accM[$i]==2){
                                                        echo "February ";
                                                      }else if($accM[$i]==3){
                                                          echo "March ";
                                                      }else if($accM[$i]==4){
                                                          echo "April ";
                                                      }else if($accM[$i]==5){
                                                          echo "May ";
                                                      }else if($accM[$i]==6){
                                                          echo "June ";
                                                      }else if($accM[$i]==7){
                                                          echo "July ";
                                                      }else if($accM[$i]==8){
                                                          echo "August ";
                                                      }else if($accM[$i]==9){
                                                          echo "September ";
                                                      }else if($accM[$i]==10){
                                                          echo "October ";
                                                      }else if($accM[$i]==11){
                                                          echo "November ";
                                                      }else if($accM[$i]==12){
                                                          echo "December ";
                                                      }
                                              }?>
                                            </td>
                                        </tr>
                                        <tr id="resulttr">
                                            <th id="resultth">CV</th>
                                            <?php
                                                                    if($rows['fileName']==NULL){ ?>
                                            <td id="resulttd">No CV uploaded!</td>
                                            <?php 
                                                                    }else {
                                                                    ?>
                                            <td id="resulttd">
                                                <a href="/wp-content/themes/consultup-child/uploaded_files/<?php echo "{$rows['fileName']}"?>">View Your Resume</a>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
        <!--    -----------------------Show apply history-----------Top--------------------->
                                    <br>
                                    <h3>Apply History</h3><br>
                                    <?php   
                                    $applicationI=$rows['applicationID'];
                                    if (empty($applicationI)){
                                        echo "<h4>You did not apply any school currently</h4>";
                                        echo "<a href=\"/wp-content/themes/consultup-child/index.php\">Go to search and apply</a>";
                                        exit;
                                    }else{
                                     echo "<table style=\"text-align: center; width: 1000px;\" id=\"resulttable\">";
                                              echo"
                                                    <tr id=\"resulttr\">
                                                        <th id=\"resultth\">No.</th>
                                                        <th id=\"resultth\">Country</th>
                                                        <th id=\"resultth\">Subject</th>
                                                        <th id=\"resultth\">School Name</th>
                                                        <th id=\"resultth\">Phone</th>
                                                        <th id=\"resultth\">Email</th>
                                                        <th id=\"resultth\">Contact Person</th>
                                                        <th id=\"resultth\">Application Status</th>
                                                        <th id=\"resultth\">Details</th>
                                                    </tr>
                                                ";
                                        }
                                                $applyid=array();
                                                $applyid=explode(',',$applicationI);
                                                $no=1;
                                                for($i=0;$i<count($applyid);$i++){
                                                    
                                                    $applicationI=$applyid[$i];
                                                    $sql = "SELECT * FROM aamt_applications where id='$applicationI'";  
                                                    $resultsApp=mysqli_query($conn, $sql);  
                                                    if (!$resultsApp){
                                                        die('Cannot read data:'.mysqli_error());
                                                    }
                                                    $rowsApply=mysqli_num_rows($resultsApp);
                                                
                                                    if ($rowsApply == 0){
                                                        echo "<h4>You did not apply any school currently</h4>";
                                                        echo "<a href=\"/wp-content/themes/consultup-child/index.php\">Go to search and apply</a>";
                                                    }
                                                    while($rowsApply = mysqli_fetch_assoc($resultsApp)){
                                                        $applyT=$rowsApply['applyTo'];
                                                        
                                                    $sql = "SELECT * FROM aamt_registerschool where id='$applyT'";  
                                                
                                                    $results=mysqli_query($conn, $sql);  
                                                    if (!$results){
                                                        die('Cannot read data:'.mysqli_error());
                                                    }
                                                    $rowsApply2=mysqli_num_rows($results);          

                                                    if ($rowsApply2 == 0){
                                                        echo "<h4>You did not apply any school currently</h4>";
                                                        echo "<a href=\"/wp-content/themes/consultup-child/index.php\">Go to search and apply</a>";
                                                    }    

                                                    if($rowsApply2){//0 false 1 true 

                                                        
                                                        while($rowsApply2 = mysqli_fetch_assoc($results)){
                                                                    echo"
                                                                        <tr id=\"resulttr\">
                                                                            <td id=\"resulttdd\">{$no}</td>
                                                                            <td id=\"resulttdd\">{$rowsApply2['country']}</td>
                                                                            <td id=\"resulttdd\">";
                                                                            
                                                                                if($rowsApply['subject']==1){
                                                                                    echo "STEM";
                                                                                }else if($rowsApply['subject']==2){
                                                                                    echo "Problem-solving";
                                                                                }else if($rowsApply['subject']==3){
                                                                                    echo "Inquiry-based learning";
                                                                                }else if($rowsApply['subject']==4){
                                                                                    echo "Early years numeracy";
                                                                                }else if($rowsApply['subject']==5){
                                                                                    echo "Junior maths";
                                                                                }else if($rowsApply['subject']==6){
                                                                                    echo "Middle years maths";
                                                                                }else if($rowsApply['subject']==7){
                                                                                    echo "Senior maths";
                                                                                }else if($rowsApply['subject']==8){
                                                                                    echo "Maths projects";
                                                                                }else if($rowsApply['subject']==9){
                                                                                    echo "Exam preparation";
                                                                                }else if($rowsApply['subject']==10){
                                                                                    echo "General maths";
                                                                                }else if($rowsApply['subject']==11){
                                                                                    echo "Mastery approach";
                                                                                }
                                        
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            echo "</td>
                                                                            <td id=\"resulttdd\">{$rowsApply2['schoolName']}</td>
                                                                            <td id=\"resulttdd\">+{$rowsApply2['countryCode']}&nbsp;{$rowsApply2['phone']}</td>
                                                                            <td id=\"resulttdd\">{$rowsApply2['email']}  </td>
                                                                            <td id=\"resulttdd\" style=\"text-transform: capitalize\">{$rowsApply2['firstName']}&nbsp;{$rowsApply2['lastName']}</td>
                                                                            <td id=\"resulttdd\"> ";

                                                                            if($rowsApply['approval']==1){
                                                                                    echo "Approved";
                                                                                }elseif($rowsApply['approval']==2){
                                                                                    echo "Rejected";
                                                                                }else{
                                                                                    echo "Processing";
                                                                                }
                                                                            $a=1;
                                                                            echo"
                                                                            </td>
                                                                            
                                                                            <form action=\"/wp-content/themes/consultup-child/apply.php?toid={$applyT}&page={$a}\" method=\"post\"> 
                                                                            <input type=\"text\" name=\"username\" value=\"{$name}\" hidden/>
                                                                            <input type=\"password\" name=\"password\" value=\"{$password}\" hidden/>
                                                                            <td id=\"resulttdd\"><input type=\"submit\" name=\"submit\" value=\"See Details\"/></td>
                                                                            </form>
                                                                            </tr>";
                                                                     
                                                                }
                                                    }
                                                    }
                                                    $no++;

                                         }
                                        echo "</table>";    
                                    
                ?>



        <!--    -----------------------Show apply history----------Bottom---------------------->
        <?php           
                                }else{
                        ?>
        <table width="70%">
            <tr>
                <td>
                    <h2>School Contact</h2>
                </td>        
            </tr>
        </table><br>
        <table id="resulttable">
            <tr id="resulttr">
                <th id="resultth">Name</th>
                <td id="resulttd" style="text-transform: capitalize"><?php echo "{$rows['firstName']}"?>&nbsp;<?php echo "{$rows['lastName']}"?></td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">Email</th>
                <td id="resulttd"><?php echo "{$rows['email']}"?></td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">Phone</th>
                <td id="resulttd">+<?php echo "{$rows['countryCode']}"?>&nbsp;<?php echo "{$rows['phone']}"?></td>
            </tr>
            
            <tr id="resulttr">
                <th id="resultth">Position</th>
                <td id="resulttd"><?php echo "{$rows['position']}"?></td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">Department</th>
                <td id="resulttd">
                    <?php  
                                   $dept=array();
                                    $dept=explode(',',$rows['department']);
                                    for($i=0;$i<count($dept);$i++){
                                        if($dept[$i]==1){
                                            echo "STEM; ";
                                        }else if($dept[$i]==2){
                                            echo "Problem-solving; ";
                                          }else if($dept[$i]==3){
                                              echo "Inquiry-based learning; ";
                                          }else if($dept[$i]==4){
                                              echo "Early years numeracy; ";
                                          }else if($dept[$i]==5){
                                              echo "Junior maths; ";
                                          }else if($dept[$i]==6){
                                              echo "Middle years maths; ";
                                          }else if($dept[$i]==7){
                                              echo "Senior maths; ";
                                          }else if($dept[$i]==8){
                                              echo "Maths projects; ";
                                          }else if($dept[$i]==9){
                                              echo "Exam preparation; ";
                                          }else if($dept[$i]==10){
                                              echo "General maths; ";
                                          }else if($dept[$i]==11){
                                              echo "Mastery approach; ";
                                          }
                        }?>
                </td>
            </tr>
            


        </table><br>
        <h2>School details</h2> <br>
        <table id="resulttable">
            <tr id="resulttr">
                <th id="resultth">School Name</th>
                <td id="resulttd"><?php echo "{$rows['schoolName']}"?></td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">School Address</th>
                <td id="resulttd"><?php echo "{$rows['schoolAddress']}"?>&nbsp;<?php echo "{$rows['city']}"?>&nbsp;<?php echo "{$rows['state']}"?>&nbsp;<?php echo "{$rows['country']}"?></td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">School Level</th>

                <td id="resulttd">
                    <?php
                                    $schoolL=array();
                                    $schoolL=explode(',',$rows['schoolLevel']);
                                    for($i=0;$i<count($schoolL);$i++){
                                        if($schoolL[$i]==1){
                                            echo "Early Year";
                                        }else if($schoolL[$i]==2){
                                            echo "Primary";
                                        }else if($schoolL[$i]==3){
                                            echo "Secondary";
                                        }else if($schoolL[$i]==4){
                                            echo "Senior";
                                        }else if($schoolL[$i]==5){
                                            echo "Tertiary";
                                        }
                                    }?>

                </td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">School Type</th>
                <td id="resulttd">
                    <?php  
                                    $schoolT=array();
                                    $schoolT=explode(',',$rows['schoolType']);
                                    for($i=0;$i<count($schoolT);$i++){
                                        if($schoolT[$i]==1){
                                            echo "School";
                                        }else if($schoolT[$i]==2){
                                            echo "College";
                                        }else if($schoolT[$i]==3){
                                            echo "University";
                                        }else if($schoolT[$i]==4){
                                            echo "Institution";
                                        }
                                    }
                                    ?>
                </td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">School Size</th>
                <td id="resulttd">
                    <?php  
                                    $schoolS=array();
                                    $schoolS=explode(',',$rows['schoolSize']);
                                    for($i=0;$i<count($schoolS);$i++){
                                        if($schoolS[$i]==1){
                                            echo "Small";
                                        }else if($schoolS[$i]==2){
                                            echo "Medium";
                                        }else if($schoolS[$i]==3){
                                            echo "Large";
                                        }
                                    }
                                    ?>
                </td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">Host Visiting</th>
                <td id="resulttd">
                    <?php  
                                    $HostV=array();
                                    $HostV=explode(',',$rows['hostVisiting']);
                                    for($i=0;$i<count($HostV);$i++){
                                        if($HostV[$i]==1){
                                            echo "I would like to host visiting teachers";?><br>
                    <?php }else if($HostV[$i]==2){
                                            echo "I would like to host visiting students";?>
                    <?php }
                                    }
                                    ?>
                </td>
            </tr>
            <tr id="resulttr">
                <th id="resultth">Accomodation Months</th>
                <td id="resulttd">
                    <?php  
                                    $accM=array();
                                    $accM=explode(',',$rows['accommodateMonths']);
                                    for($i=0;$i<count($accM);$i++){
                                        if($accM[$i]==1){
                                            echo "January ";
                                        }else if($accM[$i]==2){
                                            echo "February ";
                                          }else if($accM[$i]==3){
                                              echo "March ";
                                          }else if($accM[$i]==4){
                                              echo "April ";
                                          }else if($accM[$i]==5){
                                              echo "May ";
                                          }else if($accM[$i]==6){
                                              echo "June ";
                                          }else if($accM[$i]==7){
                                              echo "July ";
                                          }else if($accM[$i]==8){
                                              echo "August ";
                                          }else if($accM[$i]==9){
                                              echo "September ";
                                          }else if($accM[$i]==10){
                                              echo "October ";
                                          }else if($accM[$i]==11){
                                              echo "November ";
                                          }else if($accM[$i]==12){
                                              echo "December ";
                                          }
                                  }?>
                </td>
            </tr>

        </table>
        <?php
                                }
                        ?>

        

</div>
            <div class="col-md-6 login-right">
            <h2>
                Welcome&nbsp;
                        <font style="text-transform: capitalize; color: cornflowerblue;">
                            <?php
                                if(!empty($rows['title'])){
                                    if($rows['title'] ==1){
                                        echo "Mr";
                                    }
                                    if($rows['title'] ==2){
                                        echo "Miss";
                                    }
                                    if($rows['title'] ==3){
                                        echo "Mrs";
                                    }
                                    if($rows['title'] ==4){
                                        echo "Ms";
                                    }
                                    if($rows['title'] ==5){
                                        echo "Dr";
                                    }
                                    
                                    echo " {$rows['lastName']}";
                                }else{
                                    echo "{$rows['firstName']}";
                                }
                            ?>
                        </font>&nbsp;Login
            
            </h2>

            <br>
            <p><a href="/wp-content/themes/consultup-child/logout.php">Log out</a></p>
            <p><a href="/wp-content/themes/consultup-child/userProfile.php">Update Profile</a></p>
            <?php if(empty($rows['title'])){ ?>
                <p><a href="/wp-content/themes/consultup-child/allApplicationsforSchool.php?toid=<?php echo $rows['id'];?>">See Exchange Applications</a></p>
            <?php } ?>
            
        </div>
        </div>
        </div>

        </main>
        <?php
        get_footer();
        ?>


        <?php
          }
                                exit;
                            }      
                        }else{
                            header("location:/wp-content/themes/consultup-child/login.php?error=2");
                            exit;
                        }
                        mysqli_close($conn);
                    ?>



        <?php
                        class checkLogin  
                        {                
                            var $name; 
                            var $pwd;

                            function checkLogin($x,$y)			
                            {
                                $this->name=$x;
                                $this->pwd=$y;
                            } 
                            function checkUsernamePwd()
                            {

                                include("conndb.php");  
                                $q="select email,password from aamt_registerSchool where email='".$this->name."' and password='".$this->pwd."'";
                                $s = $conn->query($q);
                                $info=$s->num_rows;

                                if($info==0)					
                                {   
                                    $_SESSION["admin"] = false;
                                    header("location:/wp-content/themes/consultup-child/login.php?error=1");
                                    exit;
                                }else{
                                    
                                }
                            }
                        } 
                        $obj=new checkLogin($name,$password); 
                        $obj->checkUsernamePwd();   
     }else{
                        header("location:/wp-content/themes/consultup-child/login.php?error=3");
                            
        
        
    }
                    ?>