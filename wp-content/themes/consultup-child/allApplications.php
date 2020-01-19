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
<?php 
function dmail($mail_to,$mail_subject,$mail_body,$mail_from='', $mail_sign=true){
    $sendmail_from = 'wzhao@aamt.edu.au';//Your email address
    $sendmail_psw = 'zjr&&&*940309';//approval code
    $hostname = 'tls://smtp.gmail.com';
    $port=465;
    $mail_from = "=?utf-8?B?".base64_encode('Application status updated').'?= <'.$sendmail_from.'>';
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

?>



<head>
    <style type="text/css">
        #resulttable {

            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            text-align: center;


        }

        #resultth {
            border: 1px solid black;
            height: 70px;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: cornflowerblue;
            color: white;

        }

        #resultthh {
            border: 1px solid black;
            height: 70px;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: #2367e2;
            color: white;

        }

        #resulttr {
            border: 1px solid black;
            height: 50px;


        }

        #resulttd {
            border: 1px solid black;
            height: 50px;
            padding-left: 15px;
            padding-right: 15px;
        }

        #resulttr:hover {
            background-color: #f5f5f5
        }
    </style>

</head>


<main id="content">
    <div class="container">


     

        <?php
    include("conndb.php");
    $ar=$_GET['ar'];
    $applicationid=$_GET['applicationid'];
    

    $results=mysqli_query($conn, "select * from aamt_applications where id='$applicationid'");
    if (!$results){
    die('11211Cannot read data:'.mysqli_error());
    }
    $rows=mysqli_num_rows($results);

    while($rows = mysqli_fetch_assoc($results)){

    $toid=$rows['applyTo'];
    $fromid=$rows['applyFrom'];
    }
    $sql = "SELECT * FROM aamt_registerschool where id='$toid'";
    $results=mysqli_query($conn, $sql);
    if (!$results){
    die('2222Cannot read data:'.mysqli_error());
    }
    $rows=mysqli_num_rows($results);
    if($rows){
    while($rows = mysqli_fetch_assoc($results)){

    $firstName=$rows['firstName'];
    $lastName=$rows['lastName'];
    $schoolN=$rows['schoolName'];
    $schoolEmail=$rows['email'];
    }
    }

    $s = "SELECT * FROM aamt_registerteacher where id='$fromid'";
    $rs=mysqli_query($conn, $s);
    if (!$rs){
    die('3333Cannot read data:'.mysqli_error());
    }
    $r=mysqli_num_rows($rs);
    if($r){//0 false 1 true

    while($r = mysqli_fetch_assoc($rs)){
    $fromid=$r['id'];
    $applyID=$r['applicationID'];
    $email=$r['email'];
    $teacherFirstName=$r['firstName'];
    $teacherLastName=$r['lastName'];
    }

    }   
        
        
        if($ar=="reject"){
            $rejectsql="update aamt_applications set approval='2' where id='$applicationid'";
            $rejectResults=mysqli_query($conn, $rejectsql); 
            $header .= "Content-Type:text/html\r\n";
            $url="http://localhost:8888/wp-content/themes/consultup-child/login.php";
            $msg="Hi $teacherFirstName,<br/><br/> Your co-teaching opportunity application to $schoolN has been rejected!<br/>Please click here and login your account to see details:".$url."<br/> Kindly regards,<br/> AAMT Support Team";
            dmail("$email","Application for a co-teaching opportunity","$msg", $header);
        }
         if($ar=="approve"){
            $approvesql="update aamt_applications set approval='1' where id='$applicationid'";
            $rejectResults=mysqli_query($conn, $approvesql); 
            $header .= "Content-Type:text/html\r\n";
            $url="http://localhost:8888/wp-content/themes/consultup-child/login.php";
            $msg="Hi $teacherFirstName,<br/>Your co-teaching opportunity application to $schoolN has been approved!<br/>Please click here and login your account to see details:".$url."<br/>Kindly regards,<br/> AAMT Support Team";
            dmail("$email","Application for a co-teaching opportunity","$msg", $header);
        }   
        if($ar=="checked"){
        $rejectsql="update aamt_applications set checked='1' where id='$applicationid'";
        $rejectResults=mysqli_query($conn, $rejectsql);
        $header .= "Content-Type:text/html\r\n";
        $url="http://localhost:8888/wp-content/themes/consultup-child/approvalApplicationSchool.php?toid=$toid&fromemail=$email&applicationid=$applicationid";
        $msg="Hi $firstName,<br/>$teacherFirstName $teacherLastName wants to apply for a co-teaching opportunity with you! <br/>Please click here for more details: ".$url."<br/> Kindly regards,<br/> AAMT Support Team";
            dmail("$schoolEmail","Application for a co-teaching opportunity","$msg", $header);
        }
                
                 
                $allResultSql="SELECT * FROM aamt_applications";
                            $rs=mysqli_query($conn, $allResultSql);  
                            if (!$rs){
                                die('Cannot read data:'.mysqli_error());
                            }
                            $r=mysqli_num_rows($rs);   
                            if($r){//0 false 1 true 
                       
                          
                              echo "<h2>All Applications:</h2><br>
                              <table id=\"resulttable\">";
                              echo"
                                    <tr id=\"resulttr\">
                                     
                                        <th id=\"resultthh\" colspan=\"4\">Applicant Information</th>
                                      
                                        <th id=\"resultthh\" colspan=\"2\">To</th>
                                        
                                         <th id=\"resultthh\" colspan=\"4\">Status</th>
                                    </tr>
                                    <tr id=\"resulttr\" >
                                        <th id=\"resultth\">No.</th>
                                        <th id=\"resultth\">From Name</th>
                                        <th id=\"resultth\">Phone</th>
                                        <th id=\"resultth\">email</th>
                                        <th id=\"resultth\">To School Name</th>
                                        <th id=\"resultth\">School Address</th>
                                        <th id=\"resultth\">School response</th>
                                        <th id=\"resultth\">Response to Teacher</th>
                                        <th id=\"resultth\">Send to School</th>
                                        <th id=\"resultth\">See Details</th>
                                    </tr>
                                ";

                                    $no=1;
                    while($r = mysqli_fetch_assoc($rs)){
                       
                                $applyFrom=$r['applyFrom'];
                                $applyTo=$r['applyTo'];
                        
                        $applyFromSql = "SELECT * FROM aamt_registerteacher where id='$applyFrom'"; 
                        $applyToSql = "SELECT * FROM aamt_registerschool where id='$applyTo'"; 
                        $fromResults=mysqli_query($conn, $applyFromSql); 
                        $toResults=mysqli_query($conn, $applyToSql); 
                        if (!$fromResults){
                                die('Cannot read data:'.mysqli_error());
                            }else{
                            $fromRows=mysqli_num_rows($fromResults); 
                        }
                            
                        if (!$toResults){
                                die('Cannot read data:'.mysqli_error());
                            }
                            $toRows=mysqli_num_rows($toResults);
                        
                                echo"
                                    <tr id=\"resulttr\">";
                        
                        while($fromRows = mysqli_fetch_assoc($fromResults)){
                        
                            
                                     echo "<td id=\"resulttd\">$no</td>
                                     <td id=\"resulttd\">{$fromRows['firstName']}{$fromRows['lastName']}</td>
                                        <td id=\"resulttd\">+{$fromRows['countryCode']}&nbsp;{$fromRows['phone']}</td>
                                        <td id=\"resulttd\">{$fromRows['email']}</td>";
                                        
                        $no++;
                               while($toRows = mysqli_fetch_assoc($toResults)){   
                                   
                                        echo "<td id=\"resulttd\">{$toRows['schoolName']}</td>
                                        <td id=\"resulttd\">{$toRows['schoolAddress']}&nbsp;{$toRows['city']}&nbsp;{$toRows['state']}&nbsp;{$toRows['country']}</td>
                                        <td id=\"resulttd\">";
                                if ($r['approvalSchool']==0){              
                                    echo "No response";
                                }
                                   if ($r['approvalSchool']==1){
                                    echo "Approved";
                                }
                                   if ($r['approvalSchool']==2){
                                    echo "Rejected";
                                }
                                   echo "</td> 
                                        <td id=\"resulttd\">";
                                if ($r['approval']==0){
                                    
                               
        ?>
        <a href="/wp-content/themes/consultup-child/allApplications.php?ar=approve&applicationid=<?php echo $r['id'];?>">Approve</a>&nbsp;&nbsp;
        <a href="/wp-content/themes/consultup-child/allApplications.php?ar=reject&applicationid=<?php echo $r['id'];?>">Reject</a>
        <?php
                                }
                                   if ($r['approval']==1){
                                    ?>
        Approved
        <?php
                                }
                                   if ($r['approval']==2){
                                    ?>
        Rejected
        <?php
                                }
                                   echo "</td>
                                   <td id=\"resulttd\">";
        
                                       
                        if ($r['checked']==0){
                                    
                               
        ?>
        <a href="/wp-content/themes/consultup-child/allApplications.php?ar=checked&applicationid=<?php echo $r['id'];?>">Send</a>
        <?php
                                }
                                   if ($r['checked']==1){
                                    ?>
        Sent
        <?php
                                }
                                   echo "</td><td>";?>
        <a href="/wp-content/themes/consultup-child/approvalApplication.php?toid=<?php echo $toRows['id'];?>&fromemail=<?php echo $fromRows['email'];?>&applicationid=<?php echo $r['id'];?>">See details</a>

        <?php echo "</td>             
                    </tr>";
                                        
                                    
                            

                               }
                               }
                    }
                                  echo "</table>";
                               
                               
                         }else{
                                echo "<h2>There is no application!<h2/>";
                            }
       
        ?>

        <br><br>



        <br>




    </div>



</main>
<?php
get_footer();
?>