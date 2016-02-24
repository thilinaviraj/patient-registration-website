<?php 
    $errorModal = "";
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
        if ($res){
            $errorModal =  ' <div id="myModal" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="background-color:#FFFFFF;font-size:25px;font-family:"Roboto",Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        Data insertion was successful.
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal" ><span class="glyphicon glyphicon-ok"></span> OK </button>
                    </div>
                </div>
            </div>
        </div>';
        }
        else{
            $errorModal =  ' <div id="myModal" class="modal fade" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="background-color:#FFFFFF;font-size:25px;font-family:"Roboto",Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px">Confirmation</h4>
                    </div>
                    <div class="modal-body">
                        There was an error in the insertion of data..
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-ok"></span> OK </button>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Details</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
        
    </head>
    
    <body>
        
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-left"><li><img src="image/logo.jpg" height=50 width=250 align="left"></li></ul>
       </div>
        <ul class="nav navbar-nav pull-right">
            <li><a href="search.php" style="font-size:17px;font-family:'Roboto';color:#34495E" class="dropdown-toggle"><span class="glyphicon glyphicon-search"></span> Search</a></li>
            <li><a style="font-size:17px;font-family:'Roboto';color:#34495E" href="login.php" class="dropdown-toggle"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>                  
        </ul>
    </nav>
        
        <div class="container">
            <link rel="stylesheet" href="formoid_files/formoid1/formoid-solid-blue.css" type="text/css" />
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
    
            <form class="formoid-solid-blue" id="contactForm" style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:600px;min-width:150px" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><div class="title"><h2>Registration form</h2></div>
                
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input" placeholder="First Name" /><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input1" placeholder="Last Name" /><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input2" maxlength="10" minlength="10" placeholder="NIC"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input3" placeholder="Address"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="city" id="city" placeholder="City"/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><h>Please select location from the map</h></div></div>
                <div id="map" style="width: 550px; height: 300px"></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" id="latitude" name="latitude" type="hidden" data-required="true" readonly=""><span class="icon-place"></span></div></div>
                <input id="longitude" name="longitude" type="hidden" required>
                <div class="element-phone"><label class="title"></label><div class="item-cont"><input class="large" type="tel" pattern="^\d{10}$" maxlength="10" name="phone" placeholder="Contact Number" value=""/><span class="icon-place"></span></div></div>
                <div class="element-input"><label class="title"></label><div class="item-cont"><input class="large" type="text" name="input5" placeholder="Disability"/><span class="icon-place"></span></div></div>
                <div class="element-textarea"><label class="title"></label><div class="item-cont"><textarea class="medium" name="textarea" cols="20" rows="5" placeholder="Reason"></textarea><span class="icon-place"></span></div></div>
                <div class="element-textarea"><label class="title"></label><div class="item-cont"><textarea class="medium" name="textarea1" cols="20" rows="5" placeholder="Description"></textarea><span class="icon-place"></span></div></div>
                <div class="element-textarea"><div id="messages"></div>                                  
                </div>
                <div class="submit"><input type="submit"  value="Submit"   /></div>
            </form>
            <p class="frmd"><a href="http://formoid.com/v29.php">online form</a> Formoid.com 2.9</p>
        </div>
        
        <?php echo $errorModal;?>
        
          <script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
         
        </script>	  
        <script type="text/javascript">
        $(document).ready(function() {
            $('#contactForm').bootstrapValidator({
                excluded: [':disabled', ':hidden', ':not(:visible)'],
                container: '#messages',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields:{
                    input:{
                        validators:{
                            notEmpty:{ 
                                message: 'The first name cannot be empty'
                            },  
                            regexp:{
                                regexp: /^[a-zA-Z]+$/,
                                message: 'The first name can only consist of alphabetic values'
                            }
                        }
                    },
                    input1: {
                        validators: {
                            notEmpty: {
                                message: 'The last name cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z]+$/,
                                message: 'The last name can only consist of alphabetic values'
                            }
                        }
                    },
                    input2: {
                        validators: {
                            notEmpty: {
                                message: 'The NIC cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9]+$/,
                                message: 'The NIC can only consist of an alphabetic value and 9 numbers'
                            }
                        }
                    },
                    input3: {
                        validators: {
                            notEmpty: {
                                message: 'The address cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_/\.,' ']+$/,
                                message: 'The address can only consist of alphabetical, number and underscore'
                            }
                        }
                    },
                    city: {
                        validators: {
                            notEmpty: { 
                                message: 'Please type the city name'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z]+$/,
                                message: 'The city can only consist of alphabetic values'
                            }
                        }
                    },
                    phone: {
                        validators: {
                            notEmpty: { 
                                message: 'Please type the phone number'
                            }
                            
                        }
                    },
                    latitude: {
                        disabled: false,
                        validators: {
                            notEmpty: { 
                                message: 'Please select a city'
                            },
                            regexp: {
                                //regexp: /^[a-zA-Z0-9_\.,' ']+$/,
                                //message: 'The reas can only consist of alphabetic values'
                            }
                        }
                    },
                    longitude: {
                        validators: {
                            isEmpty: { 
                                message: 'Please select a city'
                            },
                            regexp: {
                                //regexp: /^[a-zA-Z0-9_\.,' ']+$/,
                                //message: 'The reas can only consist of alphabetic values'
                            }
                        }
                    },
                    input5: {
                        validators: {
                            notEmpty: { 
                                message: 'Please type the disability'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_/\.,' ']+$/,
                               
                            }
                        }
                    },
                    textarea: {
                        validators: {
                            notEmpty: { 
                                message: 'Please type the reason for disability'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.,' ']+$/,
                                //message: 'The reas can only consist of alphabetic values'
                            }
                        }
                    },
                    textarea1: {
                        validators: {
                            isEmpty: { 
                                //message: 'Please select a city'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.,' ']+$/,
                                message: 'The last name can only consist of alphabetic values'
                            }
                        }
                    }
                }
            });
        });
        </script>
    </body>
</html>
