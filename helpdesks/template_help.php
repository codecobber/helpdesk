
  <?php include('includes/header.inc.php'); ?>

        <hr>
        <div class="row" id="helpInfo">
           <div class="medium-12 columns help">
               <h4>The dashboard.</h4>
               <p>Please start by selecting your P1 or P2 preference from above. Once selected, you will be provided with a list showing each of the current issues.</p>
               
               <h4>The Status.</h4>
               <p><button class='bookButt' style='border-radius:5px;background-color:green'><i class='far fa-folder-open fa-2x'></i></button> <strong>To read more about an issue</strong>
               Select the appropriate green 'open' button from any row. 
               </p>

               <p><button style='border-radius:5px;background-color:#444'><i class='fas fa-pencil-alt fa-2x'></i></button> <strong>To edit an record</strong>
               
                Select the grey 'edit' button from any row.
               </p>

              <p><button style='border-radius:5px;background-color:#ce3838'><i class='far fa-trash-alt fa-2x'></i></button> <strong>To delete an record</strong>
               
                Select the red 'delete' button from any row. 
               </p>
               </p>
            </div>
          
        </div>

        <div id="bck_12" class="bck">
            <div id="block_12" class="row rowNo26">
                <div class="medium-12 medium-centered columns">
                    <div class="data-panel criteria" id="dataRows">
 
                        <h4 id="pSelection"></h4>
                        <div id="userData" class="panelStyle">
                            <p>
                                <span>Date:</span>
                                <span id="exp_date"></span>
                                <span>Issue no:</span>
                                <span id="exp_issueNo"></span>
                                <span>Raised by:</span>
                                <span id="exp_raisedBy"></span>
                            </p>
                            <p><span>Details:</span></p>
                        </div>
                        

                        
                        <h3 id="pSelection"></h3>
                        
                        <p id="startButton"></p>
                        <div class="panelStyle" id="initialRows">
                            <table id="txtHintHR"></table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row key">
     <hr>       
            <div class="medium-12 columns">
                <span><strong><i class="fas fa-key"></i> Key:</strong></span> Red: <span #id=key_red> Green: <span #id=key_red></span>
                <p>The colour codes shown for 'status' defines the current progress of the issue.</p>
                <p> Eg:<br>    
                    <b>Red <span class="statusColour statRed"></span></b> - issue is being addressed but not resolved. |
                    <b> Green <span class="statusColour statGreen"></span></b> - issue has been addressed and resolved.
                </p>
            </div>
            <hr>
        </div>
    <!-- Footer Partial -->
  
  <?php include('includes/footer.inc.php'); ?>