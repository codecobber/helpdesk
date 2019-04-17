 <?php

 include('includes/header.inc.php');
 $_SESSION['pStatus'] = "";
 $_SESSION['gsSitePath'] = get_site_url($echo=false);

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

                //output the details to #userData
                $('#userData').html(this.responseText);

                if(issAction == "delete"){
                    showRows(currentFile);
                    $('#deleteNotice').html(this.responseText);
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


        <hr>
        <div class="row" id="dashboardInfo">
           <div class="medium-12 columns">
               <h4>Welcome to the dashboard.</h4>
               <p>Please start by selecting your P1 or P2 preference from above. Once selected, you will be provided with a list showing each of the current issues.</p>


            </div>

        </div>

        <div id="bck_12" class="bck">
            <div id="block_12" class="row rowNo26">
                <div class="medium-12 medium-centered columns">
                    <div class="data-panel criteria" id="dataRows">

                        <h4 id="pSelection"></h4>
                        <div id="userData" class="panelStyle"></div>
                        <div id="deleteNotice"></div>


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
