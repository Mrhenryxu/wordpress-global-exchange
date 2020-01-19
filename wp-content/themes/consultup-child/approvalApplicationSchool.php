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
                 $s = "SELECT * FROM aamt_registerteacher where email='$fromemail'";  
                            $rs=mysqli_query($conn, $s);  
                            if (!$rs){
                                die('Cannot read data:'.mysqli_error());
                            }
                            $r=mysqli_num_rows($rs);   
                            if($r){//0 false 1 true 
                    
                            echo "<h3>The applicant's detail is here: </h3><br>";
                              echo "<table id=\"resulttable\">";
                              echo"
                                    <tr id=\"resulttr\" >
                                        <th id=\"resultth\">Name</th>
                                        <th id=\"resultth\">Email Address</th>
                                        <th id=\"resultth\">Phone</th>
                                        <th id=\"resultth\">Address</th>
                                        <th id=\"resultth\">Exchange Months</th>
                                        <th id=\"resultth\">CV</th>
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
                                        <td id=\"resulttd\">{$r['address']}&nbsp;{$r['city']}&nbsp;{$r['state']}&nbsp;{$r['country']}</td>
                                        <td id=\"resulttd\">";
                                        $accM=array();
                                                $accM=explode(',',$r['exchangeMonths']);
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
                                              }
                                        
                                       echo "</td>";
                                        
                                     
                                       
            if($r['fileName']==NULL){?>
                <td id="resulttd">No CV uploaded!
                        </td>
            <?php 
                                       }else {
            ?>
                    <td id="resulttd"><a href="/wp-content/themes/consultup-child/uploaded_files/<?php echo "{$r['fileName']}"?>">View Resume</a>
                        </td>
            <?php } 
                                    
                        echo    "</tr></table>"; 



                    }
                               
                               
                         }?>
        
        <br><br>
        
        
<!--
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
                                            $dept=array();
                                            $dept=explode(',',$rows['department']);
                                            for($i=0;$i<count($dept);$i++){
                                                if($dept[$i]==1){
                                                    echo "January ";
                                                }else if($dept[$i]==2){
                                                    echo "February ";
                                                  }else if($dept[$i]==3){
                                                      echo "March ";
                                                  }else if($dept[$i]==4){
                                                      echo "April ";
                                                  }else if($dept[$i]==5){
                                                      echo "May ";
                                                  }else if($dept[$i]==6){
                                                      echo "June ";
                                                  }else if($dept[$i]==7){
                                                      echo "July ";
                                                  }else if($dept[$i]==8){
                                                      echo "August ";
                                                  }else if($dept[$i]==9){
                                                      echo "September ";
                                                  }else if($dept[$i]==10){
                                                      echo "October ";
                                                  }else if($dept[$i]==11){
                                                      echo "November ";
                                                  }else if($dept[$i]==12){
                                                      echo "December ";
                                                  }
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
-->
             
        <br><br>
        <?php
            $select="select * from aamt_applications where id='$applicationid'";
            $selectResults=mysqli_query($conn, $select);  
            $selectRows = mysqli_fetch_assoc($selectResults);
            $a= $selectRows['approvalSchool'];
        if($a==0){
        ?>
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?toid=<?php echo $selectRows['applyTo'];?>'">Do it later</button>
        
        <?php }
        if($a==1){
        ?>
        <h4>Currently Status: Approved</h4><br>
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?ar=reject&applicationid=<?php echo $applicationid;?>'">Reject</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?toid=<?php echo $selectRows['applyTo'];?>'">Do it later</button>
        
        <?php }
        if($a==2){
        ?>
        <h4>Currently Status: Rejected</h4><br>
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?ar=approve&applicationid=<?php echo $applicationid;?>'">Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="window.location.href='/wp-content/themes/consultup-child/allApplicationsforSchool.php?toid=<?php echo $selectRows['applyTo'];?>'">Do it later</button>
        
        <?php }
        
              ?>  <br>


        </div>
  


</main>
<?php
get_footer();
?>