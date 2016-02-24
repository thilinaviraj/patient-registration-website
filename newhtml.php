<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Manual Reservation</title>

    <!-- Bootstrap and other relevant libraries are including-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>  
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>

    </head>
    
        <style>
            .navbar {
                color: #FFFFFF;
                background-color: #161640;
            }
            .nav {
                color: #FFFFFF;
                background-color: #161640;

            .nav-pills > li > a {
              color: #A7A79Bf;
              font-family: 'Oswald', sans-serif;
              font-size: 0.8em ;
              padding: 1px 1px 1px ;
            }
        </style>
        
        <nav class="navbar navbar-default responsive">
    <div class="container-fluid">
          <div class="navbar-header">
              <ul class="nav navbar-nav navbar-left">
                
                <li><img src="hotelimages/logotra.png" height=50px width=50px align="left"></li>
          </ul>
          <a class="navbar-brand" href="#"><font color= #FFF>Online Hotel Reservation and Management System </font></a>
          </div>
    <div>
                <ul class="nav nav-pills navbar-right">
                  <li><a href="manual_reserve.php"><span class="glyphicon glyphicon-arrow-left"><b>
                    <font size="4" color="#FFF" face="calibri light"> Back</font>
                        </b></a></li>
                <li><a href=<?php echo "Hotel-profile.php?hotel_id=".$_SESSION['hotel_id'].""?>><span class="glyphicon glyphicon-home"><b><font size="4" color="#FFF" face="calibri light"> Home</font></b></span></a></li>
              <li><a href="hotel_logout.php"><span class="glyphicon glyphicon-log-out"><b><font size="4" color="#FFF" face="calibri light">Logout</font></b></a></li></ul>
          
    </div>
    </div>
</nav>
        
        <div class="panel panel-primary">
                <div class="panel-heading">
                                <h3 class="text-center"><?php echo "Hotel name: ".$data['Hotel_Name'] ."<br>"."Room name: ". $room_data['Room_name']?></h3>  
		</div>
			</div>
			<br>
                    <!--Entering in to the container class -->    
            <div class="container">
			<div class="row">
                         <div class="col-md-2">
                          </div>
			<div class="col-md-10">
                    <!--  Create the form horizontally !-->
                    <br><br>

                    <form class="form-horizontal col-md-8" data-toggle="validator" role="form" align = "center" action="manresact.php" method="post" id="contactForm" >
					   <legend>Reservation Details</legend>
                        <div class="jumbotron">
                        <div class="form-group" align = "center">
                            <label for="finame" class="col-md-4 control-label" >
				First Name:
       			    </label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Kamal" class="form-control" name="fname" required />
                            </div>
			</div>
                        <div class="form-group" align = "center">
                            <label for="finame" class="col-md-4 control-label" >
				Last Name:
       			    </label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Kamal" class="form-control" name="lname" required />
                            </div>
			</div>
                            <div class="form-group">
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <div id="messages"></div>
                                                    </div>
                                                </div>
                            <div class="col-sm-offset-8 col-sm-3">
						<button type="submit" class="btn btn-success btn-lg" >Continue</button>
                                                 </div>
                        </div>
    </form>
                            </div>
                           
                        </div>
                    </div>
   
<script type="text/javascript">
        $(document).ready(function() {
            $('#contactForm').bootstrapValidator({
                container: '#messages',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    fname: {
                        validators: {
                            
                            notEmpty: { 
                                message: 'The first name cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z]+$/,
                                message: 'The first name can only consist of alphabetic values'
                            }
                        }
                    },
                    lname: {
                        validators: {
                            notEmpty: {
                                message: 'The last name cannot be empty'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z]+$/,
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

