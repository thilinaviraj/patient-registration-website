<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'function.php';
$log = new Admin();
$Address= "";

require_once('tcpdf/tcpdf.php');


if (isset($_SESSION['print_index'])){
    $index = $_SESSION['print_index'];
    
    
    $html = '<table table border="1" cellspacing="6" cellpadding="4"><tbody>';
    $c = 0;
    foreach($index as $id){
        $res = $log->patient_read($id);
        $data = $res->fetch_assoc();
        $First = $data['First_Name'];
        $Last  = $data['Last_Name'];
        $Name = $First." ".$Last;
        $Address = $data['Address'];
        
        //$Address = str_replace(",", ",<br>", "<body text='%body%'>", $Address);
        
        $str = "<td>$Name<br>$Address</td>";
        if ($c%3 == 0){
            $str = "<tr>".$str;
            
        }
        elseif($c%3 == 2){
            $str = $str."</tr>";
        }
        
        $html = $html.$str;
        $c++;
        //echo $c;
    }
    
    if ($c%3 != 0){
        while ($c%3 != 0){
            $html = $html."<td></td>";
            $c++;
        }
        $html = $html."</tr>";
    }
    $html = $html."</tbody></table>";
    $_SESSION['print'] = $html;
    header('location:print.php');
}
else{
    echo "Broken";
    exit();
}
