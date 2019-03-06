 <?php 

if(!isset($_REQUEST['t'])){
  $homePath = get_site_url(false);
  header('Location: '.$homePath);
}
 

  
  $gsDataPath = "";
  $recordKey = "";

  if(isset($_REQUEST['t'])){
    $ticketNoSent = htmlentities($_REQUEST['t']);
    
  }

  include('includes/header.inc.php'); 

  if($_SESSION['pStatus'] == 'p1'){
    $gsDataPath = get_theme_url(false).'/dataSearch/p1/data.json';
    
  }
  elseif($_SESSION['pStatus'] == 'p2'){
    $gsDataPath = get_theme_url(false).'/dataSearch/p2/data.json';
  }

  //get the json data
  $jsonData = json_decode(file_get_contents($gsDataPath));
  $matchTicket = "";

  



?>


        <hr>


        <div id="bck_2" class="bck">
            <div id="block_2" class="row rowNo13">
                <div class="large-6 columns">
                
                        <?php
                        // define variables and set to empty values
                        $titleErr = $datepickerErr = $timeErr = $impactErr = $emailErr = $ticketnoErr = $statusErr = $detailsErr = $ticktypeErr = "";
                        $ticketno = $time = $datepicker = $title = $email = $status =$impact = $details = $ticktype = "";
                        ?>

                        <h2><?php get_page_title(); ?></h2>
                        <hr>
                        

                        <?php

                        //Find a match in the data with the ticketNoSent
                        foreach ($jsonData as $key => $value) {
                          if($value->id == $ticketNoSent){

                          
                            
                            //save the key value as the element(ticket)
                            //positional ref in the data object

                            $GLOBALS['recordKey'] = $key;
                           
                            $matchTicket =  $key; // hold a ref to the match
                            echo "<p class='editRef'><b>Editing ticket no: " . strtoupper($ticketNoSent) . "<span> Type: ". strtoupper($_SESSION['pStatus']) . "</span></b></p>";
                            
                            $timeFix = ($value->updated);
                            $timeLen = strlen($timeFix);
                            $timePos = stripos($timeFix, "(");
                            $timeFixTime = substr($timeFix, $timePos+1,5);

                            
                            
                            if($_SESSION['pStatus'] == "p1"){
                              $ticktype = 1;
                            }
                            elseif($_SESSION['pStatus'] == "p2"){
                                $ticktype = 2;
                            }
                            

                            $datepicker = substr($timeFix, 0,9);
                            $ticketno = strtoupper($value->id);
                            $time = $timeFixTime;
                            $title = $value->title;
                            $email = $value->email;
                            $status = $value->status;
                            $impact = $value->impact;
                            $details = $value->details;
                            

                          }
                        }

                       

                        function test_input($data) {
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                        }


                        //Testing inputs from POST ------------------------ 

                      if ($_SERVER["REQUEST_METHOD"] == "POST"){

                        $checkFlag = 0;

                          if (empty($_POST["datepicker"]) || ctype_space($_POST["datepicker"])) {
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
                              $titleErr = "Only letters, numbers and white space allowed"; 
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

                          if (empty($_POST["impact"])|| ctype_space($_POST["impact"])) {
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

                          

                          if($checkFlag == 0){
                            $success ="<p id='success'>Ticket Edited Successfully</p>";

                            //save file
                            $filesLoc2 = "theme/helpdesk/dataSearch/".$_SESSION['pStatus']."/data.json";
                            $dataFile2 = file_get_contents($filesLoc2);
                            $decodeJson2 = json_decode($dataFile2);

                            

                            foreach ($decodeJson2 as $jkey => $jvalue) {
                            
                              if($jkey == $GLOBALS['recordKey']){
                                
                                $jvalue->id = strtolower($ticketno);
                                $jvalue->updated = strtolower($datepicker." (".$time.")");
                                $jvalue->title = strtolower($title);
                                $jvalue->email = strtolower($email);
                                $jvalue->details =$details;
                                $jvalue->status = strtolower($status);
                                $jvalue->impact = $impact;
                              }
                               
                            }



                            //save data - create new ticket
                            
                            //decode and pretty print
                            $jDataStr2 = json_encode($decodeJson2,JSON_PRETTY_PRINT);
                            
                            //store the new data back to file
                            file_put_contents($filesLoc2,$jDataStr2);
                          }
                      }
                          
                          
                      


                    ?>

                <!-- Form -------------------------- -->

               
                <p><span class="form_error">* Required fields</span></p>
                <form id="ticketForm" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">  
                  
                  <label style='display: inline;'>Update Date:</label>
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
                  <hr>
                  <br><br>

                  <label style='display: inline;'>Ticket No: </label>
                  <span class="form_error"> * <?php echo $ticketnoErr;?></span>
                  <input type="text" name="ticketno" value="<?php echo $ticketno;?>" maxlength="15">
                  
                  <br><br>

                  <label style='display: inline;'>Title: </label>
                  <span class="form_error"> * <?php echo $titleErr;?></span>
                  <input type="text" name="title" value="<?php echo $title;?>" maxlength="120">
                  
                  <br><br>

                  <label style='display: inline;'>Ticket Status: </label>
                  
                  <input type="radio" name="status" <?php if (isset($status) && $status=="1") echo "checked";?> value="1">Red
                  <input type="radio" name="status" <?php if (isset($status) && $status=="2") echo "checked";?> value="2">Green  
                  <span class="form_error"> * <?php echo $statusErr;?></span>
                  <br><br><br>


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
    <?php include('includes/footer.inc.php'); ?>