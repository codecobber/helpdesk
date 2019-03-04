
function bookMe(e){

  $(document).ready(function(){
    
    var txtDate = e.getAttribute('id');
    var realTime = "";
    var txtSlot = txtDate.charAt(0);
    var txtMonth = txtDate.slice(1,4);
    var txtDay = txtDate.slice(4);
    var slotPoint = document.getElementById('slotInfo').setAttribute("data-appoint",txtSlot);

    switch (txtSlot) {
        case "1":
            realTime = "09:30";
            break;
        
        case "2":
             realTime = "10:00";
            break;

        case "3":
             realTime = "10:30";
             break;
    
        case "4":
             realTime = "11:00";
            break;
    }

    //make string for easy user readabi
    var txtReady = realTime + " on " + txtDay + "-" + txtMonth;

    $('#userData').show('slow');
    $('#slotInfo').val(txtReady);
  });


}; 






function  showLocationSpaces(loc){

  if (loc.length == 0) { 
        document.getElementById("txtHintHR").innerHTML = "";
        return;
    } else {
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintHR").innerHTML = this.responseText;
            }
        };
        xmlhttp2.open("GET", "<?php get_theme_url(); ?>/gethint.php?l=" + loc, true);
        xmlhttp2.send();
    }
}







function confirmBooking(str,locCrit) {

    
    
    if (str.length == 0) { 
        document.getElementById("txtHintHR").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintHR").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php get_theme_url(); ?>/gethint.php?l=" + locCrit + "&c="+ str, true);
        xmlhttp.send();
    }
}

