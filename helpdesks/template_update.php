 <?php 

 include('includes/header.inc.php'); 
 $_SESSION['pStatus'] = "";
 $_SESSION['gsSitePath'] = get_site_url(false);
 
 ?>

<script>


var currentFile = "";

function viewMe(e){

  //view more details from data file - show expanded view
  
  $(document).ready(function(){


        var issNo = e.getAttribute('id').replace("-view","");
        var issAction = e.getAttribute('data-action');

        var xmlhttp3 = new XMLHttpRequest();
        xmlhttp3.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userData").innerHTML = this.responseText;
                
                if(issAction == "delete"){
                    showRows(currentFile);
                }
            }
        };

        if(issAction == "delete"){
            xmlhttp3.open("POST", "<?php get_theme_url(); ?>/getHelpAdmin.php?d=" + issNo, true);
        }
        else if(issAction == "edit"){
            xmlhttp3.open("POST", "<?php get_theme_url(); ?>/getHelpAdmin.php?e=" + issNo, true);
        
        }
        else if(issAction == "open"){
            xmlhttp3.open("POST", "<?php get_theme_url(); ?>/getHelpAdmin.php?c=" + issNo, true);
        
        }

        xmlhttp3.send();
    
   
    
    $('#userData').show('slow');
    
  });


}; 



function  showRows(loc){
   
    $(document).ready(function(){

      $('#userData').hide();

      currentFile = loc;
      $('#pSelection').html("<i class='fas fa-list-alt'></i> " + loc.toUpperCase() + " Tickets"); 
      
      //hide startupinfo
      $('#dashboardInfo').css('display','none');
      
      if (loc.length == 0) { 
            $('#txtHintHR').html("");
            return;
        } else {
            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $('#txtHintHR').html(this.responseText);
                }
            };
            xmlhttp2.open("GET", "<?php get_theme_url(); ?>/getHelpAdmin.php?l=" + loc, true);
            xmlhttp2.send();
            $('#initialRows').show('slow');
            
        }
     
    });
}


</script>
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


   
    <div id='start'>

        <div class="row dashboard">
            <div class="medium-7 columns"><span><img src="<?php get_theme_url(); ?>/img/nhs-24.png"></span><h1>Help Desk Dashboard</h1></div>
            <div class="medium-5 columns">
                <form id="location">
                    <span>Select a preference: <i class="fas fa-hand-point-right"></i> </span>
                    <input class="choices" id="p1" onclick ="showRows('p1')" type="radio" name="locationSet" value="0"> P1
                    <input class="choices" id="p2" onclick ="showRows('p2')" type="radio" name="locationSet" value="1"> P2
                </form>
                <a class="button update" href="<?php echo get_site_url().'index.php?id=create-ticket' ?>">Create new ticket</a>
            </div>
            
        </div>

        <hr>
        <div class="row" id="dashboardInfo">
           <div class="medium-12 columns">
               <h4>Welcome to the dashboard.</h4>
               <p>Please start by selecting your P1 or P2 preference from above. Once selected, you will be provided with a list showing each of the current issues.</p>
               
               <strong>To read more about an issue</strong>
               <p>Select the appropriate green 'open' button from any row. <br><button class='bookButt' style='border-radius:5px;background-color:green'><i class='far fa-folder-open'></i></button>
               </p>

               <strong>To edit an record</strong>
               <p>
                Select the grey 'edit' button from any row. <br><button style='border-radius:5px;background-color:#444'><i class='fas fa-pencil-alt'></i></button>
               </p>

              <strong>To delete an record</strong>
               <p>
                Select the red 'delete' button from any row. <br><button style='border-radius:5px;background-color:#ce3838'><i class='far fa-trash-alt'></i></button>
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
    
    <footer id="footer">
        <div class="row footerTop">
            <div class="small-6 text-center medium-6 large-6 columns">
                <div class="copyright">
                    &copy;<?php get_site_name(); ?><a href="<?php get_site_url(); ?>"></a>
                </div>

            </div>


            <div class="small-6 medium-6 large-6  text-center columns">
                <small><?php get_site_credits(); ?></small>
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

