<?php 

//index.php

include('database.php');
include('session.php');

include('nav_bar.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>List of Room</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


    <link rel="stylesheet" href="css/styles.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <style>
        body {
        font: 14px "Montserrat", sans-serif;
    }

    .rounded-circle{
        display: none !important;
    }
    
    </style>





</head>

<body style="background-color: #ABD5FF; font-family: 'Montserrat'; ">
       <div class="container" >
                  <div class="d-flex justify-content-center" style="margin-bottom: 40px; margin-top: 25px;">
                    <div class="searchbar" style="background-color: #FFFFFF">
                      <input class="search_input enterpress" style="background-color: #FFFFFF:; color: #000000;" type="text" name="search_box" id="search_box" placeholder="Type your keyword here" ><span id="isitempat" class="required"></span>
                      <a class="search_icon searchresult"><i class="fas fa-search" style="color:#000000;"></i></a>
                    </div>
                    <div  style="margin-bottom: auto; margin-top: auto; margin-left:10px;">
                    <input id="nah" type="button" value="Clear" onclick="document.getElementById('search_box').value = ''" class="btn btn-default clearresult" style="height: 50px;">
                    </div>
                  </div>
    <!-- Page Content -->
 
        <div class="row">

            <div class="col-md-3" style="margin-top: 15px;">                        
        <div class="list-group" style="background-color: #3690E9; border:1px;  border-radius:15px; padding:20px; margin-bottom:16px;" >
          <h3 style="text-align: center; background-color: #DCEDFF; border-radius:15px; padding: 10px;"><strong>PRICE</strong></h3>
          <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="2000" />
                    <p id="price_show" style="text-align: center; font-size: 18px; color: white;margin-top: 10px;">10 - 2000</p>
                    <div id="price_range" style="margin-top: 10px;"></div><br>
                    <div class="list-group-item checkbox" style="background-color: white;">
                            <label><input type="checkbox" class="common_selector morethan" value="2000" >Above RM 2000</label>     
                    </div>
                </div>  

                <div class="list-group" style="background-color: #3690E9; border:1px;  border-radius:15px; padding:16px; margin-bottom:16px;" >
          <h3 style="text-align: center; background-color: #DCEDFF; border-radius:15px; padding: 10px;"><strong>STATE</strong></h3>
                    <div style=" overflow-y: auto; overflow-x: hidden; border-radius:13px;" >
                        <div class="list-group-item checkbox" style="background-color: white;">
                            <label><input type="checkbox" class="common_selector state" value="SELANGOR" >SELANGOR</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="JOHOR" >JOHOR</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="KEDAH" >KEDAH</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="KELANTAN" >KELANTAN</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="MELAKA" >MELAKA</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="NEGERI SEMBILAN" >NEGERI SEMBILAN</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="PAHANG" >PAHANG</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="PENANG" >PENANG</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="PERAK" >PERAK</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="PERLIS" >PERLIS</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="SABAH" >SABAH</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="SARAWAK" >SARAWAK</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="TERENGGANU" >TERENGGANU</label>
                        </div>
                        <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                            <label><input type="checkbox" class="common_selector state" value="KUALA LUMPUR" >KUALA LUMPUR</label>
                        </div>

                    </div>
                </div>

        <div class="list-group" style="background-color: #3690E9; border:1px;  border-radius:15px; padding:16px; margin-bottom:16px;" >
                    <div style=" overflow-y: auto; overflow-x: hidden; border-radius:13px;" >
          <h3 style="text-align: center; background-color: #DCEDFF; border-radius:15px; padding: 10px;"><strong>ACCOMODATION</strong></h3>

                    <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                        <label><input type="checkbox" class="common_selector Furnished" value="Not Furnish"  >Not Furnish</label>
                    </div>
                    <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                        <label><input type="checkbox" class="common_selector Furnished" value="Semi Furnish"  >Semi Furnish</label>
                    </div>
                    <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                        <label><input type="checkbox" class="common_selector Furnished" value="Fully Furnish"  >Fully Furnish</label>
                    </div>

                    <div class="list-group-item checkbox" style="background-color: #FFFFFF;">
                        <label><input type="checkbox" class="common_selector Wifi" value="Free Wifi" >Free Wifi</label>
                    </div>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
              
                <div class="row filter_data">
                    

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
  text-align:center; 
  background: url('loader.gif') no-repeat center; 
  height: 150px;
}

    .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    margin-left: 100px;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 500px;
    padding: 0 10px;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: gray;
    color: #e74c3c;
    }

    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: white;
    text-decoration:none;
    }


</style>


<script>
$(document).ready(function(){

    filter_data(1);

    function filter_data(page, query = '')
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var morethan = get_filter('morethan');
        var state = get_filter('state');
        var Furnished = get_filter('Furnished');
        var Wifi = get_filter('Wifi');
        $.ajax({
            url:"filter_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, morethan:morethan, state:state, Furnished:Furnished, Wifi:Wifi, page:page, query:query},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }



    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data(1);
    });

    $('#price_range').slider({
        range:true,
        min:10,
        max:2000,
        values:[10, 2000],
        step:10,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data(1);
        }
    });

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      filter_data(page, query);
    });

    $(document).on('click', '.searchresult', function(){
      var query = $('#search_box').val();
        if (!query) {
            isitempat.focus();
            window.alert("Please insert a value!");
            
        }

        else if(query) {
            filter_data(1, query);
        }

    });

    $(document).on('click', '.clearresult', function(){
        var query = '';
      filter_data(1, query);
    });


    $(document).on('keypress', '.enterpress', function(e) {
        if(e.which == 13) {
                 var query = $('#search_box').val();
                if (!query) {
                    isitempat.focus();
                    window.alert("Please insert a value!");
                    
                }

                else if(query) {
                    filter_data(1, query);
                }
        }
    });

});
</script>


</body>

</html>
