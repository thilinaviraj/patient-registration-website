<?php

/* 
 * This code is made to generate search results in xml in order to gain speed in 
 * Search page map data loading.
 */
function parseToXML($htmlStr) //Function to replace illegal characters to xml readable form.
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
include "function.php";

$log = new Admin;

if (isset($_GET)){
    
    $Name = $City = $Disability = "";
    
    if (isset($_GET['name'])){$Name = $_GET['name'];}
    if (isset($_GET['city'])){$City = $_GET['city'];}
    if (isset($_GET['dis'])){$Disability =$_GET['dis'];}
    
    $res = $log->patient_search($Name, $City, $Disability); // Get data of search
    
    //Start to generate xml data here
    header("Content-type: text/xml");
    echo '<markers >';
    while ($data = $res->fetch_assoc()){
        $FirstName = parseToXML($data['First_Name']) ;
        $LastName =  parseToXML($data['Last_Name']);
        $Address = parseToXML($data['Address']);
        $City =  parseToXML($data['City']);
        $Telephone =  parseToXML($data['Telephone']);
        $Disability =  parseToXML($data['Disability']);
        $ID = parseToXML($data['PatientID']);
        $Lat = $data['Latitude'];
        $Lng = $data['Longitude'];
        echo '<marker id="'.$ID.'" first="'.$FirstName.'" last="'.$LastName.'" address="'.$Address.'" city="'.$City.'" tel="'.$Telephone.'" disability="'.$Disability.'" lat="'.$Lat.'" lng="'.$Lng.'" />';
    }
    echo "</markers>";
    
}