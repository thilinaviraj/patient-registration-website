<?php 
    include 'function.php' ;
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $FirstName = $_POST['input'];
        $LastName = $_POST['input1'];
        $NIC = $_POST['input2'];
        $Address = $_POST['input3'];
        $City = $_POST['city'];
        $Telephone = $_POST['phone'];
        $Disability = $_POST['input5'];
        $Reason = htmlentities($_POST['textarea'], ENT_QUOTES);
        $Description = htmlentities($_POST['textarea1'], ENT_QUOTES);
        
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        
        
        $log = new Admin();
        $res = $log->patient_insert($FirstName, $LastName, $Address, $City, $Telephone, $NIC, $Disability, $Reason, $Description, $latitude, $longitude);
        if (!$res){
            //Show error modal
        }
        
        
    }
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
                background: #8999A8;
            }
            .navbar, .dropdown-menu{
            background:rgba(255,255,255,0.25);
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
             color: #fff;
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
        
        <div class="container">
            <link rel="stylesheet" href="formoid_files/formoid1/formoid-solid-blue.css" type="text/css" />
            <script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
            <script type="text/javascript">
        var oldMarker;

        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 7.873054, lng: 80.771797},
                zoom:8
            });
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();

            var geocoder = new google.maps.Geocoder();
           
            document.getElementById('city').addEventListener('keyup', function() {
                geocodeAddress(geocoder, map);
            })

            google.maps.event.addListener(map,'click', function(e){
                document.getElementById("latitude").value = e.latLng.lat();
                document.getElementById("longitude").value = e.latLng.lng();
                var lat = e.latLng.lat();
                var lng = e.latLng.lng();
                placeMarker(e.latLng);

            })



        }
        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('city').value;
            try {
                geocoder.geocode({'address': address, 'region': 'lk'}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        resultsMap.setCenter(results[0].geometry.location);

                    } else {
                        //alert('Geocode was not successful for the following reason: ' + status);
                    }
                });

            }
            catch(err){}
        }
        function placeMarker(location) {


            var marker = new google.maps.Marker({
                position: location,
                map: map
            });


            if (oldMarker != undefined){
                oldMarker.setMap(null);
            }
            oldMarker = marker;

        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsgBFqz2cjiLyvYBDRHrOdgf9vDBIvno8&callback=initMap">
    </script>
            <form class="formoid-solid-blue" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px" method="post"><div class="title"><h2>Registration form</h2></div>
                <div class="element-input" title="First Name"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input" placeholder="First Name"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input1" placeholder="Last Name"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input2" placeholder="NIC"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input3" placeholder="Address"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="city" id="city" placeholder="City "/><span class="icon-place"></span></div></div>
                <div id="map" style="width: 550px; height: 300px"></div>
                
                <input  id="latitude" name="latitude" type="hidden">
                <input  id="longitude" name="longitude" type="hidden">
               
                <div class="element-phone"><label class="title"></label><div class="item-cont"><input class="large" type="tel" pattern="[+]?[\.\s\-\(\)\*\#0-9]{3,}" maxlength="24" name="phone" placeholder="Contact Number" value=""/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input5" placeholder="Disability"/><span class="icon-place"></span></div></div>
                <div class="element-textarea"><label class="title"></label><div class="item-cont"><textarea class="medium" name="textarea" cols="20" rows="5" placeholder="Reason"></textarea><span class="icon-place"></span></div></div>
                <div class="element-textarea"><label class="title"></label><div class="item-cont"><textarea class="medium" name="textarea1" cols="20" rows="5" placeholder="Description"></textarea><span class="icon-place"></span></div></div>
                
            
    
        
        <div class="submit"><input type="submit" value="Submit"/></div>
           
            
            </form>
            
            <p class="frmd"><a href="http://formoid.com/v29.php">online form</a> Formoid.com 2.9</p><script type="text/javascript" src="formoid_files/formoid1/formoid-solid-blue.js"></script>
            <!-- Stop Formoid form-->
        </div>
        
    </body>
</html>
