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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
        <style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
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
        <script>
$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 5,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
  	pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};

$(document).ready(function(){
    
  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});
    
});
</script>
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
        <div class="container">
                <div class="row">
                    <form class="navbar-form" role="search"align = "center"  method="post">
                        <div class="form-group">
                            <input type="text" name="city" class="form-control" placeholder="City"/>
                            <input type="text" align = "right" class="form-control" name = "name" placeholder=" Name"/>
                            <input type="text" name="disablitiy" class="form-control" placeholder="Disability"/>
                        </div> 
                        <button type="submit" class="btn btn-default">Search</button>					
                    </form>
                    <br>
                    <br>
                </div>
            </div>
        <div class="container">
                    <form name="selectform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <div class ="container">
                        <button class="btn btn-default" type="submit" name="del" value="Delete">Delete</button>
                        <button class="btn btn-default" type="submit" name="print" value="Print">Print</button>
                        </div>
                    </form>
                        <div class="container">
                            <div class="table-responsive" align="center">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="check" id="checkAll"></th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>NIC</th>
                                            <th>Address</th>
                                            <th>Telephone/Mobile</th>
                                            <th>Disability</th>
                                            <th>Reason</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php 
                                            while ($data = $res->fetch_assoc()){
                                                echo "<tr><td><input type='checkbox' name='patients[]' class='check' id='patients[]' value='".$data['PatientID']."'></td><td>".$data['First_Name']."</td><td>".$data['Last_Name']."</td><td>".$data['NIC_No']."</td><td>".$data['Address']."</td><td>".$data['Telephone']."</td><td>".$data['Disability']."</td><td>".html_entity_decode($data['Reason'])."</td><td>".html_entity_decode($data['Description'])."</td>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
      </div>
                            </div>
                        </div>
                    <div class="container"><div id="map" style="width: 1150px; height: 400px"></div></div>
                </div>
        <script>
        $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
        });
    </script>
    </body>
</html>
