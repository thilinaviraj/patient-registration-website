<?php 

include 'function.php';

$log  = new Admin();

$res = $log->patient_search();
$data = $res->num_rows;
//echo $data;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Example of Bootstrap 3 Pagination</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style type="text/css">
    .bs-example{
    	margin: 20px;
    }
</style>
<script>
$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 7,
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
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Windows 8 Bootstrap Modal dialogs </h2>
    </div>
    <div class="row text-center" style="padding: 50px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalDialogA">Windows 8 modal - Click to View</button>

        <div class="modal fade modalDialogA " tabindex="-1" role="dialogA" aria-labelledby="modalLabelA">
            <div class="modal-dialog_a modal-lg">
                <div class="modal-content_a">
                    <div class="modal-body_a  ">
                        <h2>This is a Modal Message!</h2>
                        <h4>Some message text shown to users.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row text-center" style="padding: 50px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modalDialogb">Windows 8 modal - Click to View</button>
        <div class="modal fade modalDialogb" tabindex="-1" role="dialogb" aria-labelledby="modalLabelb">
            <div class="modal-dialog_a modal-lg">
                <div class="modal-content_b">
                    <div class="modal-body_b  ">
                        <h2>This is a Modal Message!</h2>
                        <h4>Some message text shown to users.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.modal {
    padding-right: 0px;
    background-color: rgba(4, 4, 4, 0.3);
}

.modal-dialog_a {
    top: 20%;
    width: 100%;
    position: absolute;
}

.modal-content_a {
    border-radius: 10px;
    border: none;
    padding: 25px;
    top: 40%;
}

.modal-body_a {
    background-color: #0f8845;
    border-radius: 10px;
    color: white;
    padding: 10px;
}


.modal-dialog_b {
    top: 20%;
    width: 100%;
    position: absolute;
}

.modal-content_b {
    border-radius: 10px;
    border: none;
    padding: 25px;
    top: 40%;
}

.modal-body_b {
    background-color: #990000;
    border-radius: 10px;
    color: white;
    padding: 10px;
}

.btn {
    padding: 14px 24px;
    border: 0 none;
    font-weight: 500;
}

    .btn:focus, .btn:active:focus, .btn.active:focus {
        outline: 0 none;
    }

.btn-primary {
    background: #336633;
    color: #ffffff;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background: #339933;
    color: #ffffff;
}

.btn-primary:active, .btn-primary.active {
    background: #336633;
    box-shadow: none;
}                
       
</style>
</body>
</html>                                		