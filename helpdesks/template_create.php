 <?php 
  $page = "create";
  include('includes/header.inc.php'); 
?>

</head>

<body id="<?php get_page_slug(); ?>" >


    <!-- SideNav content -->

    <div id="mySidenav" class="sidenav">
        <ul>
            <?php get_navigation(return_page_slug()); ?>
            <li><a class="editme" href="#">Edit</a></li>
        </ul>
    </div>

    <div id="main" class="hide-for-medium">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
    </div>

    <!-- ==================================================================================== -->


    <!-- show for medium up -->

    <div id='start'>

        <div class="row dashboard">
            <div class="medium-7 columns"><span><img src="<?php get_theme_url(); ?>/img/nhs-24.png"></span><h1>Help Desk Dashboard</h1></div>
            <div class="medium-5 columns">
                
                <a class="button home" href="<?php echo get_site_url();?>"><i class="fas fa-home"></i> Home</a>
            </div>
            
        </div>
        <hr>


        <div id="bck_2" class="bck">
            <div id="block_2" class="row rowNo13">
                <div class="large-6 columns">
                <h2><?php get_page_title(); ?></h2>
                <hr>
                
                
    
                        <?php
                        // define variables and set to empty values
                        $titleErr = $datepickerErr = $timeErr = $impactErr = $emailErr = $ticketnoErr = $statusErr = $detailsErr = $ticktypeErr = "";
                        $ticketno = $time = $datepicker = $title = $email = $status =$impact = $details = $ticktype = "";

                       

                        function test_input($data) {
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                        }


                        //Testing inputs ------------------------ 

                        if ($_SERVER["REQUEST_METHOD"] == "POST"){

                          $checkFlag = 0;

                          if (empty($_POST["datepicker"])) {
                            $datepickerErr = "Date required";
                            $checkFlag =1;
                          } else {
                            $datepicker = test_input($_POST["datepicker"]);
                          }
                          
                          if (empty($_POST["title"])) {
                            $titleErr = "Title required";
                            $checkFlag =1;
                          } else {
                            $title = test_input($_POST["title"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z ]*$/",$title)) {
                              $titleErr = "Only letters and white space allowed"; 
                            }
                          }
                          
                          if (empty($_POST["ticketno"])) {
                            $ticketnoErr = "Ticket number required";
                            $checkFlag =1;
                          } else {
                            $ticketno = test_input($_POST["ticketno"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$ticketno)) {
                              $ticketnoErr = "Only letters, numbers and white space allowed"; 
                            }
                          }

                          if (empty($_POST["time"])) {
                            $timeErr = "Time required";
                            $checkFlag =1;
                          } else {
                            $time = test_input($_POST["time"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[\d]{2}:[\d]{2}$/",$time)) {
                              $timeErr = "Please enter in the format - dd:dd"; 
                            }
                          }

                          if (empty($_POST["email"])) {
                            $emailErr = "Email required";
                            $checkFlag =1;
                          } else {
                            $email = test_input($_POST["email"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                              $emailErr = "Invalid email format"; 
                            }
                          }

                          if (empty($_POST["impact"])) {
                            $impactErr = "Content required";
                            $checkFlag =1;
                          } else {
                            $impact = test_input($_POST["impact"]);
                          }

                          if (empty($_POST["details"])) {
                            $detailsErr = "Content required";
                            $checkFlag =1;
                          } else {
                            $details = test_input($_POST["details"]);
                          }

                          if (empty($_POST["status"])) {
                            $statusErr = "Status required";
                            $checkFlag =1;
                          } else {
                            if($_POST["status"] ==1){
                              $_SESSION['pStatus'] = "p1";
                            }
                            else{
                              $_SESSION['pStatus'] = "p2";
                            }
                            $status = test_input($_POST["status"]);
                          }

                          if (empty($_POST["ticktype"])) {
                            $ticktypeErr = "Ticket type required";
                            $checkFlag =1;
                          } else {
                            $ticktype = test_input($_POST["ticktype"]);
                          }

                          if($checkFlag == 0){
                            $success ="<p id='success'>Ticket created</p>";

                            //save file
                            $filesLoc = "theme/helpdesks/dataSearch/".$_SESSION['pStatus']."/data.json";
                            $dataFile = file_get_contents($filesLoc);
                            $decodeJson = json_decode($dataFile);

                            //save data - create new ticket
                            $newTicket->id = $ticketno;
                            $newTicket->date = $datepicker;
                            $newTicket->updated = $datepicker." (".$time.")";
                            $newTicket->title = $title;
                            $newTicket->email = $email;
                            $newTicket->details =$details;
                            $newTicket->status = $status;
                            $newTicket->impact = $impact;
             
                            //add object to array
                            array_push($decodeJson, $newTicket);
                           
                            //decode and pretty print
                            $jDataStr = json_encode($decodeJson,JSON_PRETTY_PRINT);
                            
                            //store the new data back to file
                            file_put_contents($filesLoc,$jDataStr);
                          }
                      }


                    ?>

                <!-- Form -------------------------- -->

               
                <p><span class="form_error">* Required fields</span></p>
                <form id="ticketForm" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">  
                  
                  <label style='display: inline;'>Date:</label>
                  <span class="form_error"> * <?php echo $datepickerErr;?></span>
                  <input id="datepicker" style='display: inline;' type="text" name="datepicker" value="<?php echo $datepicker;?>">
                  
                  <br><br>

                  <label style='display: inline;'>Time: <small style='color:#cacaca'>eg: 13:10</small></label>
                  <span class="form_error"> * <?php echo $timeErr;?></span>
                  <input id="time" style='display: inline;' type="text" name="time" value="<?php echo $time;?>">
                  
                  <br><br>

                  <label style='display: inline;'>E-mail: </label>
                  <span class="form_error"> * <?php echo $emailErr;?></span>
                  <input type="text" name="email" value="<?php echo $email;?>">
    
                  <br><br>

                  <label style='display: inline;'>Ticket Type: </label>
                  
                  <input type="radio" name="ticktype" <?php if (isset($ticktype) && $ticktype=="1") echo "checked";?> value="1">P1
                  <input type="radio" name="ticktype" <?php if (isset($ticktype) && $ticktype=="2") echo "checked";?> value="2">P2
                  <span class="form_error"> * <?php echo $ticktypeErr;?></span>
                  <br><br> 

                  <label style='display: inline;'>Ticket Status: </label>
                  
                  <input type="radio" name="status" <?php if (isset($status) && $status=="1") echo "checked";?> value="1">Red
                  <input type="radio" name="status" <?php if (isset($status) && $status=="2") echo "checked";?> value="3">Green  
                  <span class="form_error"> * <?php echo $statusErr;?></span>
                  <br><br><br> 

                  <label style='display: inline;'>Title: </label>
                  <span class="form_error"> * <?php echo $titleErr;?></span>
                  <input type="text" name="title" value="<?php echo $title;?>" maxlength="120">
                  
                  <br><br>

                  <label style='display: inline;'>Ticket No: </label>
                  <span class="form_error"> * <?php echo $ticketnoErr;?></span>
                  <input type="text" name="ticketno" value="<?php echo $ticketno;?>" maxlength="15">
                  
                  <br><br>


                  <label style='display: inline;'>Ticket Details:</label>
                  <span class="form_error"> * <?php echo $detailsErr;?></span>
                  <br>
                  <textarea name="details" rows="5" cols="40"><?php echo $details;?></textarea>
                  
                  <br><br>
                  

                  <label style='display: inline;'>End user impact:</label> 
                  <span class="form_error"> * <?php echo $impactErr;?></span>
                  <br>
                  <textarea name="impact" rows="5" cols="40"><?php echo $impact;?></textarea>
                  
                  <br><br> 

                  <input class="button" type="submit" name="submit" value="Submit">  
                </form>

                </div>

                <div class="large-6 columns">
                <h2>Remember!</h2>
                <hr>
                <p>When inputting data, try to be as clear as possible. 
                Add as much information as is required. Don&#39;t be vague.</p>
                <p>The traffic lights notification is there to provide a visual indication of the progress of the ticket.</p>
                <p>Initially, the ticket will be set to red as the issue is new and has not been dealt with. Later you can edit the status and change the colour accordingly. </p>
                
                <div><?php if(isset($success)){echo $success;} ?></div>

                </div>

            </div>

        </div>     
    </div>
    <!-- Footer Partial -->

    <footer id="footer">
        <div class="row footerTop">
            <div class="small-4 text-center medium-4 large-4 columns">
                <div class="copyright">
                    &copy;<?php get_site_name(); ?><a href="<?php get_site_url(); ?>"></a>
                </div>

            </div>


            <div class="small-4 medium-4 large-4  text-center columns">
                <small><?php get_site_credits(); ?></small>
            </div>



            <div class="small-4 show-for-medium medium-4 columns">
                <ul class="icons">
                    <li><a class="blockSec" id="cblocks" href="#"><i class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="blockSec" id="fblocks" href="#"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li><a class="blockSec" id="iblocks" href="#"><i class="fa fa-pinterest-p fa-lg" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
            
    </footer>
    <?php get_footer(); ?>

    <!-- Close footer partial -->



    <script src="<?php get_theme_url(); ?>/js/vendor/what-input.js"></script>
    <script src="<?php get_theme_url(); ?>/js/vendor/foundation.min.js"></script>
    <script src="<?php get_theme_url(); ?>/js/app.js"></script>
    <script src="<?php get_theme_url(); ?>/js/slidePush.js"></script>

    

</body>

</html>