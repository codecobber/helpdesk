<?php
 session_start();
 
 
/****************************************************
*
* @File:        getHelpAdmin.php
* @Function:    Retrieve array and search
* @Author:      Craig Adams
*
*****************************************************/


//error handler function
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");



$hint = "<tr>
            <th>ID</th>
            <th>Created on</th>
            <th>Updated on</th>
            <th>Title</th>
            <th>Status</th>
            <th style='text-align:center;'>Options</th>
        </tr>";




function getLocData($ld){
    switch($ld){
            case 'p1':
                return('dataSearch/p1/data.json');
            break;
            
            case 'p2':
                return('dataSearch/p2/data.json');
            break;
        }
}   

function deleteDetails($delRef){
    
    $delData = getLocData($_SESSION['pStatus']);
    
    

    //convert to php array
    $jData = file_get_contents($delData);
    $jDataArr = json_decode($jData,true);
    $elementCount = 0;
    $counterMatch = 0;

    foreach($jDataArr as $row){ 
        foreach ($row as $key => $value) {
            $delRef = str_replace("-del", "", $delRef);
            if($key == "id" && $value == $delRef){
                $counterMatch = $elementCount;
                echo "<h3><i style='color:#ce3838;' class='fas fa-trash-alt'></i> Record: " .$value." now deleted!</h3>";
            }
        }
        $elementCount ++;
    }


    //delete element from array
    array_splice($jDataArr,$counterMatch,1);
    
    //change array to json and use pretty print
    $jDataStr = json_encode($jDataArr,JSON_PRETTY_PRINT);
   
    //Save updates back to file
    file_put_contents($delData, $jDataStr);

}

function checkStatus($statcol){
    //checks the value of staus and then provides a colour value
    switch ($statcol) {
                case 1:
                    return ($statusColour = "style ='background-color: #e2553e; border: solid 1px #a94131;'");
                    break;
                
                case 2:
                    return ($statusColour = "style ='background-color: #63bf5d;; border: solid 1px #3cb340;'");
                    break;
            }
}

function showDetails($c){
    
    $isP = substr($c,0,2); // grab first two characters to get correct directory
    $dataDetails = "";
   
    $lc = getLocData($_SESSION['pStatus']);
    
    $jsonData = json_decode(file_get_contents($lc));
 
  

   
    //Output the selected row showing the alert
    foreach($jsonData as $row){

        //check status colour
        $statusColour = checkStatus($row->status);
        
        if($row->id == strtolower($c)){

            //check staus colour
            

            $dataDetails .= "
                <table class='tableClr'>
                    <tr>
                        <td class='greyBG' colspan='5'>Ticket number: <h3>".strtoupper($row->id)."</h3></td>
                    </tr>
                     
                    <tr>
                        <th>Created on</th>
                        <th>Updated on</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>".strtolower($row->date)."</td>
                        <td>".strtolower($row->updated)."</td>
                        <td>".strtolower($row->title)."</td>
                        <td>".strtolower($row->email)."</td>
                        <td><span " .$statusColour . " class='statusColour'></span></td>
                    </tr>
                    <tr>
                        <th colspan='5'>Details</th>
                    </tr>
                    <tr>
                        <td style='text-align:left;' id='".strtolower($row->id)."-cont' class='ea' colspan='5'>".strtolower($row->details)."</td>
                    </tr>
                    <tr>
                        <th colspan='5'>Impact to end user</th>
                    </tr>
                    <tr>
                        <td style='text-align:left;' id='".strtolower($row->id)."-impact' class='ea' colspan='5'>".strtolower($row->impact)."</td>
                    </tr>
                    
                
                </table>";
        }
                           
                
    }
      echo $dataDetails;       
}
        
    

         


function getAvailableData($l){

    $ld = getLocData($l);
    $jsonData = json_decode(file_get_contents($ld));
    rsort($jsonData);
    
   
  
  
        foreach($jsonData as $row){
             
             //check status colour
             $statusColour = checkStatus($row->status);
             
              //Output the selected rows showing the alerts

                $GLOBALS['hint'] .= "
                <tr>
                    <td>".$row->id."</td>
                    <td>".$row->date."</td>
                    <td>".$row->updated."</td>
                    <td>".$row->title."</td>
                    <td><span " .$statusColour . " class='statusColour'></span></td>";                    
                
                if ($_SESSION['userOnline'] == 1) { 
                    $GLOBALS['hint'] .= "<td class='butts'>
                    <a onclick='viewMe(this)' id='".$row->id."-view' class='bookButt editPage button' data-user='".$row->id."' data-action = 'open' style='border-radius:5px;background-color:green'><i class='far fa-folder-open'></i></a>
                    <a href='".$_SESSION['gsSitePath']."index.php?id=edit&t=".$row->id."' id='".$row->id."-edit' class='bookButt button' data-id='".$row->id."' data-action = 'edit' style='border-radius:5px;background-color:#444'><i class='fas fa-pencil-alt'></i></a>
                    <a onclick='viewMe(this)' id='".$row->id."-del' class='bookButt button' data-user='".$row->id."' data-action = 'delete' style='border-radius:5px;background-color:#ce3838'><i class='far fa-trash-alt'></i></a>
                    </td>";
                }
                else{

                    $GLOBALS['hint'] .= "<td class='butts'>
                    <a onclick='viewMe(this)' id='".$row->id."-view' class='bookButt editPage button' data-user='".$row->id."' data-action = 'open' style='border-radius:5px;background-color:green'><i class='far fa-folder-open'></i></a>
                    </td>";
                }


                $GLOBALS['hint'] .= "    
                </tr>"; // Slot number 1 for each array 
        }
}


if(isset($_REQUEST['l']) && !empty($_REQUEST['l'])){
    //get row data
    $l_input = htmlentities($_REQUEST['l']);
    
    $_SESSION['pStatus'] = $l_input;
   
    getAvailableData($l_input);

    echo $hint;
}
else if(isset($_REQUEST['c']) && !empty($_REQUEST['c'])){
    //view data
    $c_input = htmlentities($_REQUEST['c']);
    showDetails($c_input);

}
else if(isset($_REQUEST['d']) && !empty($_REQUEST['d'])){
    //delete data
    $d_input = htmlentities($_REQUEST['d']);
    deleteDetails($d_input);
}

    



 

?>