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
      
        
                <h2>Approval for a co-teaching opportunity</h2><br>
                
                <?php
                 $toid=$_GET['toid'];
          
                $fromemail = $_GET['fromemail'];
            $applicationid= $_GET['applicationid'];
                include("conndb.php");
        $select="select * from aamt_applications where id='$applicationid'";
            $selectResults=mysqli_query($conn, $select);  
            $selectRows = mysqli_fetch_assoc($selectResults);
            $a = $selectRows['approval'];
            $b = $selectRows['checked'];
                 $s = "SELECT * FROM aamt_registerteacher where email='$fromemail'";  
                            $rs=mysqli_query($conn, $s);  
                            if (!$rs){
                                die('Cannot read data:'.mysqli_error());
                            }
                            $r=mysqli_num_rows($rs);   
                            if($r){//0 false 1 true 
                    
                            echo "<h3>The customer's detail is here: </h3><br>";
                              echo "<table id=\"resulttable\">";
                              echo"
                                    <tr id=\"resulttr\" >
                                        <th id=\"resultth\">Name</th>
                                        <th id=\"resultth\">Email Address</th>
                                        <th id=\"resultth\">Phone</th>
                                        <th id=\"resultth\">School Address</th>
                                        <th id=\"resultth\">CV</th>
                                        <th id=\"resultth\">School Response</th>
                                    </tr>
                                ";


                    while($r = mysqli_fetch_assoc($rs)){
                                $firstname=$r['firstName'];
                                $lastName=$r['lastName'];
                                $email=$r['email'];
                                $countryCode=$r['countryCode'];
                                $phone=$r['phone'];
                                echo"
                                    <tr id=\"resulttr\">
                                        <td id=\"resulttd\">{$r['firstName']}&nbsp;{$r['lastName']}</td>
                                        <td id=\"resulttd\">{$r['email']}</td>
                                        <td id=\"resulttd\">{$r['countryCode']}{$r['phone']}</td>
                                        <td id=\"resulttd\">{$r['address']}&nbsp;{$r['city']}&nbsp;{$r['state']}&nbsp;{$r['country']}</td>";
                                       
            if($r['fileName']==NULL){?>
                <td id="resulttd">No CV uploaded!
                        </td>
            <?php 
                                       }else {
            ?>
                    <td id="resulttd"><a href="/wp-content/themes/consultup-child/uploaded_files/<?php echo "{$r['fileName']}"?>">View Resume</a>
                        </td>
            <?php } 
                        
                        
                      echo "<td id=\"resulttd\">";
                                if ($selectRows['approvalSchool']==0){              
                                    echo "No response";
                                }
                                   if ($selectRows['approvalSchool']==1){
                                    echo "Approved";
                                }
                                   if ($selectRows['approvalSchool']==2){
                                    echo "Rejected";
                                }
                                   echo "</td></tr></table>"; 
                    }                                            
                         }
        ?>    
        <br><br>             
        <?php        
                
                $sql = "SELECT * FROM aamt_registerschool where id='$toid'";  
                $results=mysqli_query($conn, $sql);  
                if (!$results){
                    die('Cannot read data:'.mysqli_error());
                }
                $rows=mysqli_num_rows($results);          
        
                if($rows){//0 false 1 true 
                    
                            echo "<h3>The school detail the customer want to apply for: </h3><br>";
                              echo "<table id=\"resulttable\">";
                              echo"
                                    <tr id=\"resulttr\" >
                                        <th id=\"resultth\">Country</th>
                                        <th id=\"resultth\">Subject</th>
                                        <th id=\"resultth\">School Name</th>
                                        <th id=\"resultth\">School Level</th>
                                        <th id=\"resultth\">School Type</th>
                                        <th id=\"resultth\">School Size</th>
                                        <th id=\"resultth\">School Address</th>
                                        <th id=\"resultth\">Phone</th>
                                        <th id=\"resultth\">Email</th>
                                        <th id=\"resultth\">Contact Person</th>
                                        
                                    </tr>
                                ";


                    while($rows = mysqli_fetch_assoc($results)){
                                
                                echo"
                                <tr id=\"resulttr\">
                                    <td id=\"resulttd\">{$rows['country']}</td>
                                    <td id=\"resulttd\">";

                                        if($selectRows['subject']==1){
                                        echo "STEM";
                                        }else if($selectRows['subject']==2){
                                        echo "Problem-solving";
                                        }else if($selectRows['subject']==3){
                                        echo "Inquiry-based learning";
                                        }else if($selectRows['subject']==4){
                                        echo "Early years numeracy";
                                        }else if($selectRows['subject']==5){
                                        echo "Junior maths";
                                        }else if($selectRows['subject']==6){
                                        echo "Middle years maths";
                                        }else if($selectRows['subject']==7){
                                        echo "Senior maths";
                                        }else if($selectRows['subject']==8){
                                        echo "Maths projects";
                                        }else if($selectRows['subject']==9){
                                        echo "Exam preparation";
                                        }else if($selectRows['subject']==10){
                                        echo "General maths";
                                        }else if($selectRows['subject']==11){
                                        echo "Mastery approach";
                                        }






                                        echo "</td>
                                    <td id=\"resulttd\">{$rows['schoolName']}</td>
                                    <td id=\"resulttd\">
                                        ";
                                        $schoolL=array();
                                    $schoolL=explode(',',$rows['schoolLevel']);
                                    for($i=0;$i<count($schoolL);$i++){
                                        if($schoolL[$i]==1){
                                            echo "Primary";
                                        }else if($schoolL[$i]==2){
                                            echo "Secondary";
                                        }else if($schoolL[$i]==3){
                                            echo "Tertiary";
                                        }
                                    }
                                        
                                        echo"
                                        </td>
                                        <td id=\"resulttd\">";
                                        
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
                                        
                                        echo"
                                        </td>
                                        <td id=\"resulttd\">";
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
                                        echo"
                                        </td>
                                        <td id=\"resulttd\">{$rows['schoolAddress']} {$rows['city']} {$rows['state']} {$rows['country']}</td>
                                        <td id=\"resulttd\">+{$rows['countryCode']}&nbsp;{$rows['phone']}</td>
                                        <td id=\"resulttd\">{$rows['email']}  </td>
                                        <td id=\"resulttd\" style=\"text-transform: capitalize\">{$rows['firstName']}&nbsp;{$rows['lastName']}</td></tr>";
                            }
                            echo "</table>"; 




                               
                               
                         }

                ?>
             
        <br><br>
        <?php
            
        if($a==0){
            if($b==0){ ?>
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=checked&applicationid=<?php echo $applicationid;?>'">Send to school</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>
        <?php    
        }else{ ?>
              <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>  
          <?php  } 
        }
        if($a==1){
            if($b==0){ ?>
                <h4>Currently Status: Approved</h4><br>
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=checked&applicationid=<?php echo $applicationid;?>'">Send to school</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>
           <?php }else{ ?>
                <h4>Currently Status: Approved</h4><br>
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>
           <?php } 
        }
        if($a==2){
            if($b==0){?>
                <h4>Currently Status: Rejected</h4><br>
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=checked&applicationid=<?php echo $applicationid;?>'">Send to school</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>
           <?php }else{ ?>
                <h4>Currently Status: Rejected</h4><br>
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplications.php'">Do it later</button>
            <?php }
        }
        
              ?>  <br>


        </div>
  


</main>
<?php
get_footer();
?>