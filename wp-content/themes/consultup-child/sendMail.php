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
                    
                    <h1>An email has been sent to <?php echo $_POST['email'];?>! Please check your email to update your password! </h1>
                </div>
            </div>
        </body>
        </html>
    </div>
</main>





<?php
class checkForgotPwd  
{                
	var $checkEmail; 
 
	function checkForgotPwd($x)			
	{
		$this->checkEmail=$x;
    } 
	function checkEmail()
	{
        
		include("conndb.php");  
        $q="select email from aamt_registerSchool where email='".$this->checkEmail."'";
        $s = $conn->query($q);
        $info=$s->num_rows;
		
        if($info==0)					
		{      
            $q="select email from aamt_registerTeacher where email='".$this->checkEmail."'";
            $s = $conn->query($q);
            $info=$s->num_rows;
            if ($info == 0){
                header("location:forgotPwd.php?error=1");
			     exit;
            }
            
		}
	}
    
} 
if(isset($_POST["s1"])){
       $email = $_POST['email']; 
       $obj=new checkForgotPwd($email); 
$obj->checkEmail(); 
    }
                                                            
 
function dmail($mail_to,$mail_subject,$mail_body,$mail_from='',$mail_sign=true){
    $sendmail_from = 'wzhao@aamt.edu.au';//Your email address
    $sendmail_psw = 'zjr&&&*940309';//approval code
    $hostname = 'tls://smtp.gmail.com';
    $port=465;
    $mail_from = "=?utf-8?B?".base64_encode('Reset Password from AAMT').'?= <'.$sendmail_from.'>';
    $mail_subject = "=?utf-8?B?".base64_encode($mail_subject)."?=";   //Subject
    $mail_body = stripslashes($mail_body);                            //content
    $mail_body = chunk_split(base64_encode(str_replace("\r\n.", " \r\n..", str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $mail_body)))))));// let \n\r replace to \r
    //chunk_split will split string to small and less string
    $mail_dlmt="\r\n";// split
    $headers = '';
    $headers .= "From: $mail_from".$mail_dlmt;
    $headers .= "X-Priority: 3".$mail_dlmt;
    $headers .= "X-Mailer: ki".$mail_dlmt;
    $headers .= "MIME-Version: 1.0".$mail_dlmt;                        //MIME version
    $headers .= "Content-type: text/html; charset=utf-8".$mail_dlmt;   //content format
    $headers .= "Content-Transfer-Encoding: base64".$mail_dlmt;

    $host = $hostname.':'.$port.' ' ;
    if(!$fp=fsockopen($hostname,$port,$errno,$errmsg,30)){             
        echo "$host can not connect to the SMTP server";
        return;
    }
    stream_set_blocking($fp,true);
    $RE =fgets($fp,512);
    if(substr($RE,0,3) !='220'){
        echo 'ERROR'.$host.$RE;
        return 0;
    }

    fputs($fp,"EHLO ki\r\n");
    $RE = fgets($fp,512);
    if(substr($RE,0,3)!=220&&substr($RE,0,3) !=250){
        $errmsg = $host.'HELO/EHLO - '.$RE;
        echo $errmsg;
        return 0 ;
    }
    while(1){
        if(substr($RE,3,1) != '-' || empty($RE)) break;
        $RE = fgets($fp,512);
    }
    if(1){
        fputs($fp,"AUTH LOGIN\r\n");//check identity
        $RE = fgets($fp,512);
        if(substr($RE,0,3)!=334){
            exit("ERROR:$host AUTH LOGIN - $RE");
        }

        fputs($fp, base64_encode($sendmail_from)."\r\n");      //username must use base64 code
        $RE = fgets($fp, 512);//334 

        if(substr($RE, 0, 3) != 334) {
            $errmsg = $host.'USERNAME - '.$RE;
            exit($errmsg);
        }

        fputs($fp, base64_encode($sendmail_psw)."\r\n");       //password must use base64 code
        $RE = fgets($fp, 512);//235 Authentication successful

        if(substr($RE, 0, 3) != 235) {
            $errmsg = $host.'PASSWORD - '.$RE;
            exit($errmsg);
        }
        $mail_from = $sendmail_from;

    }

    fputs($fp,"MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/","\\1",$mail_from).">\r\n");    //tell receiver who is the sender 
    $RE = fgets($fp,512);
    if(substr($RE, 0, 3) != 250) { //if there is an error, send again
        fputs($fp, "MAIL FROM: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $mail_from).">\r\n");
        $RE = fgets($fp, 512);
        if(substr($RE, 0, 3) != 250) {
            $errmsg = $host.'MAIL FROM - '.$RE;
            exit($errmsg);
        }
    }

    foreach(explode(',',$mail_to) as $touser){
        $touser = trim($touser);
        if($touser){
            fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n"); //send to whom
            $RE = fgets($fp, 512);//250 Ok
            if(substr($RE, 0, 3) != 250) {
                fputs($fp, "RCPT TO: <".preg_replace("/.*\<(.+?)\>.*/", "\\1", $touser).">\r\n");
                $RE = fgets($fp, 512);
                $errmsg = $host.'RCPT TO - '.$RE;
                exit($errmsg);
            }
        }
    }

    fputs($fp, "DATA\r\n");                          //tell receiver what is the content
    $RE = fgets($fp, 512);
    if(substr($RE, 0, 3) != 354) {
        $errmsg = $host.'DATA - '.$RE;
        exit($errmsg);
    }
    //content
    list($msec, $sec) = explode(' ', microtime());
    $headers .= "Message-ID: <".date('YmdHis', $sec).".".($msec*1000000).".".substr($mail_from, strpos($mail_from,'@')).">".$mail_dlmt;
    fputs($fp, "Date: ".date('r')."\r\n");
    fputs($fp, "To: ".$mail_to."\r\n");
    fputs($fp, "Subject: ".$mail_subject."\r\n");
    fputs($fp, $headers."\r\n");
    fputs($fp, "\r\n\r\n");
    fputs($fp, "$mail_body\r\n.\r\n");
    $RE = fgets($fp, 512);//250 Ok: queued as 
    if(substr($RE, 0, 3) != 250) {
        $errmsg = $host.'END - '.$RE;
        exit($errmsg);
    }
    fputs($fp, "QUIT\r\n");                        //221 after input email content, execute this code
    return 'SUCCESS';
}




    include("conndb.php");
    $sql = "SELECT * FROM aamt_registerschool where email='$email'";  
    $results=mysqli_query($conn, $sql);  
    if (!$results){
        die('Cannot read data:'.mysqli_error());
    }
    $rows=mysqli_num_rows($results);   
    if($rows==0){
        $sql = "SELECT * FROM aamt_registerTeacher where email='$email'";  
        $results=mysqli_query($conn, $sql);  
        if (!$results){
            die('Cannot read data:'.mysqli_error());
        }
        $rows=mysqli_num_rows($results); 
        
    }
    while($rows = mysqli_fetch_assoc($results)){  
      $id=$rows['id']; 
      $firstName=$rows['firstName']; 
      $lastName=$rows['lastName']; 
    }
$header .= "Content-Type:text/html\r\n";

$token = base64_encode($id);

$url="http://localhost:8888/wp-content/themes/consultup-child/updatePwd.php?email=$email&token=$token";
$msg="Hi $firstName,<br/> Please click here to reset your password! ".$url."<br/> Kindly regards,<br/> AAMT Support Team";   
//echo $msg;
dmail("$email","Password reset from AAMT","$msg", $header);
?>
<br><br><br><br><br><br><br>

<?php
get_footer();
?>