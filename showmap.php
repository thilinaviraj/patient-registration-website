<?php 
    include "function.php";
    $query = "";
    $Name = $City = $Disability = "";
    $log = new Admin;
    if (isset($_POST['print']) and isset($_POST['patients'])){
        
    }
    elseif(isset($_POST['del']) and isset($_POST['patients'])){
        foreach ($_POST['patients'] as $pid){
            
            $log->patient_delete($pid);
        }
        
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "POST"){
        $query_array = array();
        if (isset( $_POST['name'])) $Name = $_POST['name'];
        if (isset( $_POST['city']))$City = $_POST['city'];
        if (isset(  $_POST['disability']))$Disability = $_POST['disability'];
        if($Name != ""){$query_array[] = "name=".$Name;}
        if($City != ""){$query_array[] = "city=".$City;}
        if($Disability != ""){$query_array[] = "dis=".$Disability;}
        $string = implode("&", $query_array);
        $query = "searchxml.php?".$string;
    }
    else{
        $query = "searchxml.php";
    }
    $res = $log->patient_search($Name, $City, $Disability);
    
        
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>  
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
        <style>
            body{
                background:#ffe6e6;
            }
            .navbar, .dropdown-menu{
            background:rgba(255, 128, 128,0.25);
            border: none;

            }

            .nav>li>a, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .dropdown-menu>li>a, .dropdown-menu>li{
              border-bottom: 3px solid transparent;
            }
            .nav>li>a:focus, .nav>li>a:hover,.nav .open>a, .nav .open>a:focus, .nav .open>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
              border-bottom: 3px solid transparent;
              background: none;
            }
            .navbar a, .dropdown-menu>li>a, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .navbar-toggle{
             color: #000066;
            }
            .dropdown-menu{
                  -webkit-box-shadow: none;
                box-shadow:none;
            }

            .nav li:hover:nth-child(8n+1), .nav li.active:nth-child(8n+1){
              border-bottom: #C4E17F 3px solid;
            }
            .nav li:hover:nth-child(8n+2), .nav li.active:nth-child(8n+2){
              border-bottom: #F7FDCA 3px solid;
            }
            .nav li:hover:nth-child(8n+3), .nav li.active:nth-child(8n+3){
              border-bottom: #FECF71 3px solid;
            }
            .nav li:hover:nth-child(8n+4), .nav li.active:nth-child(8n+4){
              border-bottom: #F0776C 3px solid;
            }
            .nav li:hover:nth-child(8n+5), .nav li.active:nth-child(8n+5){
              border-bottom: #DB9DBE 3px solid;
            }
            .nav li:hover:nth-child(8n+6), .nav li.active:nth-child(8n+6){
              border-bottom: #C49CDE 3px solid;
            }
            .nav li:hover:nth-child(8n+7), .nav li.active:nth-child(8n+7){
              border-bottom: #669AE1 3px solid;
            }
            .nav li:hover:nth-child(8n+8), .nav li.active:nth-child(8n+8){
              border-bottom: #62C2E4 3px solid;
            }

            .navbar-toggle .icon-bar{
                color: #fff;
                background: #fff;
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function load() {
                var map = new google.maps.Map(document.getElementById("map"), {
                  center: new google.maps.LatLng(7.873054, 79.8562055),
                  zoom: 5,
                  mapTypeId: 'roadmap'
                });
                var infoWindow = new google.maps.InfoWindow();
                downloadUrl("<?php echo $query;?>", function(data) {
                var xml = data.responseXML;
                //var xml = xmlParse(xmlData);
                var bounds = new google.maps.LatLngBounds();
                var markers = xml.documentElement.getElementsByTagName("marker");
                
                
                for (var i = 0; i < markers.length; i++) {
                  var id = markers[i].getAttribute("id");
                  var name = markers[i].getAttribute("first") + " " + markers[i].getAttribute("last");
                  var address = markers[i].getAttribute("address");
                  var disable = markers[i].getAttribute("disability");
                  var lat = markers[i].getAttribute("lat");
                  var lng = markers[i].getAttribute("lng");
                  if (lat != "" && lng != "") {
                    var point = new google.maps.LatLng(
                      parseFloat(lat),
                      parseFloat(lng));
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point
                    });
                    bounds.extend(point);
                    var html = "<b>" + name + "</b> <br/>" + address +"</b> <br/>" +  disable ;
                    bindInfoWindow(marker, map, infoWindow, html);
                  }
                }

                map.fitBounds(bounds);
                });
              }
              

              function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function() {
                  infoWindow.setContent(html);
                  infoWindow.open(map, marker);
                });
              }

              function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                  new ActiveXObject('Microsoft.XMLHTTP') :
                  new XMLHttpRequest;

                request.onreadystatechange = function() {
                  if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                  }
                };

                request.open('GET', url, true);
                request.send(null);
              }

              function doNothing() {}
              google.maps.event.addDomListener(window, "load", load);

              function xmlParse(str) {
                if (typeof ActiveXObject != 'undefined' && typeof GetObject != 'undefined') {
                  var doc = new ActiveXObject('Microsoft.XMLDOM');
                  doc.loadXML(str);
                  return doc;
                }

                if (typeof DOMParser != 'undefined') {
                  return (new DOMParser()).parseFromString(str, 'text/xml');
                }

                return createElement('div', null);
              }
        </script>
    </head>
    <body>
        <div class="container-fluid">
                <nav class="navbar navbar-fixed">
                    <div class="navbar-header">
      			<ul class="nav navbar-nav navbar-left"><li><img src="image/logo.jpg" height=50 width=250 align="left"></li></ul>
                    </div>
                        <div class="container">
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class=""><a href="#" class=""><span class="glyphicon glyphicon-saved"></span> Add details</a></li>
                                    <li class=""><a href="#" class=""><span class="glyphicon glyphicon-search"></span> Search details</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-import"></span> Update details</a></li>
                                    <li class=""><a href="#"><span class="glyphicon glyphicon-remove"></span> Delete details</a></li>
                                </ul>
                                <ul class="nav navbar-nav pull-right">
                                    <li class=""><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                </nav>
            </div>
    </body>

