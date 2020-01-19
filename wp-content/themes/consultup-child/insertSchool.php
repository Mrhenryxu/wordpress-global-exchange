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
                    <?php
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $countryCode = $_POST['countryCode'];
                    $phone = $_POST['phone'];

                    $position = $_POST['position'];
                    $schoolName = $_POST['schoolName'];
                    $schoolAddress = $_POST['schoolAddress'];
                    $country = $_POST['country'];
                    $state = $_POST['state'];
                    $city = $_POST['city'];
                    $schoolLevel = $_POST['schoolLevel'];
                    $schoolType = $_POST['schoolType'];
                    $schoolSize = $_POST['schoolSize'];
                    $hostVisiting = implode(',',$_POST['hostVisiting']);
                    $accommodateMonths = implode(',',$_POST['accommodateMonths']);                   
                    $department = implode(',', $_POST['department']);
//                  $file = $_FILES['file'];
//        $fileName = $_FILES['file']['name'];
//        $fileTmpName = $_FILES['file']['tmp_name'];
//        $fileSize = $_FILES['file']['size'];
//        $fileError = $_FILES['file']['error'];
//        $fileType = $_FILES['file']['type'];
//
//        $fileExt = explode('.', $fileName);
//        
//        $fileActualExt = strtolower(end($fileExt));
//
//        $allowed = array('jpg','jpeg','png','pdf','txt','doc','docx');
//
//        if(in_array($fileActualExt,$allowed)){
//            if($fileError == 0){
//                if($fileSize<1000000){
//                    $newfileName = $email."_cv".".".$fileActualExt;
//                    $fileDestination ='uploaded_files/'.$newfileName;
//                    move_uploaded_file($fileTmpName,$fileDestination);
//    
//                }else{
//                    echo "too";
//                }
//            }else{
//                echo "There are errors";
//            }
//        }
                    
                    $_SESSION['firstName']=$firstName;
                    $_SESSION['lastName']=$lastName;
                    $_SESSION['email']=$email;
                    $_SESSION['countryCode']=$countryCode;
                    $_SESSION['phone']=$phone;
                    $_SESSION['department']=$department;
                    $_SESSION['schoolName']=$schoolName;
                    $_SESSION['schoolAddress']=$schoolAddress;
                    $_SESSION['country']=$country;
                    $_SESSION['state']=$state;
                    $_SESSION['city']=$city;
                    $_SESSION['position']=$position;
                    $_SESSION['schoolLevel']=$schoolLevel;
                    $_SESSION['schoolType']=$schoolType;
                    $_SESSION['schoolSize']=$schoolSize;
                    $_SESSION['hostVisiting']=$hostVisiting;
                    $_SESSION['cv']=$newfileName;

                    if (!is_numeric($phone)){
                        header("location:schoolRegister.php?error=3");
                        exit; 
                    }           
                    if (!empty($firstName) & !empty($lastName) & !empty($password) & !empty($email) & !empty($countryCode) & !empty($phone) & !empty($department) & !empty($position) & !empty($schoolName) & !empty($schoolAddress) & !empty($country) & !empty($state) & !empty($city) & !empty($schoolLevel) & !empty($schoolType) & !empty($schoolSize) & !empty($hostVisiting) & !empty($accommodateMonths) ) {
                    include("conndb.php");

                    if (mysqli_connect_error()) {
                    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
                    } else {
                    $SELECT = "SELECT email From aamt_registerSchool Where email = ? Limit 1";
                    $INSERT = "INSERT Into aamt_registerSchool (id, firstname, lastname, password, email, countryCode, phone, department, position, schoolName, schoolAddress, country, state, city, schoolLevel, schoolType, schoolSize, hostVisiting, accommodateMonths) values(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    //Prepare statement
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($email);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;
                    if ($rnum==0) {
                        $stmt->close();
                        $stmt = $conn->prepare($INSERT);
                        $stmt->bind_param("sssssisssssssiiiss", $firstName, $lastName, $password, $email, $countryCode, $phone, $department, $position, $schoolName, $schoolAddress, $country, $state, $city, $schoolLevel, $schoolType, $schoolSize, $hostVisiting, $accommodateMonths);
                        echo $state, $city;
                        $stmt->execute();
                        if (!$stmt){
                            header("location:schoolRegister.php?error=1");
                            exit;
                        }
                    //echo "New record inserted sucessfully";
                    //$sql = "SELECT id, firstName, lastName FROM aamt_registerSchool";
                    //$result = $conn->query($sql);
                    //if ($result->num_rows > 0) {
                    //// output data of each row
                    //while($row = $result->fetch_assoc()) {
                    //echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
                    //}
                    //} else {
                    //echo "0 results";
                    //}
                    } else {
                        header("location:schoolRegister.php?error=4");
                        exit; 
                    }
                    $stmt->close();
                    $conn->close();
                    }
                    } else {
                        header("location:schoolRegister.php?error=2");
                        exit; 
                    }
                    ?>

                    <h3>
                        <h1>Registered Successfully, Please Login!</h1><br>
                    </h3>
                    <div class="strip"></div>
                    <p>
                        Welcome, please input your login details correctly!
                    </p>

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
                            <br>
                            <form action="loginned.php" method="post">
                                <table>
                                    <tr>
                                        <td style="font-size: 16px;">Username</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="text" name="username" required/></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px;">Password</td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><input type="password" name="password" required/></td>
                                    </tr>
                                    <tr>
                                        <td><button type="submit" name="submit" value="Login">Login</button></td>
                                        <td style="padding-left: 35px; padding-right: 15px;"><a href="forgotPwd.php">Forgot your Password ?</a></td>
                                    </tr>
                                    
                                </table>
                                
                            </form>
                </div>
            </div>
        </body>

        </html>




    </div>
</main>
<?php
get_footer();
?>