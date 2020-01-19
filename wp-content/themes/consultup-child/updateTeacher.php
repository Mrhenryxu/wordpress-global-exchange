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
<head>
    <style type="text/css">
        #resulttable{
            
            border-collapse: collapse;
                 
        }
        #resultth{
            
            height: 50px;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: cornflowerblue;
            color: white;
            width: 155px;    
        }
        #resulttr{
            height: 50px;
        }
        #resulttd{
            height: 50px;
            padding-left: 50px;
            padding-right: 15px;
        }
        #resulttr:hover{background-color: #f5f5f5}
    </style>

</head>

<main id="content">
    <div class="container">
        <div class="login-grids">
            <div class="col-md-6 log">
                    <?php
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];
                    $state = $_POST['state'];
                    $city = $_POST['city'];
                    $searchEmail=$_SESSION['e'];
                    $exchangeMonths = implode(',',$_POST['exchangeMonths']);
                    $country =  $_POST['country'];
                    $countryCode =  $_POST['countryCode'];

                    $file = $_FILES['file'];
                    $fileName = $_FILES['file']['name'];
                    $fileTmpName = $_FILES['file']['tmp_name'];
                    $fileSize = $_FILES['file']['size'];
                    $fileError = $_FILES['file']['error'];
                    $fileType = $_FILES['file']['type'];

                    $fileExt = explode('.', $fileName);

                    $fileActualExt = strtolower(end($fileExt));

                    $allowed = array('jpg','jpeg','png','pdf','txt','doc','docx');

                    if(in_array($fileActualExt,$allowed)){
                        if($fileError == 0){
                            if($fileSize<1000000){
                                $newfileName = $email."_cv".".".$fileActualExt;
                                $fileDestination ='uploaded_files/'.$newfileName;
                                move_uploaded_file($fileTmpName,$fileDestination);

                            }else{
                                echo "too";
                            }
                        }else{
                            echo "There are errors";
                        }
                    }
                              
                
                    if (!is_numeric($phone)){
                        header("location:userProfile.php?error=3");
                        exit; 
                    }
        
                    if(empty($newfileName)){
                        $newfileName = $_SESSION['fileName'];
                    }
                    
                    if (!empty($title) &!empty($firstName) & !empty($lastName) & !empty($password) & !empty($email) & !empty($phone) & !empty($address) &  !empty($state) & !empty($city) & !empty($exchangeMonths)) {
                        include("conndb.php");
                        $sql = "update aamt_registerTeacher set title='$title', firstName='$firstName', lastName='$lastName', password='$password', email='$email', phone='$phone', address='$address', country='$country', state='$state', countryCode='$countryCode', city='$city', exchangeMonths='$exchangeMonths', fileName='$newfileName' where id='$id'";
                    
                        $results=mysqli_query($conn, $sql);
                        
                        if (!$results){
                        header("location:userProfile.php?error=1");
                        exit;
                        }

                        }else{
                        header("location:userProfile.php?error=2");
                        exit;

                        }

                        if (($_SESSION['email']!=$email)||($_SESSION['password']!=$password)){
                        session_destroy();
                        header("location:/wp-content/themes/consultup-child/login.php?toid=$toid&error=5");    
                        exit;
                        }
                        $sql = "SELECT * FROM aamt_registerTeacher where id='$id'";
                        $results=mysqli_query($conn, $sql);
                        if (!$results){
                            die('Cannot read data:'.mysqli_error());
                        }
                        $rows=mysqli_num_rows($results);

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
                                $_SESSION['address']=$rows['address'];
                                $_SESSION['country']=$rows['country'];
                                $_SESSION['state']=$rows['state'];
                                $_SESSION['city']=$rows['city'];
                                $_SESSION['exchangeMonths']=$rows['exchangeMonths'];
                                $_SESSION['fileName']=$rows['fileName'];
                        ?>

                        
                            <table width="500">
                                            <tr>
                                                <td width="100">
                                                    <h3>Your Details</h3>
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
                            <br><h3>Apply History</h3><br>
                                    <?php   
                                    $applicationI=$rows['applicationID'];
                                    if (empty($applicationI)){
                                        echo "<h4>You did not apply any school currently</h4>";
                                        echo "<a href=\"/wp-content/themes/consultup-child/index.php\">Go to search and apply</a>";
                                        exit;
                                    }else{
                                     echo "<table style=\"text-align: center; width: 1000px;\" id=\"resulttable\">";
                                              echo"
                                                    <tr id=\"resulttr\" >
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
                                                    $rows=mysqli_num_rows($results);          

                                                    if ($rows == 0){
                                                        echo "<h4>You did not apply any school currently</h4>";
                                                        echo "<a href=\"/wp-content/themes/consultup-child/index.php\">Go to search and apply</a>";
                                                    }    

                                                    if($rows){//0 false 1 true 

                                                        
                                                        while($rows = mysqli_fetch_assoc($results)){
                                                                    echo"
                                                                        <tr id=\"resulttr\">
                                                                            <td id=\"resulttdd\">{$no}</td>
                                                                            <td id=\"resulttdd\">{$rows['country']}</td>
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
                                                                            <td id=\"resulttdd\">{$rows['schoolName']}</td>
                                                                        ";

                                                                            echo"
                                                                            <td id=\"resulttdd\">+{$rows['countryCode']}&nbsp;{$rows['phone']}</td>
                                                                            <td id=\"resulttdd\">{$rows['email']}  </td>
                                                                            <td id=\"resulttdd\" style=\"text-transform: capitalize\">{$rows['firstName']}&nbsp;{$rows['lastName']}</td>
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

                                
                    <?php
                        }
                   
                    }

                    ?>

                </div>
            <div class="col-md-6 login-right">
            <h2>
               Welcome<font style="text-transform: capitalize; color: cornflowerblue;">
                                <?php
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
                            
                                echo" {$rows['lastName']}";?></font>&nbsp;Login
            
            </h2>

            <br>
            <p><a href="/wp-content/themes/consultup-child/logout.php">Log out</a></p>
            <p><a href="/wp-content/themes/consultup-child/userProfile.php">Update Profile</a></p>
            
        </div>
        </div> 
    </div>
</main>
<?php
get_footer();
?>