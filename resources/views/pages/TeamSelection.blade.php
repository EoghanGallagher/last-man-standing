<?php
$encrypter = app('Illuminate\Encryption\Encrypter');
$encrypted_token = $encrypter->encrypt(csrf_token());
?>

<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <meta name="csrf_token" content="{{ csrf_token() }}" />


    <link href="/css/style.css" rel="stylesheet" />

    <title>Team Selection</title>
</head>
<body>


<div class="container text-center">
    <h1> Game Week <span id="matchDay"></span> </h1>

    <h3>Deadline: <span id="deadLine">Date Goes here</span></h3>

    <div class="row">
        <br/>
        <div class="col-md-6 col-md-offset-3 col-sm-12  ">

            <div id="fixtures-container" class="shadow" style="border:solid; border-width:thin; border-color:silver; margin-bottom:10px width:100%">

                <!--  <div class="fixtures-div" align="center">

                      <button type="button" class="btn btn-default custom-button">Manchester United</button>  <span>VS</span>  <button type="button" class="btn btn-default custom-button">Liverpool</button>

                  </div>

                  <div  class="fixtures-div" align ="center" >

                      <button type="button" class="btn btn-default custom-button">Default</button>  <span>VS</span>  <button type="button" class="btn btn-default custom-button">Default</button>

                  </div>-->



            </div>

        </div>

    </div>
</div>

<br/>
<br/>
<br/>
<br/>







<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY  -->
<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


<!-- Jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>




    $( function()
    {

        var _token;

        var playerSelection = 'empty';
        var matchId = 'empty';


       // $( '#matchDay' ).val( matchDay );



        GetFixtures(  );


        $('#fixtures-container').on('click', '.custom-button', function()
        {
            console.log( $( this ).text() );

            playerSelection = $( this ).text();
            matchId = $( this ).val();

            $( this).focus();

        });



        $( '#fixtures-container' ).on( "click", '#save-btn', function()
        {

            var user_id = 1;

            var selectedTeam = playerSelection;
            var currentMatch = matchId;


            if( playerSelection != 'empty' && playerSelection != null )
            {

                $.ajax({

                    url: "http://localhost:8889/playerpicks",
                    type: "POST",
                        beforeSend: function (xhr)
                        {
                            var token = $('meta[name="csrf_token"]').attr('content');

                            if (token) {
                                return xhr.setRequestHeader( 'X-CSRF-TOKEN', token );
                            }
                        },

                    data: { _token: this.csrf_token , user_id: user_id, match_id: currentMatch , player_selection: selectedTeam  },
                    cache: false,

                    success: function ( data )
                    {
                        console.log( data );
                    }


                });

            }
            else
            {
                alert( 'Dickhead Player has not selected a Team' );
            }



        });


    });


    function GetFixtures(  )
    {

        // var matchDay = '5';

        var content = "";

        $( '#fixtures-container').append( '<br/>' );


        $.ajax({


            type: "GET",
            url: "http://localhost:8889/teams",
            cache: false,
            contentType: "application/json",
            dataType: "json",

            success: function ( data )
            {

                // console.log( data );


                $.each( data , function ( index )
                {


                    content = '<div class="fixtures-div" align="center"><button type="button" class="btn btn-default custom-button" value="' + data[index].match + '">' +  data[index].home_team_name   + '</button>  <span>VS</span>  <button type="button"  class="btn btn-default custom-button" value="' + data[index].match + '">'+   data[index].away_team_name +'</button> </div>';

                    $( '#fixtures-container').append( content );


                    content = "";


                })


                $( '#fixtures-container').append( '<br/><div class="fixtures-div" align="center">  <button id="save-btn" type="button" class="btn btn-default ">Save</button> </div><br/>' );

            }


        });


    }


</script>

</body>
</html>