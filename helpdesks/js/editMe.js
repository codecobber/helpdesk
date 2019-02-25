

      $(document).ready(function(){



            function addPencil(){

               //create dynamic edit button
                $('.ea').each(function(){
                	console.log("yep3");
                    var datID = $(this).attr('id');
                    alert(datID);
                    //var noP = datID.replace("x","");
                    var editButt = "<i id='"+datID+"' class='fa fa-pencil buttons' aria-hidden='true'></i>";
                    
                    $("#"+datID).before(editButt);
                    
                }); 
            }

            //add coloured background
            var bgColr = $('.ea').css("background-color"); 
            $('.ea').css({'background-color':'rgba(147, 204, 232, 0.5)','padding':'10px'});     
                

                
            addPencil();
       


           
            

            function sendData(content,id){

                //strip the content of any potential malicious code

                content = content.replace("&lt;?php","");
                content = content.replace("?&gt;","");
                content = content.replace("&lt;?","");
                content = content.replace("&gt;?","");

                var checks = ["&lt;script&gt;","&lt;/script&gt;","&nbsp;"];
                    
                for(var i=0; i<3;i++){

                    var contSearch = content.search(checks[i]);


                    if(contSearch > -1){
                        content = content.replace(checks[i],"");
                        alert("Javascript entry not allowed!");
                    }


                        
                }
                    


                   
                

                //write to file
                $.ajax({
                    type: 'POST',
                    url: 'theme/helpdesk/writePage.php',
                    data: {content: content, id: id},
                        success: function(response){
                            $(id).html(response);
                            }
                    }); 
            }


            


            //call getData to populate dom with content
        

            $('.buttons').on('click',function(){ 
               
               var id="";
               var captured = ""; 
                
                id = "#p" + $(this).attr('id');
                captured = $(id).html();


                //add red border
                if( $(id).hasClass('borderClass') ){
                    $(id).removeClass('borderClass');
                    $(id).attr('contentEditable','false');
                    

                //send content 
                sendData(captured, id);

                

                }else{
                    $(id).addClass('borderClass');
                    $(id).attr('contentEditable','true');
                     
                }

            });

        });
    