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
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    
                    $position = $_POST['position'];
                    $schoolName = $_POST['schoolName'];
                    $schoolAddress = $_POST['schoolAddress'];
                    $state = $_POST['state'];
                    $city = $_POST['city'];
                    $schoolLevel = $_POST['schoolLevel'];
                    $schoolType = $_POST['schoolType'];
                    $country =  $_POST['country'];
                    $countryCode =  $_POST['countryCode'];
                    $schoolSize = $_POST['schoolSize'];
                    $searchEmail=$_SESSION['e'];
                    $hostVisiting = implode(',',$_POST['hostVisiting']);
                    $accommodateMonths = implode(',',$_POST['accommodateMonths']);
                    $department = implode(',', $_POST['department']);

//                    $file = $_FILES['file'];
//                    $fileName = $_FILES['file']['name'];
//                    $fileTmpName = $_FILES['file']['tmp_name'];
//                    $fileSize = $_FILES['file']['size'];
//                    $fileError = $_FILES['file']['error'];
//                    $fileType = $_FILES['file']['type'];
//
//                    $fileExt = explode('.', $fileName);
//
//                    $fileActualExt = strtolower(end($fileExt));
//
//                    $allowed = array('jpg','jpeg','png','pdf','txt','doc','docx');
//
//                    if(in_array($fileActualExt,$allowed)){
//                        if($fileError == 0){
//                            if($fileSize<1000000){
//                                $newfileName = $email."_cv".".".$fileActualExt;
//                                $fileDestination ='uploaded_files/'.$newfileName;
//                                move_uploaded_file($fileTmpName,$fileDestination);
//
//                            }else{
//                                echo "too";
//                            }
//                        }else{
//                            echo "There are errors";
//                        }
//                    }
                              
                
                    if (!is_numeric($phone)){
                        header("location:userProfile.php?error=3");
                        exit; 
                    }
        
                    if(empty($newfileName)){
                        $newfileName = $_SESSION['fileName'];
                    }
                    
                    
                    if (!empty($firstName) & !empty($lastName) & !empty($password) & !empty($email) & !empty($phone) & !empty($department) & !empty($position) & !empty($schoolName) & !empty($schoolAddress) & !empty($state) & !empty($city) & !empty($schoolLevel) & !empty($schoolType) & !empty($schoolSize) & !empty($hostVisiting) & !empty($accommodateMonths) ) {
                        include("conndb.php");
                        $sql = "update aamt_registerschool set firstName='$firstName', lastName='$lastName', password='$password', email='$email', phone='$phone', department='$department', position='$position', schoolName='$schoolName', schoolAddress='$schoolAddress', country='$country', countryCode='$countryCode', state='$state', city='$city', schoolLevel='$schoolLevel', schoolType='$schoolType', schoolSize='$schoolSize', hostVisiting='$hostVisiting', accommodateMonths='$accommodateMonths' where id='$id'";
                    
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

                        $sql = "SELECT * FROM aamt_registerschool where id='$id'";
                        $results=mysqli_query($conn, $sql);
                        if (!$results){
                        die('Cannot read data:'.mysqli_error());
                        }
                        $rows=mysqli_num_rows($results);

                        if($rows){//0 false 1 true
   
                            while($rows = mysqli_fetch_assoc($results)){
                                $_SESSION['id']=$rows['id'];
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
                                $_SESSION['country']=$rows['country'];
                                $_SESSION['state']=$rows['state'];
                                $_SESSION['city']=$rows['city'];
                                $_SESSION['schoolLevel']=$rows['schoolLevel'];
                                $_SESSION['schoolType']=$rows['schoolType'];
                                $_SESSION['schoolSize']=$rows['schoolSize'];
                                $_SESSION['hostVisiting']=$rows['hostVisiting'];
                                $_SESSION['accommodateMonths']=$rows['accommodateMonths'];
                        ?>
               
                    
                    <table width="70%">
            <tr>
                <td>
                    <h3>School Contact</h3>
                </td>

            </tr>
        </table>
                  
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
        
                    </table>
                       <h3>School details</h3>
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
                            <th id="resultth">Host Visiting Months</th>
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
                            <th id="resultth">Accomodate Months</th>
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
             }

?>



                        </div>
            <div class="col-md-6 login-right">
                            <h2>
                               Welcome&nbsp;<font style="text-transform: capitalize; color: cornflowerblue;"><?php echo "{$_SESSION['firstName']}"?></font>&nbsp;Login
                            </h2>

                            <br>
                            <p><a href="/wp-content/themes/consultup-child/logout.php">Log out</a></p>
                            <p><a href="/wp-content/themes/consultup-child/userProfile.php">Update Profile</a></p>
                            <p><a href="/wp-content/themes/consultup-child/allApplicationsforSchool.php?toid=<?php echo $_SESSION['id'];?>">See all applications</a></p>
                           
                        </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>