 <?php 
  $page = "create";
  include('includes/header.inc.php'); 
?>

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

                          if (empty($_POST["datepicker"])|| ctype_space($_POST["datepicker"])) {
                            $datepickerErr = "Date required";
                            $checkFlag =1;
                          } else {
                            $datepicker = test_input($_POST["datepicker"]);
                          }
                          
                          if (empty($_POST["title"]) || ctype_space($_POST["title"])) {
                            $titleErr = "Title required";
                            $checkFlag =1;
                          } else {
                            $title = test_input($_POST["title"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/[a-zA-Z0-9\s]+/",$title)) {
                              $titleErr = "Only letters and white space allowed"; 
                            }
                          }
                          
                          if (empty($_POST["ticketno"]) || ctype_space($_POST["ticketno"])) {
                            $ticketnoErr = "Ticket number required";
                            $checkFlag =1;
                          } else {
                            $ticketno = test_input($_POST["ticketno"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$ticketno)) {
                              $ticketnoErr = "Only letters, numbers and white space allowed"; 
                            }
                          }

                          if (empty($_POST["time"]) || ctype_space($_POST["time"])) {
                            $timeErr = "Time required";
                            $checkFlag =1;
                          } else {
                            $time = test_input($_POST["time"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[\d]{2}:[\d]{2}$/",$time)) {
                              $timeErr = "Please enter in the format - dd:dd"; 
                            }
                          }

                          if (empty($_POST["email"]) || ctype_space($_POST["email"])) {
                            $emailErr = "Email required";
                            $checkFlag =1;
                          } else {
                            $email = test_input($_POST["email"]);
                            // check if e-mail address is well-formed
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                              $emailErr = "Invalid email format"; 
                            }
                          }

                          if (empty($_POST["impact"]) || ctype_space($_POST["impact"])) {
                            $impactErr = "Content required";
                            $checkFlag =1;
                          } else {
                            $impact = test_input($_POST["impact"]);
                          }

                          if (empty($_POST["details"]) || ctype_space($_POST["details"])) {
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
                            
                            $existsFlag = 0;

                            
                            //save file
                            $filesLoc = "theme/helpdesks/dataSearch/".$_SESSION['pStatus']."/data.json";
                            $dataFile = file_get_contents($filesLoc);
                            $decodeJson = json_decode($dataFile);

                            
                            //Loop through array and check for duplicate id
                            foreach ($decodeJson as $skey => $svalue) {
                               if($decodeJson[$skey]->id == $ticketno){
                                $existsFlag = 1;
                               }
                             } 

                            
                             if($existsFlag == 0){

                              $mymessage = "<p id='success'>Ticket created</p>";

                              //save data - create new ticket
                              //stdClass is PHP's generic empty class
                              $newTicket = new stdClass();

                              $newTicket->id = $ticketno;
                              $newTicket->date = $datepicker." (".$time.")";
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
                             else{
                              $mymessage = "<p id='success' style='background-color:#b33434'>Ticket ID already exists</p>";
                             }

                            
                          }
                      }


                    ?>

                <!-- Form -------------------------- -->

               
                <p><span class="form_error">* Required fields</span></p>
                <form id="ticketForm" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">  
                  
                  <label style='display: inline;'>Creation Date:</label>
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

                  

                  <label style='display: inline;'>Title: </label>
                  <span class="form_error"> * <?php echo $titleErr;?></span>
                  <input type="text" name="title" value="<?php echo $title;?>" maxlength="120">
                  
                  <br><br>

                  <label style='display: inline;'>Ticket No: </label>
                  <span class="form_error"> * <?php echo $ticketnoErr;?></span>
                  <input type="text" name="ticketno" value="<?php echo $ticketno;?>" maxlength="15">
                  
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
                
                <div><?php if(isset($mymessage)){echo $mymessage;} ?></div>

                </div>

            </div>

        </div>     
    </div>
   <?php include('includes/footer.inc.php'); ?>