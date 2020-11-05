<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
-->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     

     
    </head>
    <body>

        <div id='app'>

            <app-home></app-home>

        </div>
       
          
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
   <!--   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>  -->
</html>





     
        
       
