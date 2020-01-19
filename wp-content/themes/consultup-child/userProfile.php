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

<script type="text/javascript">
    $(function() {
        var n = "<?php echo $_SESSION['firstName']?>";
        if (n != "") {
            var country = document.getElementById("country");

            for (var i = 0; i < country.options.length; i++) {
                if (country.options[i].value == n) {
                    country.options[i].selected = true;
                    break;
                }
            }
        }
    });
</script>

<main id="content">
    <div class="container">  
        <div class="container">
            <h2> Update Profile </h2>
            <?php 
            if(!empty($_GET['error'])){
                $error=$_GET['error'];
                If($error==1){
                    Echo "<font color ='red'>Update error!</font>";
                }elseif ($error==2){
                    Echo "<font color ='red'>Please input all fields!</font>";
                }else{
                    Echo "<font color ='red'>Please input correct phone number!</font>";
                }
            }
            ?>
            <?php
            if(!empty($_SESSION['title'])){
                        ?>
                                <h3>Your Details</h3><br>
                                <form action="updateTeacher.php" method="post"  enctype="multipart/form-data">
                                    <input type="text" name="id" value="<?php echo $_SESSION['id']?>" hidden>
                                    <table id="resulttable">
                                    <tr id="resulttr">
                                        <th id="resultth">Title</th>
                                        <td id="resulttd">
                                            <select name="title" placeholder="Select Your Title" required>
                                                
                                                   <?php
                                                 if($_SESSION['title']=="1"){?>
                                                      <option value="1" selected>Mr</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="1">Mr</option>
                                                <?php }
                                                 if($_SESSION['title']=="2"){?>
                                                      <option value="2" selected>Miss</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="2">Miss</option>
                                                <?php }
                                                 ?>
                                                  <?php
                                                 if($_SESSION['title']=="3"){?>
                                                      <option value="3" selected>Mrs</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="3">Mrs</option>
                                                <?php }
                                                 ?> <?php
                                                 if($_SESSION['title']=="4"){?>
                                                      <option value="4" selected>Ms</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="4">Ms</option>
                                                <?php }?><?php
                                                 if($_SESSION['title']=="5"){?>
                                                      <option value="5" selected>Dr</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="5">Dr</option>
                                                <?php }
                                               
                                                 ?>
                                            </select>

                                       </tr>
                                    <tr id="resulttr">
                                        <th id="resultth">Name</th>
                                        <td id="resulttd"><input type="text" name="firstName" placeholder="Firstname" value="<?php echo $_SESSION['firstName']?>" required>&nbsp;&nbsp;
                                            <input type="text" name="lastName"  placeholder="Lastname" value="<?php echo $_SESSION['lastName']?>" required></td>
                                    </tr>

                                    <tr id="resulttr">
                                        <th id="resultth">Password</th>
                                        <td id="resulttd"><input type="password" name="password" value="<?php echo $_SESSION['password']?>" required></td>

                                    </tr>

                                    <tr id="resulttr">
                                        <th id="resultth">Email</th>
                                        <td id="resulttd"><input type="email" name="email" value="<?php echo $_SESSION['email']?>" required></td>
                                    </tr> 

                                    <tr id="resulttr">
                                        <th id="resultth">Phone No.</th>
                                        <td id="resulttd">
                                           
                                            <select name="countryCode" placeholder="countryCode" required>
                        <!-- country codes (ISO 3166) and Dial codes. -->
                        
                            
                            
                             <?php
                                                 if($_SESSION['countryCode']=="61"){?>
                                                      <option value="61" selected>Australia (+61)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="61">Australia (+61)</option>
                                                <?php }
                                                 if($_SESSION['countryCode']=="1"){?>
                                                      <option value="1" selected>Canada (+1)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="1">Canada (+1)</option>
                                                <?php }
                                                 ?>
                                                  <?php
                                                 if($_SESSION['countryCode']=="86"){?>
                                                      <option value="86" selected>China (+86)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="86">China (+86)</option>
                                                <?php }
                                                 ?> <?php
                                                 if($_SESSION['countryCode']=="65"){?>
                                                      <option value="65" selected>Singapore (+65)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="65">Singapore (+65)</option>
                                                <?php }?><?php
                                                 if($_SESSION['countryCode']=="44"){?>
                                                      <option value="44" selected>UK (+44)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="44">UK (+44)</option>
                                                <?php }
                                                if($_SESSION['countryCode']=="1(US)"){?>
                                                      <option value="1(US)" selected>USA (+1)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="1(US)">USA (+1)</option>
                                                <?php }
                                               
                                                 ?>
                    </select>
                                            
                                            
                                            
                                            
                                            
                                            <input type="text" name="phone" value="<?php echo $_SESSION['phone']?>"></td>
                                    </tr>
                                    <tr id="resulttr">
                                            <th id="resultth">Address</th>
                                            <td id="resulttd"><input type="text" name="address" value="<?php echo $_SESSION['address']?>"></td>
                                    </tr>

                                    <tr id="resulttr"><th id="resultth">Country</th>
                                        <td id="resulttd">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <select name="country" placeholder="country" required>
                                                        
                                                         <?php
                                                 if($_SESSION['country']=="AU"){?>
                                                      <option value="AU" selected>Australia</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="AU">Australia</option>
                                                <?php }
                                                 if($_SESSION['country']=="CA"){?>
                                                      <option value="CA" selected>Canada</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="CA">Canada</option>
                                                <?php }
                                                 ?>
                                                  <?php
                                                 if($_SESSION['country']=="CN"){?>
                                                      <option value="CN" selected>China</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="CN">China</option>
                                                <?php }
                                                 ?> <?php
                                                 if($_SESSION['country']=="SG"){?>
                                                      <option value="SG" selected>Singapore</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="SG">Singapore</option>
                                                <?php }?><?php
                                                 if($_SESSION['country']=="GB"){?>
                                                      <option value="GB" selected>UK</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="GB">UK</option>
                                                <?php }
                                                if($_SESSION['country']=="US"){?>
                                                      <option value="US" selected>USA</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="US">USA</option>
                                                <?php }
                                               
                                                 ?>
                                                        
                                                        
                                                        
                                                        </select>   <br>   
                                                        
                                                
                                                        
                                                        <input type="text" name="state" value="<?php echo $_SESSION['state']?>">
                                                        &nbsp;&nbsp;<input type="text" name="city" value="<?php echo $_SESSION['city']?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr id="resulttr">
                                            <th id="resultth">CV</th>
                                            <td id="resulttd">
                                                <?php 
                                                $cv = $_SESSION['fileName'];
                                                                 if(!$cv==NULL){
                                                                     echo "<a href=\"/wp-content/themes/consultup-child/uploaded_files/$cv\">View Your Resume</a>";

                                                                 }



                                                ?>
                                                <input type="file" name="file" id="file">

                                            </td>
                                    </tr>
                                    <tr id="resulttr">
                                                <fieldset>  
                                                   <table width="500" length="100" >

                                                       <tr> <legend>Which months in the year are you able to accommodate exchange visitors (Please reselect to keep up to date)?</legend>  </tr>
                                                       <tr>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['exchangeMonths'],'1') !== false){ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="1" checked="true" onclick="return ValidatePetSelection();"> January
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="1" onclick="return ValidatePetSelection();"> January
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['exchangeMonths'],'2') !== false){ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="2" checked="true" onclick="return ValidatePetSelection();">  February
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="2" onclick="return ValidatePetSelection();">  February
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['exchangeMonths'],'3') !== false){ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="3" checked="true" onclick="return ValidatePetSelection();">  March 
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="3" onclick="return ValidatePetSelection();">  March 
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['exchangeMonths'],'4') !== false){ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="4" checked="true" onclick="return ValidatePetSelection();">  April
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="4" onclick="return ValidatePetSelection();">  April
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['exchangeMonths'],'5') !== false){ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="5" checked="true" onclick="return ValidatePetSelection();">  May
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="exchangeMonths[]" value="5" onclick="return ValidatePetSelection();">  May
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'6') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="6" checked="true" onclick="return ValidatePetSelection();">  June
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="6" onclick="return ValidatePetSelection();">  June
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'7') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="7" checked="true" onclick="return ValidatePetSelection();">  July
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="7" onclick="return ValidatePetSelection();">  July
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'8') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="8" checked="true" onclick="return ValidatePetSelection();">  August
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="8" onclick="return ValidatePetSelection();">  August
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'9') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="9" checked="true" onclick="return ValidatePetSelection();">  September
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="9" onclick="return ValidatePetSelection();">  September
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'10') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="10" checked="true" onclick="return ValidatePetSelection();">  October
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="10" onclick="return ValidatePetSelection();">  October
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'11') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="11" checked="true" onclick="return ValidatePetSelection();">  November
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="11" onclick="return ValidatePetSelection();">  November
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['exchangeMonths'],'12') !== false){ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="12" checked="true" onclick="return ValidatePetSelection();">  December
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="exchangeMonths[]" value="12" onclick="return ValidatePetSelection();">  December
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>

                                                    </table>
                                                </fieldset>
                        </tr>
                                    <br>
                                    <tr id="resulttr">
                                        <td id="resulttd"><button type="submit" value="Confirm for Update">Confirm for Update</button></td>
                                        <td id="resulttd">
                                            
                                        </td>
                                    </tr>
                                </table>
                                </form>
                                <br>
                                <form action="/wp-content/themes/consultup-child/loginned.php" method="post">
                                                <input type="text" name="username" value="<?php echo $_SESSION['email']?>" hidden>
                                                <input type="password" name="password" value="<?php echo $_SESSION['password']?>" hidden>
                                                <button type="submit">Cancel</button>
                                </form>
                        <?php           
                                
            }else{
            ?>
                <form action="updateUser.php" method="post"  enctype="multipart/form-data">
                    <h3>School Contact</h3>
                    <input type="text" name="id" value="<?php echo $_SESSION['id']?>" hidden>
                    <table id="resulttable">
                        <tr id="resulttr">
                            <th id="resultth">Name</th>
                            <td id="resulttd">
                                <input type="text" name="firstName" placeholder="Firstname" value="<?php echo $_SESSION['firstName']?>" required>&nbsp;&nbsp;
                                <input type="text" name="lastName"  placeholder="Lastname" value="<?php echo $_SESSION['lastName']?>" required>
                            </td>
                        </tr>
                        <tr id="resulttr">
                            <th id="resultth">Password</th>
                            <td id="resulttd"><input type="password" name="password" value="<?php echo $_SESSION['password']?>" required></td>
                        </tr>
                        <tr id="resulttr">
                            <th id="resultth">Email</th>
                            <td id="resulttd"><input type="email" name="email" value="<?php echo $_SESSION['email']?>" required></td>
                        </tr> 
                        <tr id="resulttr">
                            <th id="resultth">Phone No.</th>
                            <td id="resulttd">  
                                <table>
                                    <tr>
                                        <td><select name="countryCode" placeholder="countryCode" required>
                                                
                                                  <?php
                                                 if($_SESSION['countryCode']=="61"){?>
                                                      <option value="61" selected>Australia (+61)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="61">Australia (+61)</option>
                                                <?php }
                                                 if($_SESSION['countryCode']=="1"){?>
                                                      <option value="1" selected>Canada (+1)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="1">Canada (+1)</option>
                                                <?php }
                                                 ?>
                                                  <?php
                                                 if($_SESSION['countryCode']=="86"){?>
                                                      <option value="86" selected>China (+86)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="86">China (+86)</option>
                                                <?php }
                                                 ?> <?php
                                                 if($_SESSION['countryCode']=="65"){?>
                                                      <option value="65" selected>Singapore (+65)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="65">Singapore (+65)</option>
                                                <?php }?><?php
                                                 if($_SESSION['countryCode']=="44"){?>
                                                      <option value="44" selected>UK (+44)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="44">UK (+44)</option>
                                                <?php }
                                                if($_SESSION['countryCode']=="1(US)"){?>
                                                      <option value="1(US)" selected>USA (+1)</option>
                                                   <?php  
                                                 }else{?>
                                                     <option value="1(US)">USA (+1)</option>
                                                <?php }
                                               
                                                 ?>
                                                
                                                </select></td>
                                        <td>&nbsp;&nbsp;&nbsp;<input type="text" name="phone" value="<?php echo $_SESSION['phone']?>"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr id="resulttr">
                            <th id="resultth">Position</th>
                            <td id="resulttd">
                                <input type="text" name="position" value="<?php echo $_SESSION['position']?>">
                            </td>
                        </tr>
                        
                    </table>
                    <h3>School detail</h3>
                    <table id="resulttable">
                        <tr id="resulttr">
                                                <th id="resultth">School Name</th>
                                                <td id="resulttd"><input type="text" name="schoolName" value="<?php echo $_SESSION['schoolName']?>"></td>
                                            </tr>
                        <tr id="resulttr">
                                                <th id="resultth">School Address</th>
                                                <td id="resulttd"><input type="text" name="schoolAddress" value="<?php echo $_SESSION['schoolAddress']?>"></td>
                                            </tr>
                        <tr>
                                                <th id="resultth">Country</th>
                                                <td id="resulttd">
                                                    
                                                    
                                                    <table>
                    <tr>
                        <td> <select name="country" placeholder="countryCode" required>
                                   <?php
                                                     if($_SESSION['country']=="AU"){?>
                                                          <option value="AU" selected>Australia</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="AU">Australia</option>
                                                    <?php }
                                                     if($_SESSION['country']=="CA"){?>
                                                          <option value="CA" selected>Canada</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="CA">Canada</option>
                                                    <?php }
                                                     ?>
                                                      <?php
                                                     if($_SESSION['country']=="CN"){?>
                                                          <option value="CN" selected>China</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="CN">China</option>
                                                    <?php }
                                                     ?> <?php
                                                     if($_SESSION['country']=="SG"){?>
                                                          <option value="SG" selected>Singapore</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="SG">Singapore</option>
                                                    <?php }?><?php
                                                     if($_SESSION['country']=="GB"){?>
                                                          <option value="GB" selected>UK</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="GB">UK</option>
                                                    <?php }
                                                    if($_SESSION['country']=="US"){?>
                                                          <option value="US" selected>USA</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="US">USA</option>
                                                    <?php }

                                                     ?>
                            </select>
                        <input type="text" name="state" placeholder="State" value="<?php echo $_SESSION['state'];?>" required>
                        &nbsp;&nbsp;<input type="text" name="city" placeholder="City" value="<?php echo $_SESSION['city'];?>" required>
                    </td></tr>
                   
                    
                    
                    </table>
                                                    
                                                </td>
                                            </tr>
                        <tr id="resulttr">
                                                <th id="resultth">School Level</th>
                                                <td id="resulttd">
                                                        <select name="schoolLevel" required>
                                                     <?php
                                                     if($_SESSION['schoolLevel']==1){?>
                                                          <option value="1" selected>Early Year</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="1">Early Year</option>
                                                    <?php }
                                                     ?>
                                                      <?php
                                                     if($_SESSION['schoolLevel']==2){?>
                                                          <option value="2" selected>Primary</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="2">Primary</option>
                                                    <?php }
                                                     ?> <?php
                                                     if($_SESSION['schoolLevel']==3){?>
                                                          <option value="3" selected>Secondary</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="3">Secondary</option>
                                                    <?php }
                                                     ?> <?php
                                                     if($_SESSION['schoolLevel']==4){?>
                                                          <option value="4" selected>Senior</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="4">Senior</option>
                                                    <?php }
                                                     ?><?php
                                                     if($_SESSION['schoolLevel']==5){?>
                                                          <option value="5" selected>Tertiary</option>
                                                       <?php  
                                                     }else{?>
                                                         <option value="5">Tertiary</option>
                                                    <?php }
                                                     ?>



                                                        </select>
                                                    </td>
                                            </tr>
                        <tr id="resulttr">
                                                <th id="resultth">School Type</th>
                                                <td id="resulttd">
                                                        <select name="schoolType" required>

                                                      <?php
                                                         if($_SESSION['schoolType']==1){?>
                                                              <option value="1" selected>School</option>
                                                           <?php  
                                                         }else{?>
                                                             <option value="1">School</option>
                                                        <?php }
                                                         ?>
                                                          <?php
                                                         if($_SESSION['schoolType']==2){?>
                                                              <option value="2" selected>College</option>
                                                           <?php  
                                                         }else{?>
                                                             <option value="2">College</option>
                                                        <?php }
                                                         ?> <?php
                                                         if($_SESSION['schoolType']==3){?>
                                                              <option value="3" selected>University</option>
                                                           <?php  
                                                         }else{?>
                                                             <option value="3">University</option>
                                                        <?php }?><?php
                                                         if($_SESSION['schoolType']==4){?>
                                                              <option value="4" selected>Institution</option>
                                                           <?php  
                                                         }else{?>
                                                             <option value="4">Institution</option>
                                                        <?php }
                                                         ?>

                                                        </select>
                                                    </td>
                                            </tr>
                        <tr id="resulttr">
                                                <th id="resultth">School Size</th>
                                                <td id="resulttd">
                                                    <select name="schoolSize">

                                                     <?php
                                                     if($_SESSION['schoolSize']==1){?>
                                                     <option value="1" selected>Small</option>
                                                     <?php  
                                                     }else{?>
                                                     <option value="1">Small</option>
                                                     <?php }
                                                     ?>
                                                     <?php
                                                     if($_SESSION['schoolSize']==2){?>
                                                     <option value="2" selected>Medium</option>
                                                     <?php  
                                                     }else{?>
                                                     <option value="2">Medium</option>
                                                     <?php }
                                                     ?> <?php
                                                     if($_SESSION['schoolSize']==3){?>
                                                     <option value="3" selected>Large</option>
                                                     <?php  
                                                     }else{?>
                                                     <option value="3">Large</option>
                                                     <?php }
                                                     ?>



                                                 </select>
                                                </td>
                                            </tr>
                        <tr id="resulttr">
                            <th id="resultth">Subject</th>
                                <td id="resulttd">
                                    <fieldset> 
                                        <table width="500" length="100" >
                                            <tr> 
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'1') !== false){ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" checked="true" value="1">  STEM
                                                    <?php
                                                    }else{ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" value="1">  STEM
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'2') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="2">  Problem-solving
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="2">  Problem-solving
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'3') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="3">  Inquiry-based learning
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="3">  Inquiry-based learning
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'4') !== false){ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" checked="true" value="4">  Early years numeracy
                                                    <?php
                                                    }else{ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" value="4">  Early years numeracy
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'5') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="5">  Junior maths
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="5">  Junior maths
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'6') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="6">  Middle years maths
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="6">  Middle years maths
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'7') !== false){ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" checked="true" value="7">  Senior maths
                                                    <?php
                                                    }else{ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" value="7">  Senior maths
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'8') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="8">  Maths projects
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="8">  Maths projects
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'9') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="9">  Exam preparation
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="9">  Exam preparation
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'10') !== false){ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" checked="true" value="10">  General maths
                                                    <?php
                                                    }else{ ?>
                                                        &nbsp;<input type="checkbox" name="department[]" value="10">  General maths
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if(strpos($_SESSION['department'],'11') !== false){ ?>
                                                        <input type="checkbox" name="department[]" checked="true" value="11">  Mastery approach
                                                    <?php
                                                    }else{ ?>
                                                        <input type="checkbox" name="department[]" value="11">  Mastery approach
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </td>
                        </tr>
                        <tr id="resulttr">
                                                <fieldset> 
                                                    <table width="500" length="100" >
                                                        <tr><legend>Who would you like to host?</legend></tr>
                                                        <tr>
                                                            <?php
                                                            if($_SESSION['hostVisiting']=="1"){?>
                                          <td> <input type="checkbox" name="hostVisiting[]" value="1" checked="true" onclick="return ValidatePetSelection();">   I would like to host visiting teachers</td>
                                          <td><input type="checkbox" name="hostVisiting[]" value="2" onclick="return ValidatePetSelection();">   I would like to host visiting students</td> 
                                         <?php }   ?>
                                                            <?php
                                                            if($_SESSION['hostVisiting']=="2"){?>
                                          <td> <input type="checkbox" name="hostVisiting[]" value="1" onclick="return ValidatePetSelection();">   I would like to host visiting teachers</td>
                                          <td><input type="checkbox" name="hostVisiting[]" value="2" checked="true" onclick="return ValidatePetSelection();">   I would like to host visiting students</td>
                                         <?php }   ?>
                                                            <?php
                                                            if($_SESSION['hostVisiting']=="1,2"){?>
                                          <td> <input type="checkbox" name="hostVisiting[]" value="1" checked="true" onclick="return ValidatePetSelection();">   I would like to host visiting teachers</td>
                                          <td><input type="checkbox" name="hostVisiting[]" value="2" checked="true" onclick="return ValidatePetSelection();">   I would like to host visiting students</td>  
                                         <?php }   ?>

                                                        </tr>   
                                                    </table>
                                                </fieldset>
                                            </tr>
                        <br>
                        <tr id="resulttr">
                                                <fieldset>  
                                                   <table width="500" length="100" >

                                                       <tr> <legend>Which months in the year are you able to accommodate exchange visitors?</legend>  </tr>
                                                       <tr>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['accommodateMonths'],'1') !== false){ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="1" checked="true" onclick="return ValidatePetSelection();"> January
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="1" onclick="return ValidatePetSelection();"> January
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['accommodateMonths'],'2') !== false){ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="2" checked="true" onclick="return ValidatePetSelection();">  February
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="2" onclick="return ValidatePetSelection();">  February
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['accommodateMonths'],'3') !== false){ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="3" checked="true" onclick="return ValidatePetSelection();">  March 
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="3" onclick="return ValidatePetSelection();">  March 
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['accommodateMonths'],'4') !== false){ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="4" checked="true" onclick="return ValidatePetSelection();">  April
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="4" onclick="return ValidatePetSelection();">  April
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                <?php
                                                                if(strpos($_SESSION['accommodateMonths'],'5') !== false){ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="5" checked="true" onclick="return ValidatePetSelection();">  May
                                                                <?php
                                                                }else{ ?>
                                                                    <input type="checkbox" name="accommodateMonths[]" value="5" onclick="return ValidatePetSelection();">  May
                                                                <?php
                                                                }
                                                                ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'6') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="6" checked="true" onclick="return ValidatePetSelection();">  June
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="6" onclick="return ValidatePetSelection();">  June
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'7') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="7" checked="true" onclick="return ValidatePetSelection();">  July
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="7" onclick="return ValidatePetSelection();">  July
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'8') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="8" checked="true" onclick="return ValidatePetSelection();">  August
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="8" onclick="return ValidatePetSelection();">  August
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'9') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="9" checked="true" onclick="return ValidatePetSelection();">  September
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="9" onclick="return ValidatePetSelection();">  September
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>
                                                       <tr>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'10') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="10" checked="true" onclick="return ValidatePetSelection();">  October
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="10" onclick="return ValidatePetSelection();">  October
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'11') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="11" checked="true" onclick="return ValidatePetSelection();">  November
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="11" onclick="return ValidatePetSelection();">  November
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                           <td>
                                                                    <?php
                                                                    if(strpos($_SESSION['accommodateMonths'],'12') !== false){ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="12" checked="true" onclick="return ValidatePetSelection();">  December
                                                                    <?php
                                                                    }else{ ?>
                                                                        <input type="checkbox" name="accommodateMonths[]" value="12" onclick="return ValidatePetSelection();">  December
                                                                    <?php
                                                                    }
                                                                    ?>
                                                           </td>
                                                       </tr>

                                                    </table>
                                                </fieldset>
                        </tr>
                        <br>
                        <tr id="resulttr">
                                                <td id="resulttd"><button type="submit" value="Confirm to Update">Confirm to Update</button></td>
                                            </tr>
                    </table>
                                    
                </form>
                <br>
                <form action="/wp-content/themes/consultup-child/loginned.php" method="post">
                        <input type="text" name="username" value="<?php echo $_SESSION['email']?>" hidden>
                        <input type="password" name="password" value="<?php echo $_SESSION['password']?>" hidden>
                        <button type="submit">Cancel</button>
                </form>
            <?php
                }
            ?>
        </div>
    </div>
</main>
<?php
$_SESSION['e']=$_SESSION['email'];
get_footer();
?>